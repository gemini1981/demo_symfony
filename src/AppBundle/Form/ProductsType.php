<?php

namespace AppBundle\Form;

use AppBundle\Entity\Tags;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProductsType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nome', TextType::class)
                ->add('descrizione', TextareaType::class)
                ->add('tags', EntityType::class, array(
                    'class'        => Tags::class,
                    'choice_label' => 'tag',
                    'choice_value' => 'id',
                    'multiple'     => true,
                ))
                ->add('imageFile', VichFileType::class, array(
                    'label'         => 'immagine prodotto',
                    'required'      => false,
                    'allow_delete'  => false, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                ))
//                ->add('save', SubmitType::class, array('label' => 'Save', 'validation_groups' => false,))
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class'        => 'AppBundle\Entity\Products',
            'validation_groups' => array('registration'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_products';
    }

}
