<?php
namespace Zertz\SortBundle\Model;

interface TagInterface
{
    /**
     * Sets the name
     *
     * @param string $name
     * 
     * @return self
     */
    public function setName($name);

    /**
     * Gets the name
     *
     * @return string 
     */
    public function getName();
    
    /**
     * Sets the slug
     *
     * @param string $slug
     * 
     * @return self
     */
    public function setSlug($slug);

    /**
     * Gets the slug
     *
     * @return string 
     */
    public function getSlug();
    
    /**
     * Gets the creation time
     * 
     * @return \DateTime
     */
    public function setCreatedAt();
    
    /**
     * Sets the creation time
     * 
     * @return \DateTime
     */
    public function getCreatedAt();
    
    /**
     * Sets the last updated time
     * 
     * @return \DateTime
     */
    public function setUpdatedAt();
    
    /**
     * Gets the last updated time
     * 
     * @return \DateTime
     */
    public function getUpdatedAt();
}
