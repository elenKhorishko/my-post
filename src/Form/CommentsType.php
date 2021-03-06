<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.01.2018
 * Time: 22:56
 */

namespace App\Form;


use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CommentsType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Comments::class,
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dataComm')
            ->add('nikName')
            ->add('textComm')
        ;
    }
}