<?php

namespace App\Form;

use App\Entity\PortfolioProject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class PortfolioFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category')
            ->add('description')
            ->add('creationDate', DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'form-control js-datepicker'],
                'format' =>'yyyy-MM-dd'
            ])
            ->add('link', TypeTextType::class)
            ->add('client')
            ->add('upload',FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ->add('submit',SubmitType::class)
            // ->add('submit',SubmitType::class,
            //          ['attr'=>['formnovalidate'=>'formnovalidate']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PortfolioProject::class,
        ]);
    }
}
