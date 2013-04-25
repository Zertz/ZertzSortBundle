<?php

namespace Zertz\SortBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table("Category")
 * @ORM\Entity(repositoryClass="Zertz\SortBundle\Entity\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
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

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;
    
    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @var int $rgt
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;
    
    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="ID", onDelete="SET NULL")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;
    
    public function __toString() {
        return $this->name ?: '';
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get Name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function getIndentedName()
    {
        return str_repeat(
            html_entity_decode('-&nbsp;', ENT_QUOTES, 'UTF-8'),
            $this->getLevel()
        ) . $this->getName();
    }
    
    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->lvl;
    }

    /**
     * Set Slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get Slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;    
    }

    public function getParent()
    {
        return $this->parent;   
    }

    public function getRoot()
    {
        return $this->root;   
    }
}
