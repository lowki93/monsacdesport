<?php

namespace MonSac\DeSportBundle\Form;

use MonSac\DeSportBundle\Entity\ProductCategory;
use Doctrine\ORM\EntityRepository;
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
            ->add('productCategory', 'entity', array(
                'label' => 'Catégorie',
                'class' => 'MonSacDeSportBundle:ProductCategory',
                'property' => 'name',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('pc')
                            ->orderBy('pc.name', 'ASC');
                    }
            ))
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
