<?php

namespace App\Command;

use App\Entity\City;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'neworizon:picture-load',
    description: 'Update the pictures of the cities',
)]
class NeworizonPictureLoadCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * @var HttpClientInterface
     */
    private $client;

    private $apiKey = "JVeX-5NBPt56QqPE84usXZhHJZAEtAy8LLPaVqbc9cY";

    public function __construct(CityRepository $cityRepository, EntityManagerInterface $entityManager, HttpClientInterface $client) {
        $this->client = $client;

        $this->cityRepository = $cityRepository;

        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('city_id', InputArgument::OPTIONAL, 'City id to update')
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $cityID = $input->getArgument('city_id');

        if ($cityID) {
            $city = $this->cityRepository->find($cityID);

            $response = $this->client->request(
                'GET',
                'https://api.unsplash.com/search/photos',
                [
                    'query' => [
                        'client_id' => $this->apiKey,
                        'query' => $city->getName(),
                        // 'per_page' => 1,
                    ],
                ]
            );

            $content = $response->toArray();
            if (array_key_exists('picture', $content) && count($content['picture']) > 0) {
                $newPicture = $content['picture'][0];
            } else {
                $newPicture = ('images/city2.jpg');
            }

            $city->setPicture($newPicture);

        }

        $this->entityManager->flush();
        
        $io->success('Upload successful');

        return Command::SUCCESS;
    }
}
