<?php
namespace Zertz\SortBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Zertz\SortBundle\Model\TagInterface;

class Tag implements TagInterface
{
    protected $name;
    
    /**
     * @Gedmo\Slug(fields={"name"}, updatable=true, unique=true, separator="-", style="default")
     */
    protected $slug;
    
    /**
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;
    
    /**
     * @Gedmo\Timestampable(on="update")
     */
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
