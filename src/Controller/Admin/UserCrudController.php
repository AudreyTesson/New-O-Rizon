<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    use Trait\ShowTrait;
    
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW);
        ;
    }

    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')->hideOnForm();

            yield EmailField::new('email');

            yield TextField::new('username');

            yield TextField::new('firstname');

            yield TextField::new('lastname');

            $roles = [
                'Utilisateur' => 'ROLE_USER',
                'Administrateur' => 'ROLE_ADMIN',
            ];

            yield ChoiceField::new('roles')
            ->setHelp('Rôles disponibles : ROLE_USER, ROLE_ADMIN')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges([            
                'ROLE_USER' => 'success',
                'ROLE_ADMIN' => 'danger'
            ])
;
    }
}
