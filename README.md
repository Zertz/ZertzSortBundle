ZertzSortBundle
========================

WARNING: Not ready for prime-time, still in very early development

This bundle provides category and tag support built on top of Symfony2.

### Features
- Nested set model category tree
- Tags

### Upcoming features
- Category groups
- Location tagging

1) Requirements
----------------------------------

1. Symfony 2.2 Although it wasn't tested, it should also work with 2.1
2. Doctrine 2

2) Installation
----------------------------------

### Using Composer

In composer.json, add:

    "require": {
        "zertz/sort-bundle": "dev-master"
    }

Run an update to download the bundle:

    php composer.phar update zertz/sort-bundle

3) Configuration
----------------------------------

### AppKernel.php

Enable the bundle:

    public function registerBundles()
    {
        $bundles = array(
            new Zertz\SortBundle\ZertzSortBundle(),
        );
    }

### Extend the Tag class

This bundle provides the basics for persisting a tag object to the database. It
is your role however to extend the Tag class and add any fields you deem useful.

To get started, your entity class should look like this:

    <?php
    // src/Acme/SortBundle/Entity/Tag.php
    
    namespace Acme\SortBundle\Entity;
    
    use Doctrine\ORM\Mapping as ORM;
    use Zertz\SortBundle\Entity\Tag as BaseTag;

    /**
     * @ORM\Entity
     * @ORM\Table(name="zertz_sort__tag")
     */
    class Tag extends BaseTag
    {
        /**
         * @ORM\Column(name="id", type="integer", nullable=false)
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        public function __construct() {
            parent::__construct();
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
    }

Finally, run the following command to update the database schema:

    php app/console doctrine:schema:update --force

4) Usage
----------------------------------

...