<?php

namespace Meesters\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Meesters\ForumBundle\Entity\Post;

use Meesters\ForumBundle\Form\PostType;

/**
 * Description of PostController
 *
 * @author Jurgen
 */
class PostController extends Controller 
{

    public function newAction($topicId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $topic = $entityManager->getRepository("MeestersForumBundle:Topic")->findOneById($topicId);
        
        if (!$topic) {
            throw $this->createNotFoundException($this->get('translator')->trans('topic.display.error.not_found'));
        }
        
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);
        
        return $this->render('MeestersForumBundle:Post:new.html.twig', array(
            'post'  => $post,
            'topic' => $topic,
            'form'  => $form->createView(),
        ));
    }
    
    public function createAction($topicId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $topic = $entityManager->getRepository("MeestersForumBundle:Topic")->findOneById($topicId);
        
        if (!$topic) {
            throw $this->createNotFoundException($this->get('translator')->trans('topic.display.error.not_found'));
        }
        
        $user = $this->get('security.context')->getToken()->getUser();
        
        // Create form
        $post    = new Post();
        $post->setUser($user);
        $post->setTopic($topic);
        $topic->addPost($post);
        
        $request = $this->getRequest();
        $form    = $this->createForm(new PostType(), $post);
        $form->bindRequest($request);
        
        if ($form->isValid()) 
        {
            $entityManager->persist($post);
            $entityManager->persist($topic);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('MeestersForumBundle_TopicShow', array('id' => $topic->getId())));
        }
        
        return $this->render('MeestersForumBundle:Post:new.html.twig', array(
            'post'  => $post,
            'topic' => $topic,
            'form'  => $form->createView(),
        ));
    }
    
    public function editAction($id)
    {
        
    }
    
    public function updateAction($id)
    {
        
    }
    
    public function deleteAction($id)
    {
    
    }

}

?>