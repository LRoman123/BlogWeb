<?php

namespace App\Controller;

use App\Entity\Userblog;
use App\Entity\Notas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class UserController extends AbstractController{

    /**
    * @Route("/blogweb/user", name="loguser")
    */
    public function cuentaUser(Request $request, $name, $lastname){

        dump($name);
        dump($lastname);
        die;

        return $this->render('indexUser/indexUser.html.twig', array('name' => $nombre));
    }


    /**
     * @Route("/blogweb/notes", name="notas")
    */
    public function notasUser(){
        $entityManager = $this->getDoctrine()->getEntityManager();
        $user = $entityManager->getRepository('App:Userblog')->findAll();

        dump($user); die;
    }
}
