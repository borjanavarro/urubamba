<?php

namespace Salle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlashType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titular', 'text')
            ->add('enlace', 'text', array(
                'required' => false
                ))
            ->add('send', 'submit', array(
                'label' => 'Añadir')
                );
    }

    public function getName()
    {
        return 'flash';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Salle\AdminBundle\Entity\Flash',
        ));
    }
}