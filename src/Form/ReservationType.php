<?php

namespace App\Form;

use App\Entity\Disponibilite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('debut',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ] )
            ->add('fin',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ] )
            ->add('Envoyer',SubmitType::class )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Disponibilite::class,
        ]);
    }
}
