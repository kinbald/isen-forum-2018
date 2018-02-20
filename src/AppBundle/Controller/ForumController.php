<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Forum;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ForumType;

/**
 * @Route("/forum")
 */
class ForumController extends Controller
{

    /**
     * @Route("/", name="app_forum_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Forum:index.html.twig', array(
            'forums' => $this->getDoctrine()
                ->getRepository(Forum::class)
                ->findAll()
        ));
    }

    /**
     * @Route("/add", name="app_forum_add")
     * @Route("/edit/{id}", name="app_forum_edit")
     */
    public function addAction(Request $request, Forum $forum = null)
    {
        if ($forum === null) {
            $forum = new Forum();
        }
        
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // get the manager
            $em = $this->getDoctrine()->getManager();
            
            // persist the new forum
            $em->persist($forum);
            
            // and flush entity manager
            $em->flush();
            
            return $this->redirectToRoute('app_forum_index');
        }
        
        return $this->render('AppBundle:Forum:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"}, name="app_forum_show")
     */
    public function showAction(int $id)
    {
        return $this->render('AppBundle:Forum:show.html.twig', array(
            'forum' => $this->getDoctrine()
                ->getRepository(Forum::class)
                ->find($id)
        ));
    }
}
