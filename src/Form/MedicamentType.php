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
            ->add('nom')
            ->add('infoGenerale')
            ->add('kqueQuantite')
            ->add('kqueUnite')
            ->add('codeATC')
            ->add('principesActifs')
            ->add('expicients')
            ->add('presentation')
            ->add('aspectForme')
            ->add('casUtilisation')
            ->add('Posologie')
            ->add('effet')
            ->add('contreIndication')
            ->add('pathologie')
            ->add('laboratoire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
        ]);
    }
}
