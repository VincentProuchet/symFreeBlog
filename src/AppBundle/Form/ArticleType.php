<?php
namespace AppBundle\Form;

use AppBundle\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
/**
 * 
 * @author Vincent
 *
 */
class ArticleType extends AbstractType
{
   
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix()
    {
        // TODO Auto-generated method stub
        return "Article";
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
       $builder
       ->add("id", IntegerType::class,['required'=>false, 'empty_data'=>0 ])
       ->add("title",TextType::class)
       ->add("text", TextareaType::class)
       ->add("creation",DateTimeType::class)
       ->add('author',UserType::class,['required'=>false ])
       ;
        
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefault(
            'data_class', Article::class
            
        );
      
        
    }

}

