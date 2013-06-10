<?php
namespace Zertz\SortBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Zertz\SortBundle\Model\TagInterface;

class Tag implements TagInterface
{
    protected $name;
    
    protected $slug;
    
    protected $createdAt;
    
    protected $updatedAt;
    
    public function __construct() {
        
    }
    
    public function __toString() {
        return $this->name ?: '';
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }
    
    public function getSlug()
    {
        return $this->slug;
    }
    
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');
        
        return $this;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
        
        return $this;
    }
    
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
