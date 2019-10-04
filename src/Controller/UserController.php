<?php

namespace App\Controller;

use App\Entity\Userblog;
use App\Entity\Notas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Models\TempUser;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class UserController extends AbstractController{

    private $session;

    public function __construct(SessionInterface $session){
        $this->session = $session;
    }

    public function cuentaUser($encor){
        $this->session->set('encript', $encor);
        $encript = $this->session->get('encript');

        $token = $this->forward('App\Models\TempUser::user', array('email' => $encript));
        $dato = json_decode($token->getContent(), true);

        return $this->render('indexUser/indexUser.html.twig', array('dato' => $dato));
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
