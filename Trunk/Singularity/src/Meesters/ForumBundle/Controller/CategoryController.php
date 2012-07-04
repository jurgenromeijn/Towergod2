<?php

namespace Meesters\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of CategoryController
 *
 * @author Jurgen
 */
class CategoryController extends Controller {

    public function indexAction() 
    {
	
	$categoryRepository = $this->getDoctrine()->getRepository("MeestersForumBundle:Category");
	
	$categories = $categoryRepository->findAll();
	
	return $this->render('MeestersForumBundle:Category:index.html.twig', array(
	    'categories' => $categories
	));
	
    }
    
    public function viewAction($name)
    {
        
	$categoryRepository = $this->getDoctrine()->getRepository("MeestersForumBundle:Category");
        
	$category = $categoryRepository->findOneByName($name);
	
        if($category === null)
        {
            
            throw $this->createNotFoundException("Categorie kon niet gevonden worden");
            
        }
        
	return $this->render('MeestersForumBundle:Category:view.html.twig', array(
	    'category' => $category
	));
        
    }

}

?>