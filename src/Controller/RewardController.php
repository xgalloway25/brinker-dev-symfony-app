<?php

namespace App\Controller;

use App\Entity\Reward;
use App\Form\RewardType;
use App\Repository\RewardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reward')]
class RewardController extends AbstractController
{
    #[Route('/', name: 'app_reward_index', methods: ['GET'])]
    public function index(RewardRepository $rewardRepository): Response
    {
        return $this->render('reward/index.html.twig', [
            'rewards' => $rewardRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reward_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reward = new Reward();
        $form = $this->createForm(RewardType::class, $reward);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reward->setCreatedAt(new \DateTimeImmutable());
            $reward->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->persist($reward);
            $entityManager->flush();

            return $this->redirectToRoute('app_reward_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reward/new.html.twig', [
            'reward' => $reward,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reward_show', methods: ['GET'])]
    public function show(Reward $reward): Response
    {
        return $this->render('reward/show.html.twig', [
            'reward' => $reward,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reward_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reward $reward, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RewardType::class, $reward);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reward->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_reward_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reward/edit.html.twig', [
            'reward' => $reward,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reward_delete', methods: ['POST'])]
    public function delete(Request $request, Reward $reward, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reward->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($reward);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reward_index', [], Response::HTTP_SEE_OTHER);
    }
}
