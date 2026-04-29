<?php

namespace App\Form;

use App\Entity\Lieu;
use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom de la sortie',
            ])
            ->add('dateHeureDebut', null, [
                'widget' => 'single_text',
                'label' => 'Date et heure de la sortie',
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date de la sortie doit être aujourd\'hui ou dans le futur.',
                    ]),
                ],
            ])
            ->add('dateLimiteInscription', null, [
                'widget' => 'single_text',
                'label' => "Date limite d'inscription",
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 'today',
                        'message' => 'La date limite doit être aujourd\'hui ou dans le futur.',
                    ]),
                ],
            ])
            ->add('nbInscriptionMax', null, [
                'label' => 'Nombre de places',
            ])
            ->add('duree', null, [
                'label' => 'Durée (en minutes)',
            ])
            ->add('infosSortie', null, [
                'label' => 'Description et infos',
                'required' => false,
            ])
            ->add('lieu', EntityType::class, [
                'label' => 'Lieu',
                'class' => Lieu::class,
                'choice_label' => 'nom',
                'placeholder' => '-- Choisir un lieu --',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
