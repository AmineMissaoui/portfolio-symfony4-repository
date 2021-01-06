<?php

namespace App\Controller;

use App\Entity\PortfolioImages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PortfolioProject;

class PortfolioProjectController extends AbstractController
{
    /**
     * @Route("/portfolioProject", name="portfolioProject")
     */
    public function index(): Response
    {
        return $this->render('portfolioProject/listProject.html.twig', [
            'controller_name' => 'PortfolioProjectController',
        ]);
    }


    /**
     * @Route("/portfolioProject", name="portfolioProject")
     */
    public function listPortfolioProject()
    {
        $Project=$this->getDoctrine()->getRepository(PortfolioProject::class)->findAll();
        return $this->render("portfolioProject/listProject.html.twig",array('listProject'=>$Project));

    }

    /**
     * @Route("/detailPortfolioProject/{id}", name="detailPortfolioProject")
     */
    public function showPortfolioProject($id)
    {
        $Project=$this->getDoctrine()->getRepository(PortfolioProject::class)->find($id);
        return $this->render("portfolioProject/detailProject.html.twig",array('project'=>$Project));

    }
}
