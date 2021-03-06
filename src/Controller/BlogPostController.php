<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\BlogPostComment;
use App\Form\BlogPostCommentType;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog/post")
 */
class BlogPostController extends AbstractController
{
    /**
     * @Route("/", name="blog", methods={"GET"})
     */
    public function index(BlogPostRepository $blogPostRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $Blog = $paginator->paginate(
            $blogPostRepository->findAll(), // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), 6 // Nombre de résultats par page
        );
        return $this->render('blog_post/blogList.html.twig', [
            'blog_posts' => $Blog,
        ]);
    }

    /**
     * @Route("/{id}", name="blogDetail", methods={"GET","POST"})
     */
    public function show(BlogPost $blogPost, Request $request): Response
    {
        $blogPostComment = new BlogPostComment();
        $form = $this->createForm(BlogPostCommentType::class, $blogPostComment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $blogPostComment->setEnabled('yes');
            $blogPostComment->setBlogPost($blogPost);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogPostComment);
            $entityManager->flush();
            return $this->redirectToRoute('blog');

        }
        
        return $this->render('blog_post/blogDetail.html.twig', [
            'blog_post' => $blogPost,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blog_post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BlogPost $blogPost): Response
    {
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog');
        }

        return $this->render('blog_post/edit.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BlogPost $blogPost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogPost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blogPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog');
    }
}
