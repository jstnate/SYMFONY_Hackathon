<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewFormType;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppController extends AbstractController
{

    #[Route('/', name: 'app_index')]
    public function avis(ReviewRepository $reviewRepository, Request $request, EntityManagerInterface $em): Response
    {
        // create "new" review
        $review = new Review();

        // create form
        $reviewForm = $this->createForm(ReviewFormType::class, $review);

        // request form
        $reviewForm->handleRequest($request);

        if($reviewForm->isSubmitted() && $reviewForm->isValid()) {
            $review->setFirstName($review->getFirstName());
            $review->setLastName($review->getLastName());
            $review->setReview($review->getReview());

            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('app/index.html.twig', [
            "reviewForm" => $reviewForm->createView(),
            'reviews' => $reviewRepository->findAll(),
        ]);
    }

}