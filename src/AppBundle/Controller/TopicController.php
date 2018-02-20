<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Forum;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Topic;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\TopicType;

/**
 * @Route("/forum/{forum_id}/topic", requirements={"forum_id": "\d+"})
 */
class TopicController extends Controller
{

    /**
     * @Route("/remove/{id}", requirements={"id": "\d+"}, name="app_topic_remove")
     */
    public function removeAction(int $forum_id, int $id)
    {
        $post = $this->getDoctrine()
            ->getRepository(Topic::class)
            ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        
        return $this->redirectToRoute('app_forum_show', [
            'id' => $forum_id
        ]);
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"}, name="app_topic_show")
     */
    public function indexAction(int $forum_id, int $id)
    {
        return $this->render('AppBundle:Topic:index.html.twig', array(
            'topic' => $this->getDoctrine()
                ->getRepository(Topic::class)
                ->find($id)
        ));
    }

    /**
     * @Route("/add", name="app_topic_add")
     * @Route("/edit/{id}", name="app_topic_edit")
     * @ParamConverter("forum", options={"id" = "forum_id"})
     * @ParamConverter("topic", options={"id" = "id"})
     */
    public function addAction(Request $request, Forum $forum, Topic $topic = null)
    {
        if ($topic === null) {
            $topic = new Topic();
        }
        
        $form = $this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // champs externes au formulaire
            $topic->setForum($forum);
            $topic->setCreation(new \DateTime());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($topic);
            $em->flush();
            
            return $this->redirectToRoute('app_forum_show', [
                'id' => $forum->getId()
            ]);
        }
        
        return $this->render('AppBundle:Topic:add.html.twig', array(
            'form' => $form->createView(),
            'forum' => $forum
        ));
    }
}
