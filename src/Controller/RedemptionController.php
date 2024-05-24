<?php

namespace App\Controller;

use App\Entity\Redemption;
use App\Form\RedemptionType;
use App\Repository\RedemptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/redemption')]
class RedemptionController extends AbstractController
{
    #[Route('/', name: 'app_redemption_index', methods: ['GET'])]
    public function index(RedemptionRepository $redemptionRepository): Response
    {
        return $this->render('redemption/index.html.twig', [
            'redemptions' => $redemptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_redemption_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $redemption = new Redemption();
        $form = $this->createForm(RedemptionType::class, $redemption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $redemption->setCreatedAt(new \DateTimeImmutable());
            $redemption->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->persist($redemption);
            $entityManager->flush();

            return $this->redirectToRoute('app_redemption_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('redemption/new.html.twig', [
            'redemption' => $redemption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_redemption_show', methods: ['GET'])]
    public function show(Redemption $redemption): Response
    {
        return $this->render('redemption/show.html.twig', [
            'redemption' => $redemption,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_redemption_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Redemption $redemption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RedemptionType::class, $redemption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $redemption->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_redemption_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('redemption/edit.html.twig', [
            'redemption' => $redemption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_redemption_delete', methods: ['POST'])]
    public function delete(Request $request, Redemption $redemption, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$redemption->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($redemption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_redemption_index', [], Response::HTTP_SEE_OTHER);
    }
}
