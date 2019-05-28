<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++)
        {
            $articles = new Articles();
            $articles     ->setTitle("Titre de l'article $i");
            $articles     ->setContent("Contenu de l'article $i");
            $articles     ->setImage("http://placehold.it/350x150");
            $articles     ->setCreatedAt(new \DateTime());

            $manager->persist($articles);
        }

        $manager->flush();
    }
}
