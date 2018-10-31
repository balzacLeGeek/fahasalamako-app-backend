<?php

namespace App\Form;

use App\Entity\Medicament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('nom')
            ->add('indication')
            ->add('posologie')
            ->add('contreIndication')
            ->add('dateExpiration')
            ->add('cover')
            ->add('poids')
            ->add('quantite')
            ->add('dateAjout')
            ->add('category')
            ->add('pharmacy')
            ->add('laboratories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
        ]);
    }
}
