<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            // Sending mail

            $message = (new \Swift_Message('Nouveau Contact'))
                ->setFrom($contact['email'])
                ->setTo('dylan.ch71@gmail.com')
                ->setBody(
                    $this->renderView(
                        'email/contact.html.twig', compact('contact'),
                    ),
                    'text/html'
                );
                $mailer->send($message);
                $this->addFlash('message', 'Le message a bien été envoyé');
                return $this->redirectToRoute('home');


        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
