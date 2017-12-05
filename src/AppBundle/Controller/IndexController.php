<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller
{

    /**
     * @Route("/", name="app_index")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('app_forum_index');
    }
}