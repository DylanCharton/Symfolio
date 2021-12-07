<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(ProjectRepository $repo): Response
    {
        $repo = $this->getDoctrine()->getRepository(Project::class);
        $allProjects = $repo->findAll();
        return $this->render('portfolio/index.html.twig', [
            'controller_name' => 'PortfolioController',
            'projets'         => $allProjects
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('portfolio/home.html.twig');
    }
    /**
     * @Route("/portfolio/{id}", name="portfolio_show")
     */
    public function show(Project $projet){
        
        
        return $this->render("portfolio/show.html.twig",[
            'projet' => $projet
        ]);
    }
}
