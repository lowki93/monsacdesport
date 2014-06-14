<?php

namespace MonSac\DeSportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('description', 'textarea')
            ->add('price', 'number', array('label' => 'Prix'))
            ->add('brand', 'text', array('label' => 'Marque'))
            ->add('size', 'text', array('label' => 'Taille'))
            ->add('quantity', 'number', array('label' => 'Quantité en stock'))
            ->add('images', 'collection', array('type' => new ImageType(), 'allow_add' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MonSac\DeSportBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'monsac_desportbundle_product';
    }
}
