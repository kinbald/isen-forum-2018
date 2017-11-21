<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/forum/{forum_id}/topic", requirements={"forum_id": "\d+"})
 */
class TopicController extends Controller
{

    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function indexAction(int $forum_id, int $id)
    {}

    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Topic:add.html.twig', array(
            // ...
        ));
    }
}
