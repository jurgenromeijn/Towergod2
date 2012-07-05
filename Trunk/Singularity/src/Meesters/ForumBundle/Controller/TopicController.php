<?php

namespace Meesters\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Meesters\ForumBundle\Entity\Topic;
use Meesters\ForumBundle\Entity\Post;
use Meesters\ForumBundle\Form\TopicType;

/**
 * Topic controller.
 *
 */
class TopicController extends Controller
{
    
    /**
     * Finds and displays a Topic entity.
     *
     */
    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $topic = $entityManager->getRepository('MeestersForumBundle:Topic')->find($id);

        if (!$topic) {
            throw $this->createNotFoundException('Topic kon niet gevonden worden.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MeestersForumBundle:Topic:show.html.twig', array(
            'topic'       => $topic,
            'delete_form' => $deleteForm->createView(),     
        ));
    }

    /**
     * Displays a form to create a new Topic entity.
     *
     */
    public function newAction($forumId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $forum = $entityManager->getRepository("MeestersForumBundle:Forum")->findOneById($forumId);
        
        if(!$forum)
        {
            
            throw $this->createNotFoundException('Forum kon niet gevonden worden');
            
        }
        
        //Create form
        $topic = new Topic();
        $post  = new Post();
        $topic->addPost($post);
        $form   = $this->createForm(new TopicType(), $topic);

        return $this->render('MeestersForumBundle:Topic:new.html.twig', array(
            'topic' => $topic,
            'forum' => $forum,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Topic entity.
     *
     */
    public function createAction($forumId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $forum = $entityManager->getRepository("MeestersForumBundle:Forum")->findOneById($forumId);
        
        if(!$forum)
        {
            
            throw $this->createNotFoundException('Forum kon niet gevonden worden');
            
        }
        
        $user = $this->get('security.context')->getToken()->getUser();
        
        //Create form
        $topic   = new Topic();
        $topic->setUser($user);
        $topic->setForum($forum);
        $post    = new Post();
        $post->setUser($user);
        $post->setTopic($topic);
        $topic->addPost($post);
        $request = $this->getRequest();
        $form    = $this->createForm(new TopicType(), $topic);
        $form->bindRequest($request);

        $topic->getPosts()->first()->setEditUser($user);
        
        if ($form->isValid()) 
        {
            $entityManager->persist($topic);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('MeestersForumBundle_TopicShow', array('id' => $topic->getId())));
        }

        return $this->render('MeestersForumBundle:Topic:new.html.twig', array(
            'entity' => $topic,
            'forum' => $forum,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Topic entity.
     *
     */
    public function editAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $topic = $entityManager->getRepository('MeestersForumBundle:Topic')->find($id);

        if(!$topic)
        {
            throw $this->createNotFoundException('Unable to find Topic entity.');
        }

        $editForm = $this->createForm(new TopicType(), $topic);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MeestersForumBundle:Topic:edit.html.twig', array(
            'topic'       => $topic,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Topic entity.
     *
     */
    public function updateAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $topic = $entityManager->getRepository('MeestersForumBundle:Topic')->find($id);

        if (!$topic) {
            throw $this->createNotFoundException('Unable to find Topic entity.');
        }

        $editForm   = $this->createForm(new TopicType(), $topic);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid())
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $topic->getPosts()->first()->setEditUser($user);
            
            $entityManager->persist($topic);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('MeestersForumBundle_TopicShow', array('id' => $id)));
        }

        return $this->render('MeestersForumBundle:Topic:edit.html.twig', array(
            'topic'       => $topic,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Topic entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        $entityManager = $this->getDoctrine()->getManager();
        $topic = $entityManager->getRepository('MeestersForumBundle:Topic')->find($id);

        if (!$topic) {
            throw $this->createNotFoundException('Unable to find Topic entity.');
        }
        
        $forum = $topic->getForum();
        
        if ($form->isValid()) 
        {
            
            $entityManager->remove($topic);
            $entityManager->flush();
            
        }

        return $this->redirect($this->generateUrl('MeestersForumBundle_ForumShow', array('id' => $forum->getId())));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
