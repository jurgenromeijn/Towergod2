<?php

namespace Meesters\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of ForumController
 *
 * @author Jurgen
 */
class ForumController extends Controller 
{    
    public function viewAction($name)
    {
        
        $forumRepository = $this->getDoctrine()->getRepository("MeestersForumBundle:Forum");
        
        $forum = $forumRepository->findOneByName($name);
                
        if($forum === null)
        {
            
            throw $this->createNotFoundException("Forum kon niet gevonden worden");
            
        }
        
	return $this->render('MeestersForumBundle:Forum:view.html.twig', array(
	    'forum' => $forum
	));
        
    }

}

?>