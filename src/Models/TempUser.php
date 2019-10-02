<?php

namespace App\Models;

use App\Entity\Userblog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TempUser extends AbstractController{

    private $name;
    private $lastname;
    private $email;
    private $date;

    public function user($email){
        $entityManager = $this->getDoctrine()->getRepository('App:Userblog');
        $user = $entityManager->findOneBy(array('encor' => $email));
        
        $name = $user->getNombre();
        $lastname = $user->getApellido();
        $email = $user->getCorreo();
        $date = $user->getFechahora();

        return array(
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'date' => $date
        );
        

    }

}
