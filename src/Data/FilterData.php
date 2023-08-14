<?php

namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * class using to display form and retrieve data from the form filter menu (cf. FilterDataType)
 */
class FilterData 
{
    public string $electricityLevel;
    public string $internetLevel;
    public string $sunshineLevel;
    public string $housingLevel;
    public int $temperatureMax;
    public int $temperatureMin;

    /**
     * @Assert\Positive(
     *      message="Cette valeur ne peut pas être négative."
     * )
     *
     * @var integer
     */
    public int $demographyMin;
    /**
     * @Assert\Positive(
     *      message="Cette valeur ne peut pas être négative."
     * )
     *
     * @var integer
     */
    public int $demographyMax;
    /**
     * @Assert\Positive(
     *      message="Cette valeur ne peut pas être négative."
     * )
     *
     * @var integer
     */
    public int $costMax;
    /**
     * @Assert\Positive(
     *      message="Cette valeur ne peut pas être négative."
     * )
     *
     * @var integer
     */
    public int $costMin;
    /**
     * @Assert\Positive(
     *      message="Cette valeur ne peut pas être négative."
     * )
     *
     * @var integer
     */
    public int $areaMin;
    /**
     * @Assert\Positive(
     *      message="Cette valeur ne peut pas être négative."
     * )
     *
     * @var integer
     */
    public int $areaMax;
    public int $timezone;
    public string $currencyType;
    public string $visaType;
    public bool $visaRequired = false;
    public string $language;
    public string $environment;
}