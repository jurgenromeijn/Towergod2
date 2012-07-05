<?php

namespace Meesters\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('message', null, array(
            'label' => 'Bericht'
        ));
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meesters\ForumBundle\Entity\Post'
        ));
    }

    public function getName()
    {
        return 'meesters_forumbundle_posttype';
    }
}
