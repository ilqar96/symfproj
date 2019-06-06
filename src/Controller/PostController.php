<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index()
    {
        $posts = $this->getDoctrine()->getManager()->getRepository(Post::class)->findBy([],['created_at'=>'desc']);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post/create", name="post_create")
     */

    public function create(Request $request){

        $post = new Post();

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class ,['attr'=>['class'=>'form-control']] )
            ->add('category', TextType::class,['attr'=>['class'=>'form-control']]  )
            ->add('body', TextareaType::class ,['attr'=>['class'=>'form-control']]  )
            ->add('save', SubmitType::class, ['label' => 'Create post' , 'attr'=>['class'=>'btn btn-primary mt-2']])
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreated_at(new \DateTime());
//            dump($post);exit();

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($post);
             $entityManager->flush();

            return $this->redirectToRoute('post');
        }
    

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);


    }
}

