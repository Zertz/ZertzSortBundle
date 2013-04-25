<?php
namespace Zertz\SortBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zertz\SortBundle\Entity\Category;

class CategoryController extends Controller
{
    /**
     * @Route("/", name="categorie_liste")
     * @Template
     */
    public function listeAction()
    {
        $repo = $this->getDoctrine()->getRepository('ZertzSortBundle:Category');

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
        $repo = $this->getDoctrine()->getRepository('ZertzSortBundle:Category');
        
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
}
