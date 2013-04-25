<?php

namespace Zertz\SortBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(name="ID", type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="Name", type="string", length=45)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"}, updatable=true, unique=false, separator="-", style="default")
     * @ORM\Column(name="Slug", type="string", length=45)
     */
    private $slug;
    
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
}
