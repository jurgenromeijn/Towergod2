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
    public function showAction($id)
    {
        
        $forumRepository = $this->getDoctrine()->getRepository("MeestersForumBundle:Forum");
        
        $forum = $forumRepository->findOneById($id);
                
        if(!$forum)
        {
            
            throw $this->createNotFoundException($this->get('translator')->trans('forum.display.error.not_found'));
            
        }
        
	return $this->render('MeestersForumBundle:Forum:show.html.twig', array(
	    'forum' => $forum
	));
        
    }

}

?>