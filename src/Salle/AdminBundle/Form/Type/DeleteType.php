<?php

namespace Salle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DeleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('delete', 'collection', array(
            'attr' => array('class' => 'btn btn-danger btn-sm'),
            'type' => 'button'));
    }

    public function getName()
    {
        return 'Eliminar';
    }

    // public function setDefaultOptions(OptionsResolverInterface $resolver)
    // {
    //     // $resolver->setDefaults(array(
    //     //     'data_class' => 'Salle\AdminBundle\Entity\Noticia',
    //     // ));
    // }
}