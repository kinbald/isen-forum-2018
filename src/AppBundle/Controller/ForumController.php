<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Repository\ForumRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Forum;
use AppBundle\Entity\Post;

class ForumController extends Controller
{

    /**
     * @Route("/", name="app_forum")
     */
    public function indexAction()
    {
        $repository = new ForumRepository();
        
        return $this->render('AppBundle:ForumController:index.html.twig', array(
            'forums' => $repository->getAll()
        ));
    }

    /**
     * @Route("/add", name="app_forum_add")
     */
    public function addAction(Request $request)
    {
        // récupère le nom du nouveau forum
        $forumName = $request->get('title');
        
        // créee le nouveau forum
        $forum = new Forum();
        $forum->setTitle($forumName);
        
        // ajoute le forum
        $repository = new ForumRepository();
        $repository->add($forum);
        
        // redirige vers la page d'accueil
        return $this->redirectToRoute('app_forum');
    }

    /**
     * @Route("/{id}", name="app_forum_detail")
     */
    public function showAction(string $id)
    {
        // récupère le forum
        $repository = new ForumRepository();
        
        return $this->render('AppBundle:ForumController:show.html.twig', array(
            'forum' => $repository->get($id),
            'forumId' => $id
        ));
    }

    /**
     * @Route("/post_add/{id}", name="app_forum_add_post")
     */
    public function addPost(Request $request, string $id)
    {
        // crée le nouveau post, et copie les données
        $post = new Post();
        $post->setTitle($request->get('title'));
        $post->setAuthor($request->get('author'));
        $post->setDate($request->get('date'));
        $post->setContent($request->get('content'));
        
        $repository = new ForumRepository();
        $repository->addPost($id, $post);
        
        // redirige vers le forum
        return $this->redirectToRoute('app_forum_detail', [
            'id' => $id
        ]);
    }
}
