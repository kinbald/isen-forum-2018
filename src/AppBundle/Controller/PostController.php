<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Topic;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

/**
 * @Route("/forum/{forum_id}/topic/{topic_id}/post", requirements={"forum_id": "\d+", "topic_id": "\d+"})
 */
class PostController extends Controller
{

    /**
     * @Route("/remove/{id}", requirements={"id": "\d+"}, name="app_post_remove")
     */
    public function removeAction(int $forum_id, int $topic_id, int $id)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        
        return $this->redirectToRoute('app_topic_show', [
            'forum_id' => $forum_id,
            'id' => $topic_id
        ]);
    }

    /**
     * @Route("/add", name="app_post_add")
     */
    public function addAction(Request $request, int $topic_id)
    {
        if ($request->isMethod('post') === true) {
            $topic = $this->getDoctrine()
                ->getRepository(Topic::class)
                ->find($topic_id);
            
            // create the new post, and copy values from the form
            $post = new Post();
            $post->setCreation(new \DateTime());
            $post->setAuthor($request->get('author'));
            $post->setContent($request->get('content'));
            
            // then set topic
            $post->setTopic($topic);
            
            // persist and flush
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            
            return $this->redirectToRoute('app_topic_show', [
                'forum_id' => $topic->getForum()
                    ->getId(),
                'id' => $topic->getId()
            ]);
        }
        
        return $this->render('AppBundle:Post:add.html.twig', array(
            'topic' => $this->getDoctrine()
                ->getRepository(Topic::class)
                ->find($topic_id)
        ));
    }
}
