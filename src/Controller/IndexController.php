<?php

namespace App\Controller;

use App\Entity\Userblog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use DateTimeZone;
use Nelmio\CorsBundle;
use Symfony\Component\HttpFoundation\Request;
use App\Models\TempUser;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(){
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/regext", name="registro")
    */
    public function registro(){
        if ($_POST) {
            $entityManager = $this->getDoctrine()->getRepository('App:Userblog');

            $name = $_REQUEST['name'];
            $lastname = $_REQUEST['lastname'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $confpassword = $_REQUEST['confpassword'];

            $date = new \DateTime('@'.strtotime('now'));
            $timezone = new DateTimeZone('America/Bogota');
            $date->setTimeZone($timezone);

            $arrayRegistro = array(
                'name' => $name,
                'lastname' => $lastname,
                'email' => $email,
                'password' => $password,
                'confPassword' => $confpassword
            );

            $user = $entityManager->findOneBy(
                array('correo' => $email)
            );

            if ($user !== null) {
                $this->addFlash('notice', 'El correo ya existe');
                return $this->render('index/erroresIndex.html.twig');
            }

            if (count(array_filter($arrayRegistro)) !== count($arrayRegistro)) {
                $this->addFlash('notice', 'Campos vacios en el formulario, imposible registrarse, vuelve a intentarlo');
                
                return $this->render('index/erroresIndex.html.twig', [
                    'controller_name' => 'IndexController',
                ]);
            }else{
                if ($password != $confpassword) {
                    $this->addFlash('notice', 'Las contraseñas no coinciden, imposible realizar el registro, vuelve a intentarlo');
                
                    return $this->render('index/erroresIndex.html.twig', [
                        'controller_name' => 'IndexController',
                    ]);
                }else{
                    $entityManager = $this->getDoctrine()->getManager();
                    $user = new Userblog();

                    $pass = md5($password);
                    $encor = md5($email);

                    $user->setNombre($name);
                    $user->setApellido($lastname);
                    $user->setCorreo($email);
                    $user->setContraseña($pass);
                    $user->setFechahora($date);
                    $user->setEncor($encor);

                    $entityManager->persist($user);
                    $entityManager->flush();

                    $message = "Usuario Registrado Exitosamente " . $user->getNombre();
                    return $this->redirectToRoute('index', array('message' => $message));
                }
            }
        }
    }

    /**
     * @Route("/blogWeb", name="log") 
    */
    public function inicio(TempUser $temp){
        if ($_POST) {
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            $pass = md5($password);
            $encor = md5($email);

            $arrayInicio = array(
                'email' => $email, 'password' => $password
            );

            if (count(array_filter($arrayInicio)) !== count($arrayInicio)) {

                $this->addFlash('notice', 'Error al intentar iniciar sessión campos vacios o no completos en el formulario');;
                
                return $this->render('index/erroresIndex.html.twig', [
                    'controller_name' => 'IndexController',
                ]);

            }else{
                $entityManager = $this->getDoctrine()->getRepository('App:Userblog');

                $user = $entityManager->findOneBy(
                    array('correo' => $email, 'contraseña' => $pass)
                );

                if ($user != null) {

                    $token = $this->forward('App\Models\TempUser::user', array('email' => $encor));

                    dump($temp::user); die;

                    $response = $this->forward('App\Controller\UserController::cuentaUser');
                    return $response;
                }else{
                    dump("error no hay datos que conincidan"); die;
                }
            }

            
        }
    }

}
