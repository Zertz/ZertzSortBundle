<?php
// src/Zertz/SearchBundle/Form/Type/CategoryType.php
namespace Zertz\SearchBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('parent', 'entity', array(
            'label' => 'Catégorie parent',
            'class' => 'Zertz\SearchBundle\Entity\Category',
            'property' => 'indentedNom',
            'required' => false,
            'query_builder' => function(EntityRepository $repository) {
                return $repository->createQueryBuilder('c')
                    ->orderBy('c.root', 'asc')
                    ->addOrderBy('c.lft', 'asc');
            }
        ));
        $builder->add('nom');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zertz\SearchBundle\Entity\Category',
        ));
    }

    public function getName()
    {
        return 'categorie';
    }
}
?>
