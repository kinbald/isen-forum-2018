<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Forum;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Topic;

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
     */
    public function addAction(int $forum_id, Request $request)
    {
        $forum = $this->getDoctrine()
            ->getRepository(Forum::class)
            ->find($forum_id);
        
        if ($request->isMethod('post')) {
            $topic = new Topic();
            
            $topic->setTitle($request->get('title'));
            $topic->setAuthor($request->get('author'));
            $topic->setCreation(new \DateTime());
            $topic->setForum($forum);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($topic);
            $em->flush();
            
            return $this->redirectToRoute('app_forum_show', [
                'id' => $forum->getId()
            ]);
        }
        
        return $this->render('AppBundle:Topic:add.html.twig', array(
            'forum' => $forum
        ));
    }
}
