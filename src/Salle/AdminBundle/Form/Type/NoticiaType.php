<?php

namespace Salle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoticiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', 'text')
            ->add('subtitulo', 'text')
            ->add('cuerpo', 'textarea')
            ->add('file', 'file', array(
                'required'    => 'false'
                ))
            ->add('seccion', 'choice', array(
                'choices' => array(
                    'Política' => 'Política',
                    'Internacional' => 'Internacional', 
                    'Economía' => 'Economía', 
                    'Cultura' => 'Cultura', 
                    'Sociedad' => 'Sociedad', 
                    'Deprtes' => 'Deportes')
                ))
            ->add('send', 'submit', array(
                'label' => 'Añadir')
                );
    }

    public function getName()
    {
        return 'noticia';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Salle\AdminBundle\Entity\Noticia',
        ));
    }
}