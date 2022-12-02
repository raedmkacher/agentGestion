<?php

namespace App\Controller;

use App\Entity\UserContact;
use App\Form\UserContactType;
use App\Repository\UserContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/contact')]
class UserContactController extends AbstractController
{
    #[Route('/', name: 'app_user_contact_index', methods: ['GET'])]
    public function index(UserContactRepository $userContactRepository): Response
    {
        return $this->render('user_contact/index.html.twig', [
            'user_contacts' => $userContactRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_contact_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserContactRepository $userContactRepository): Response
    {
        $userContact = new UserContact();
        $form = $this->createForm(UserContactType::class, $userContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userContactRepository->save($userContact, true);

            return $this->redirectToRoute('app_user_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_contact/new.html.twig', [
            'user_contact' => $userContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_contact_show', methods: ['GET'])]
    public function show(UserContact $userContact): Response
    {
        return $this->render('user_contact/show.html.twig', [
            'user_contact' => $userContact,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_contact_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserContact $userContact, UserContactRepository $userContactRepository): Response
    {
        $form = $this->createForm(UserContactType::class, $userContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userContactRepository->save($userContact, true);

            return $this->redirectToRoute('app_user_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_contact/edit.html.twig', [
            'user_contact' => $userContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_contact_delete', methods: ['POST'])]
    public function delete(Request $request, UserContact $userContact, UserContactRepository $userContactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userContact->getId(), $request->request->get('_token'))) {
            $userContactRepository->remove($userContact, true);
        }

        return $this->redirectToRoute('app_user_contact_index', [], Response::HTTP_SEE_OTHER);
    }
}
