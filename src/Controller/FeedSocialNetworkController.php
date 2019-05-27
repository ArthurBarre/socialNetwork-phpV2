<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Articles;

class FeedSocialNetworkController extends AbstractController
{
    /**
     * @Route("/feed", name="feed")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findAll();
        return $this->render('feed_social_network/index.html.twig', [
            'controller_name' => 'FeedSocialNetworkController',
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('feed_social_network/home.html.twig', [
            'title' => 'Bienvenue sur le feed',
    ]);
    }

    /**
     * @Route ("/feed/{id}", name="feed-show")
     */

    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $article = $repo->find($id);
        return $this->render('feed_social_network/show.html.twig', [
            'article'   => $article
        ]);
    }
}
