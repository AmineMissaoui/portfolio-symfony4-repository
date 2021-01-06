<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\PortfolioProject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $Project=$this->getDoctrine()->getRepository(PortfolioProject::class)->findAll();
        $BlogPost=$this->getDoctrine()->getRepository(BlogPost::class)->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'listProjectHome'=>$Project, 'listBlogHome'=>$BlogPost
        ]);
    }
    // /**
    //  * @Route("home/portfolio", name="homePortfolio")
    //  */
    // public function listPortfolioProject()
    // {
    //     $Project=$this->getDoctrine()->getRepository(PortfolioProject::class)->findAll();
    //     $BlogPost=$this->getDoctrine()->getRepository(BlogPost::class)->findAll();
    //     return $this->render("home/index.html.twig",array('listProjectHome'=>$Project, 'listBlogHome'=>$BlogPost));

    // }

}
