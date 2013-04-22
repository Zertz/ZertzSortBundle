<?php

namespace Zertz\SearchBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zertz\SearchBundle\Entity\Category;
use Zertz\EntrepriseBundle\Entity\Entreprise;

class CategoryController extends Controller
{
    /**
     * @Route("/", name="categorie_liste")
     * @Template
     */
    public function listeAction()
    {
        $repo = $this->getDoctrine()->getRepository('ZertzSearchBundle:Category');

        $self = $this;
        $options = array(
            'html' => true,
            'decorate' => true,
            'nodeDecorator' => function($node) use ($self) {
                return '<a href="'.$self->generateUrl('categorie', array('id' => $node['id'], 'slug' => $node['slug'])).'">'.$node['nom'].'</a>';
            },
            'rootOpen' => '<ul class="categorie">',
            'rootClose' => '</ul>',
            'childStart' => '<li>',
            'childClose' => '</li>',
            'childSort' => 'asc',
        );
        
        $categories = $repo->childrenHierarchy(null, false, $options);
        
        return array(
            'categories' => $categories,
        );
    }
    
    /**
     * @Route("/{id}/{slug}", name="categorie")
     * @Template
     */
    public function categorieAction($id, $slug)
    {
        $repo = $this->getDoctrine()->getRepository('ZertzSearchBundle:Category');
        
        $parents = null;
        $entreprises = null;
        $interet = 0;
        
        $categorie = $repo->findOneById($id);
        if ($categorie) {
            // Si le slug est vide ou incorrect, redirige sur la bonne URL
            if (empty($slug) || $slug != $categorie->getSlug()) {
                return $this->redirect($this->generateUrl(
                        'categorie', array(
                            'id' => $id,
                            'slug' => $categorie->getSlug()
                )));
            }

            $parents = $repo->getPath($categorie);
            $entreprises = $this->getEntreprises($categorie);
        } else {
            return $this->redirect($this->generateUrl('categorie_liste'));
        }
        
        return array(
            'categorie' => $categorie,
            'parents' => $parents,
            'entreprises' => $entreprises
        );
    }
    
    public function getEntreprises($categorie)
    {
        $repo = $this->getDoctrine()->getRepository('ZertzEntrepriseBundle:Entreprise');
        
        return $repo->findBy(
            array(
                'categorie' => $categorie,
                'statut' => Entreprise::STATUT_ACTIVE
            ),
            array(
                'nom' => 'ASC'
            )
        );
    }
}