<?php

namespace Salle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', 'text')
            ->add('descripcion', 'textarea')
            ->add('file', 'file', array(
                'required'    => true,
                'label' => 'Imagen'
                ))
            ->add('send', 'submit', array(
                'label' => 'Añadir')
                );
    }

    public function getName()
    {
        return 'patro';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Salle\AdminBundle\Entity\Patro',
        ));
    }
}