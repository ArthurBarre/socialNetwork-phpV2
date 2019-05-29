<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Staff;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Articles;
class FeedSocialNetworkController extends AbstractController
{


    /**
     * @Route("/", name="home")
     */
    public function home(Request $request, ObjectManager $manager)
    {

        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->classByDate();
        $article = new Articles();
        $form = $this->createFormBuilder($article)

            ->add('content', TextareaType::class, [
                'attr'=> [
                    'placeholder'=>'Ajoutez le contenu a votre article',
                    'class'=>'form-control'
                ]
            ])

            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $article->setCreatedAt(new \DateTime());
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('feed_social_network/home.html.twig', [
            'controller_name' => 'FeedSocialNetworkController',
            'title' => 'Bienvenue sur le feed',
            'articles'=> $articles,
            'formArticle'=>$form->createView()
        ]);

        return $this->render('feed_social_network/create.html.twig', [
            'formArticle'=>$form->createView()
        ]);
    }
    /**
     * @Route ("/feed/new", name="feed-create")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $article = new Articles();
        $form = $this->createFormBuilder($article)

            ->add('content', TextareaType::class, [
                'attr'=> [
                    'placeholder'=>'Ajoutez le contenu a votre article',
                    'class'=>'form-control'
                ]
            ])

            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $article->setCreatedAt(new \DateTime());
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('feed-show', ['id'=> $article->getId()]);
        }
        return $this->render('feed_social_network/create.html.twig', [
            'formArticle'=>$form->createView()
        ]);
    }



    /**
     * @Route ("/staff", name="staff-show")
     */
    public function staffShow()
    {
        $repo = $this->getDoctrine()->getRepository(Staff::class);
        $staffs = $repo->findAll();
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();
        return $this->render('feed_social_network/staff.html.twig', [
            'users' => $users,
            'staffs'=>$staffs
        ]);
    }
}
