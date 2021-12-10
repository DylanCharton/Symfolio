<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('category', EntityType::class, [
                'class'        => Category::class,
                'choice_label' => 'title',
                'expanded'     => 'true'
            ])
            ->add('description', CKEditorType::class)
            ->add('mockup', FileType::class, [
                'label'      => false,
                'data_class' => null,
            ])
            ->add('image', FileType::class, [
                'label' => false,
                'data_class' => null,
            ])
            ->add('github')
            ->add('weblink')
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
