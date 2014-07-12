<?php

namespace Salle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImagenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', 'text')
            ->add('descripcion', 'textarea')
            ->add('file', 'file', array(
                'required'    => true
                ))
            ->add('fecha', 'date', array(
                'mapped' => false,
                'label' => false,
                'attr'=>array('style'=>'display:none;')
                ))
            ->add('send', 'submit', array(
                'label' => 'Añadir')
                );
    }

    public function getName()
    {
        return 'imagen';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Salle\AdminBundle\Entity\Imagen',
        ));
    }
}