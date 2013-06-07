<?php
namespace Zertz\SortBundle\Entity\Repository;

class CategoryRepository extends \Gedmo\Tree\Entity\Repository\NestedTreeRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('root' => 'ASC', 'lft' => 'ASC'));
    }
    
    public function getFlatNodes($startNode = null, $options = null) {
        if (is_null($options)) {
            $options = array(
                'decorate' => false,
                'rootOpen' => '',
                'rootClose' => '',
                'childOpen' => '',
                'childClose' => '',
                'nodeDecorator' => function($node) {
                    return ''.$node['title'].'';
                }
            );
        }

        $htmlTree = $this->childrenHierarchy(
            $startNode, // starting from root nodes
            false, // load all children, not only direct
            $options
        );

        return $this->toFlat($htmlTree, ' » ');
    }

    public function toFlat($node, $sep = ' > ', $path = '') {
        $els = array();

        foreach ($node as $id => $opts) {
            $els[$opts['id']] = $path . $opts['title'];

            if (isset($opts['__children']) && is_array($opts['__children']) && sizeof($opts['__children'])) {
                $r = $this->toFlat($opts['__children'], $sep, ($path . $opts['title'] . $sep));

                foreach($r as $id => $title) {
                    $els[$id] = $title;
                }
            }
        }

        return $els;
    }
}
