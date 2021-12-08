<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProjectType;

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
         * @Route("/portfolio/admin", name="portfolio_admin")
         */
        public function adminPanel(ProjectRepository $repo): Response
        {
            $repo = $this->getDoctrine()->getRepository(Project::class);
            $allProjects = $repo->findAll();
            
            return $this->render('portfolio/admin.html.twig', [
                'projets' => $allProjects
            ]);
        }

    /** 
    *@Route("/portfolio/new", name="portfolio_create")
    *@Route("/portfolio/{id}/edit", name="portfolio_edit")
    */
    public function form(Project $project = null, Request $request, ManagerRegistry $doctrine){
        $manager = $doctrine->getManager();
        
        if(!$project){
            $project = new Project();

        }

        // $form = $this->createFormBuilder($project)
        //              ->add('title')
        //              ->add('description')
        //              ->add('image')
        //              ->add('github')
        //              ->add('weblink')
                     
        //              ->getForm();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('portfolio_show', ['id' => $project->getId()]);
        }
        return $this->render('portfolio/create.html.twig',[
            'formProject' => $form->createView(),
            'editMode'    => $project->getId() !== null
        ]);
    }

    /**
     * @Route("/portfolio/{id}", name="portfolio_show")
     */
    public function show(Project $projet){
        
        
        return $this->render("portfolio/show.html.twig",[
            'projet'   => $projet,
            
        ]);
    }
    
    
    
    
}
