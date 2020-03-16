<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Entity\User;
use App\Form\QuoteType;
use App\Repository\QuoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    /**
     * @Route("/quote/", name="quote_index", methods={"GET"})
     */
    public function index(QuoteRepository $quoteRepository): Response
    {
        return $this->render('quote/index.html.twig', [
            'quotes' => $quoteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new-quote/", name="new_quote", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quote      = new Quote();
        $formData   = $request->request->all();

        if ($request->isMethod('POST')) {
            $firstName      = $formData['firstName'] ?? null;
            $lastName       = $formData['lastName'] ?? null;
            $email          = $formData['emailAddress'] ?? null;

            $subject        = $formData['subject'] ?? null;
            $description    = $formData['description'] ?? null;

            $user   = (new User())->setEmail($email)->setFirstName($firstName)->setLastName($lastName);
            $quote  = (new Quote())->setTitle($subject)->setDescription($description)
                ->setCreatedAt(new \DateTime('now'))->setStatus('pending')->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quote);
            $entityManager->flush();

            return $this->redirectToRoute('quote_index');
        }

        return $this->render('quote/new.html.twig', [
            'quote' => $quote,
            'form' => $formData,
        ]);
    }

    /**
     * @Route("/quote/{id}", name="quote_show", methods={"GET"})
     */
    public function show(Quote $quote): Response
    {
        return $this->render('quote/show.html.twig', [
            'quote' => $quote,
        ]);
    }

    /**
     * @Route("/quote/{id}/edit", name="quote_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quote $quote): Response
    {
        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quote_index');
        }

        return $this->render('quote/edit.html.twig', [
            'quote' => $quote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quote/{id}", name="quote_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Quote $quote): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quote_index');
    }
}
