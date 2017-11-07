<?php
namespace AppBundle\Repository;

class ForumRepository
{

    private static $file = 'data/forums.dat';

    public function getAll()
    {
        // test si le fichier existe déjà
        if (file_exists(static::$file) === false) {
            // si ce n'est pas le cas, il n'y a pas de forum
            return [];
        }
        
        // sinon, charge le fichier
        $content = file_get_contents(static::$file);
        
        // et le retourne désérialisé
        return unserialize($content);
    }

    public function saveAll($forums)
    {
        // crée le répertoire si ce n'est pas déjà fait
        @mkdir(dirname(static::$file), 0777, true);
        
        // et stocke les données sérialisées
        file_put_contents(static::$file, serialize($forums));
    }

    public function save($idForum, $forum)
    {
        $forums = $this->getAll();
        $forums[$idForum] = $forum;
        $this->saveAll($forums);
    }

    public function add($forum)
    {
        // récupère tous les forums
        $forums = $this->getAll();
        
        // ajoute le nouveau
        $forums[uniqid()] = $forum;
        
        // et sauvegarde le tout
        $this->saveAll($forums);
    }

    public function get($id)
    {
        return $this->getAll()[$id];
    }

    public function addPost($idForum, $post)
    {
        $forum = $this->get($idForum);
        $posts = $forum->getPosts();
        $posts[] = $post;
        $forum->setPosts($posts);
        
        $this->save($idForum, $forum);
    }
}