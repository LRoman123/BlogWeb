<?php

namespace App\Controller;

use App\Entity\Userblog;
use App\Entity\Notas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Models\TempUser;


class UserController extends AbstractController{

    /**
    * @Route("/blogweb/user", name="loguser")
    */
    public function cuentaUser(Request $request, TempUser $temp){

        dump($temp->getNombre());
        dump($temp->getApellido());
        die;

        return $this->render('indexUser/indexUser.html.twig');
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
