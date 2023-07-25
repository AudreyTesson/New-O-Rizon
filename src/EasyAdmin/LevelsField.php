<?php 

namespace App\Entity;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class LevelsField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, $label = null): self
    {
        $levels= [
            'Non renseigné' => '',
            'Bas' => 'Low',
            'Moyen' => 'Medium',
            'Haut' => 'High',
        ];

        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplateName('admin/field/levels.html.twig')
            ->setFormType(ChoiceType::class)
            ->setRequired(false)
            ->hideOnIndex()
            // ->setChoices(array_combine($levels, $levels))
            // ->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges([
                '' => 'info',
                'Low' => 'danger',
                'Medium' => 'warning',
                'High' => 'success',
            ]);
            // ->setDefaultColumns('') // this is set dynamically in the field configurator
            // ->setCustomOption(self::OPTION_CHOICES, null)
            // ->setCustomOption(self::OPTION_USE_TRANSLATABLE_CHOICES, false)
            // ->setCustomOption(self::OPTION_ALLOW_MULTIPLE_CHOICES, false)
            // ->setCustomOption(self::OPTION_RENDER_AS_BADGES, null)
            // ->setCustomOption(self::OPTION_RENDER_EXPANDED, false)
            // ->setCustomOption(self::OPTION_WIDGET, null)
            // ->setCustomOption(self::OPTION_ESCAPE_HTML_CONTENTS, true);
    }
}