<?php

namespace App\Controller;

use App\Entity\GuestPoints;
use App\Form\GuestPointsType;
use App\Repository\GuestPointsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/guest/points')]
class GuestPointsController extends AbstractController
{
    #[Route('/', name: 'app_guest_points_index', methods: ['GET'])]
    public function index(GuestPointsRepository $guestPointsRepository): Response
    {
        return $this->render('guest_points/index.html.twig', [
            'guest_points' => $guestPointsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_guest_points_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $guestPoint = new GuestPoints();
        $form = $this->createForm(GuestPointsType::class, $guestPoint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guestPoint->setCreatedAt(new \DateTimeImmutable());
            $guestPoint->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->persist($guestPoint);
            $entityManager->flush();

            return $this->redirectToRoute('app_guest_points_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('guest_points/new.html.twig', [
            'guest_point' => $guestPoint,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_guest_points_show', methods: ['GET'])]
    public function show(GuestPoints $guestPoint): Response
    {
        return $this->render('guest_points/show.html.twig', [
            'guest_point' => $guestPoint,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_guest_points_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GuestPoints $guestPoint, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GuestPointsType::class, $guestPoint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guestPoint->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_guest_points_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('guest_points/edit.html.twig', [
            'guest_point' => $guestPoint,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_guest_points_delete', methods: ['POST'])]
    public function delete(Request $request, GuestPoints $guestPoint, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guestPoint->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($guestPoint);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_guest_points_index', [], Response::HTTP_SEE_OTHER);
    }
}
