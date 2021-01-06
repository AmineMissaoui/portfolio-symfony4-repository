<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\PortfolioImages;
use App\Entity\PortfolioProject;
use App\Form\BlogPostType;
use App\Form\PortfolioFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/portfolio", name="portfolioDasboard")
     */
    public function listPortfolioProjectDashboard()
    {
        $Project=$this->getDoctrine()->getRepository(PortfolioProject::class)->findAll();
        return $this->render("/admin/portfolio.html.twig",array('listProjectDashboard'=>$Project));
    }
    /**
     * @Route("/addPortfolioProject", name="addPortfolioProject")
     */
    public function addPortfolioProject(Request $request){
        
        $PortfolioProject = new PortfolioProject();
        $formProject = $this->createForm(PortfolioFormType::class,$PortfolioProject);
        $formProject->handleRequest($request);
        if($formProject->isSubmitted()){
            $images = $formProject->get('upload')->getData();
            foreach($images as $image){
                //pour gere le nom du fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                //pour mettre le fichier dans le repertoire
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //pour stocker l'image dans la bdd
                $img = new PortfolioImages;
                $img->setName($fichier);
                $PortfolioProject->addPortfolioImage($img);
            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($PortfolioProject);
            $em->flush();
            return $this->redirectToRoute("addPortfolioProject");
        }
        return $this->render("/admin/addPortfolioItem.html.twig",array('formProject'=>$formProject->createView()));
    }
    /**
     * @Route("/deletePortfolioProject/{id}", name="deletePortfolioProject")
     */
    public function deletePortfolioItem($id){
        $Project = $this->getDoctrine()->getRepository(PortfolioProject::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Project);
        $em->flush();
        return $this->redirectToRoute("portfolioDasboard");
    }
    /**
     * @Route("/updatePortfolioProject/{id}", name="updatePortfolioProject")
     */ 
    public function updatePortfolioItem(Request $request, $id){
        $Project = $this->getDoctrine()->getRepository(PortfolioProject::class)->find($id);
        $formProject = $this->createForm(PortfolioFormType::class,$Project);
        $formProject->handleRequest($request);

        if($formProject->isSubmitted()){
            $images = $formProject->get('upload')->getData();
            foreach($images as $image){
                //pour gere le nom du fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                //pour mettre le fichier dans le repertoire
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //pour stocker l'image dans la bdd
                $img = new PortfolioImages;
                $img->setName($fichier);
                $Project->addPortfolioImage($img);
            }
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("updatePortfolioProject" , ['id'=>$id]);
        }
        return $this->render("/admin/updatePortfolioItem.html.twig",array('formProject'=>$formProject->createView(),'Project'=>$Project));

    }
    /**
     * @Route("/addBlogPostItem", name="addBlogPostItem")
     */
    public function addBlogItem(Request $request)
    {
        $blogPost = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $image = $form->get('upload')->getData();
            //pour gere le nom du fichier
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            //pour mettre le fichier dans le repertoire
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
            //pour stocker l'image dans la bdd
            $blogPost->setBlogPostImage($fichier);
            $blogPost->setFlag("inactive");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogPost);
            $entityManager->flush();
            return $this->redirectToRoute('addBlogPostItem');
        }

        return $this->render("/admin/addBlogPostItem.html.twig",array('formBlog'=>$form->createView()));
    }
    /**
     * @Route("/blog", name="blogDasboard")
     */
    public function showBlog(): Response
    {
        $BlogPost=$this->getDoctrine()->getRepository(BlogPost::class)->findAll();
        return $this->render("/admin/blog.html.twig",array('listBlogtDashboard'=>$BlogPost));
    }  
    /**
     * @Route("/deleteBlogPostItem/{id}", name="deleteBlogPostItem")
     */
    public function deleteBlogPostItem($id){
        $blogPost = $this->getDoctrine()->getRepository(BlogPost::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($blogPost);
        $em->flush();
        return $this->redirectToRoute("blogDasboard");
    }
    /**
     * @Route("/updateBlogPostItem/{id}", name="updateBlogPostItem")
     */ 
    public function updateBlogPostItem(Request $request, $id){
        $blogPost = $this->getDoctrine()->getRepository(BlogPost::class)->find($id);
        $form = $this->createForm(BlogPostType::class,$blogPost);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $image = $form->get('upload')->getData();
            //pour gere le nom du fichier
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            //pour mettre le fichier dans le repertoire
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
            //pour stocker l'image dans la bdd
            $blogPost->setBlogPostImage($fichier);
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("blogDasboard");
        }
        return $this->render("/admin/updateBlogPostItem.html.twig",array('formBlog'=>$form->createView()));

    }
    /**
     * @Route("/deleteImage/{id}", name="deleteImage")
     */
        public function deleteImage(PortfolioImages $image){
                // On récupère le nom de l'image
                $id = $image->getPortfolioProject()->getId();
                $nom = $image->getName();
                // On supprime le fichier
                unlink($this->getParameter('images_directory').'/'.$nom);
                // On supprime l'entrée de la base
                $em = $this->getDoctrine()->getManager();
                $em->remove($image);
                $em->flush();
                return $this->redirectToRoute("updatePortfolioProject" , ['id'=>$id]);
        }
}
