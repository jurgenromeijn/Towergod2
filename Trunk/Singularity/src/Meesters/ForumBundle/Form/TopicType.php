<?php

namespace Meesters\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array(
            'label' => 'Onderwerp'
        ));
        $builder->add('sticky', null, array(
            'label'    => 'Sticky',
            'required' => false
        ));
        $builder->add('posts', 'collection', array(
            'type' => new PostType()
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meesters\ForumBundle\Entity\Topic'
        ));
    }

    public function getName()
    {
        return 'meesters_forumbundle_topictype';
    }
}
