<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeeController extends AbstractController
{
    /**
     * @Route("/homee", name="homee")
     */
    public function index()
    {
        return $this->render('homee/index.html.twig', [
            'controller_name' => 'HomeeController',
        ]);
    }
}
