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

                    $user->setNombre($name);
                    $user->setApellido($lastname);
                    $user->setCorreo($email);
                    $user->setContraseña($pass);
                    $user->setFechahora($date);

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
    public function inicio(){
        if ($_POST) {
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $temp = new TempUser();

            $pass = md5($password);

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

                    $temp->setNombre($user->getNombre());
                    $temp->setApellido($user->getApellido());
                    $temp->setCorreo($user->getCorreo());
                    $temp->setFechaIngreso($user->getFechahora());


                    $response = $this->forward('App\Controller\UserController::cuentaUser', array(
                        'name' => $temp->getNombre(), 
                        'lastname' => $temp->getApellido()
                    ));
                    return $response;
                }else{
                    dump("error no hay datos que conincidan"); die;
                }
            }

            
        }
    }

}
