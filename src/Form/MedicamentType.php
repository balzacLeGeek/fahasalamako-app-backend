<?php

namespace App\Form;

use App\Entity\Medicament;
use App\Entity\Laboratory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MedicamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('pharmacy')
            ->add('nom')
            ->add('indication')
            ->add('posologie')
            ->add('contreIndication')
            ->add('dateExpiration')
            ->add('cover')
            ->add('poids')
            ->add('quantite')
            ->add('prix')
            ->add('category')
            ->add('laboratory')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
        ]);
    }
}
