<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index()
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @Route("/post/create", name="post_create")
     */

    public function create(){

        $task = new Post();

        $form = $this->createFormBuilder($task)
            ->add('title', TextType::class)
            ->add('body', TextAreaType::class)
            ->add('category', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create post'])
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
            
    
            return $this->redirectToRoute('post');
        }
    

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);


    }
}

