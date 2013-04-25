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

There are very few requirements to get the bundle up and running, the most
important being a working installation of Symfony 2.

2) Installation
----------------------------------

### Using Composer

In your composer.json, add the following line:

    "require": {
        ...,

        "stof/doctrine-extensions-bundle": "dev-master",

        "zertz/sort-bundle": "dev-master"
    }

You will then need to run an update:

    php composer.phar update

3) Configuration
----------------------------------

### AppKernel.php

In your AppKernel, you need to include these dependencies:

    public function registerBundles()
    {
        $bundles = array(
            ...,

            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

            new Zertz\SortBundle\ZertzSortBundle()
        );
        ...
    }

4) Database
----------------------------------

To update your schema, run the following command:

    php app/console doctrine:schema:update --force

5) Usage
----------------------------------

The bundle provides services through which data can be fetched as well as
helpers for common needs.

In your controller, you can add a function to get the service:

    protected function getSortManager()
    {
        return $this->container->get('zertz.manager.sort');
    }

* Add an example for showing a category tree

It is up to you to implement the fetching of objects using categories and tags.
Here is a simple example of a repository function:

    public function findByTag(\Zertz\SortBundle\Entity\Tag $tag)
    {
        return $this->getEntityManager()->getRepository('ZertzBlogBundle:Post')->createQueryBuilder('p')
            ->select('p')
            ->where('p.published = TRUE AND p.slug = :slug')
            ->innerJoin('ZertzBlogBundle:PostTag', 'pt', 'WITH', 'p.id = pt.post')
            ->innerJoin('ZertzSortBundle:Tag', 't', 'WITH', 't.id = :tag')
            ->setParameter('tag', $tag)
            ->getQuery()
            ->getResult();
    }

...
