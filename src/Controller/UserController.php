<?php

namespace App\Controller;

use App\Entity\Userblog;
use App\Entity\Notas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController{

    /**
     * @Route("/blogweb/notes", name="notas")
    */
    public function notasUser(){
        $entityManager = $this->getDoctrine()->getEntityManager();
        $user = $entityManager->getRepository('App:Userblog')->findAll();

        dump($user); die;
    }
}
