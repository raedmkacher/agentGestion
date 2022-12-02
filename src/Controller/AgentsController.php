<?php

namespace App\Controller;

use App\Entity\Agents;
use App\Form\AgentsType;
use App\Repository\AgentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agents')]
class AgentsController extends AbstractController
{
    function generateRandomString($length = 2) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    #[Route('/', name: 'app_agents_index', methods: ['GET'])]
    public function index(AgentsRepository $agentsRepository): Response
    {
        return $this->render('agents/index.html.twig', [
            'agents' => $agentsRepository->findAll(),
        ]);
    }

    

    #[Route('/new', name: 'app_agents_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AgentsRepository $agentsRepository): Response
    {
        $agent = new Agents();
        $form = $this->createForm(AgentsType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aleatoire=$this->generateRandomString.rand(1, 9).rand(1, 9).rand(1, 9).rand(1, 9).rand(1, 9);
            $agent->setUserId($aleatoire);
            $agentsRepository->save($agent, true);

            return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agents/new.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agents_show', methods: ['GET'])]
    public function show(Agents $agent): Response
    {
        return $this->render('agents/show.html.twig', [
            'agent' => $agent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_agents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agents $agent, AgentsRepository $agentsRepository): Response
    {
        $form = $this->createForm(AgentsType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agentsRepository->save($agent, true);

            return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agents/edit.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agents_delete', methods: ['POST'])]
    public function delete(Request $request, Agents $agent, AgentsRepository $agentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
            $agentsRepository->remove($agent, true);
        }

        return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
    }
}
