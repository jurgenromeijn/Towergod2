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
            throw $this->createNotFoundException($this->get('translator')->trans('topic.display.error.not_found'));
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
            
            throw $this->createNotFoundException($this->get('translator')->trans('forum.display.error.not_found'));
            
        }
        
        // Handle entities
        $topic = new Topic();
        
        // Create form
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
            
            throw $this->createNotFoundException($this->get('translator')->trans('forum.display.error.not_found'));
            
        }
        
        $user = $this->get('security.context')->getToken()->getUser();
        
        //Handle entities
        $topic   = new Topic();
        
        //Create form
        $request = $this->getRequest();
        $form    = $this->createForm(new TopicType(), $topic);
        $form->bindRequest($request);

        if ($form->isValid()) 
        {
            $topic->setUser($user);
            $topic->setForum($forum);
            $post    = $topic->getFirstPost();
            $post->setUser($user);
            $post->setTopic($topic);
            $topic->addPost($post);
            
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
            throw $this->createNotFoundException($this->get('translator')->trans('topic.display.error.not_found'));
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
            throw $this->createNotFoundException($this->get('translator')->trans('topic.display.error.not_found'));
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

        if (!$topic) 
        {
            throw $this->createNotFoundException($this->get('translator')->trans('topic.display.error.not_found'));
        }
        
        $forum = $topic->getForum();
        
        if ($form->isValid()) 
        {
            
            $forum = $topic->getForum();
            
            $forumLastPost = $forum->getLastPost();
            $forumPostCount = $forum->getPostCount();
            $forumTopicCount = $forum->getTopicCount();
            
            $forumLastPostNeedsUpdate = false;
            
            if(!$forumLastPost || $topic->getPosts()->exists(function($key, Post $post) use ($forumLastPost)
                {
                    return ($forumLastPost != null &&($forumLastPost->getId() == $post->getId()));
                }))
            {
                $forum->setLastPost(null);
                $forumLastPostNeedsUpdate = true;
            }
            
            var_dump($forumLastPostNeedsUpdate);
            
            // Have to delete the post entity in 2 goes because of all the conflicting relations
            $topic->setFirstPost(null);
            $topic->setLastPost(null);
                        
            foreach ($topic->getPosts() as $post) 
            {
                $forumPostCount--;
                $entityManager->remove($post);
            }
            $entityManager->flush();
            
            $forumTopicCount--;
            $forum->setPostCount($forumPostCount);
            
            if($forumLastPostNeedsUpdate)
            {
                $postRepository = $this->getDoctrine()->getRepository("MeestersForumBundle:Post");
                $lastPost = $postRepository->findOneLastPostForForum($forum->getId());
                
                var_dump($lastPost);
                
                $forum->setLastPost($lastPost);
            }
            
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

?>