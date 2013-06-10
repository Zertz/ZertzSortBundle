<?php
namespace Zertz\SortBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Zertz\SortBundle\Entity\Category;
use Zertz\SortBundle\Entity\Tag;

class SortListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->handlePreEvent($args);
    }
    
    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->handlePreEvent($args);
    }
    
    protected function handlePreEvent(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        if ($this->isSort($entity)) {
            if ($args instanceof PreUpdateEventArgs) {
                $entity->setUpdatedAt();

                $em = $args->getEntityManager();
                $cm = $em->getClassMetadata(get_class($entity));
                $em->getUnitOfWork()->recomputeSingleEntityChangeSet($cm, $entity);
            } else {
                $entity->setCreatedAt();
            }
        }
    }
    
    protected function isSort($entity)
    {
        return $entity instanceof Category || $entity instanceof Tag;
    }
}
