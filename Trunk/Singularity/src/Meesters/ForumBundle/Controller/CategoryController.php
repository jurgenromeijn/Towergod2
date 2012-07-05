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
    
    public function showAction($id)
    {
        
	$categoryRepository = $this->getDoctrine()->getRepository("MeestersForumBundle:Category");
        
	$category = $categoryRepository->findOneById($id);
	
        if(!$category)
        {
            
            throw $this->createNotFoundException("Categorie kon niet gevonden worden");
            
        }
        
	return $this->render('MeestersForumBundle:Category:show.html.twig', array(
	    'category' => $category
	));
        
    }

}

?>