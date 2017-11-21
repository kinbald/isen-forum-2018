<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Forum;

/**
 * @Route("/forum")
 */
class ForumController extends Controller
{

    /**
     * @Route("/")
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
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Forum:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function showAction($id)
    {
        return $this->render('AppBundle:Forum:show.html.twig', array(
            // ...
        ));
    }
}
