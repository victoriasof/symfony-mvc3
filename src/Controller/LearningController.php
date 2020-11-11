<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LearningController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    //dependency injection


    /**
     * @Route("/learning", name="learning")
     */
    /*public function index(): Response
    {
        return $this->render('learning/index.html.twig', [
            'controller_name' => 'LearningController',
        ]);
    }*/

    /**
     * @Route("/about-becode", name="aboutme")
     */
    public function aboutMe(): Response
    {
        $name = 'Unknown';
        if(!empty($this->session->get('name'))){
            $name = $this->session->get('name');
        }else {
            return $this->forward('App\Controller\LearningController::showMyName');
        }
        return $this->render('learning/about-me.html.twig', [
            'name' => $name
        ]);
        //return $this->render('learning/about-me.html.twig', [
            //'name' => 'Victoria',
            //'myArray' => ['One', 'Two', 'Three']
        //]);
    }


    /**
     * @Route("/", name="showname")
     */
    public function showMyName(): Response
    {
        $name = 'Unknown';
        if(!empty($this->session->get('name'))){
            $name = $this->session->get('name');
        }
        return $this->render('learning/index.html.twig', [
            'name' => $name
        ]);
    }

    /**
     * @Route("/change-name", name="changeName")
     */
    public function changeMyName(): Response
    {
        $request = Request::createFromGlobals();
        if (!$request->isMethod('POST')) {
            return $this->redirectToRoute('showname');
        }

        $name = $request->request->get('name');
        //$this->session->get('name');
        $this->session->set('name', $name);
        return $this->redirectToRoute('showname');
    }


}
