<?php
namespace Zertz\SearchBundle\Entity\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Velo\FabricantBundle\Entity\Fabricant;

class CategoryManager
{
    protected $em;
    
    protected $repo;
    
    protected $class;
    
    public function __construct(EntityManager $em, $class) {
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
    }
    
    public function getAll()
    {
        return $this->repo->findAll();
    }
    
    public function get($slug)
    {
        return $this->repo->findOneBySlug($slug);
    }
    
    public function getByFabricant(Fabricant $fabricant)
    {
        return $this->repo->findByFabricant($fabricant);
    }
}