<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\GuestPoints;
/**
 * GuestPoints controller
 * @Rest\Route("/api")
 */
class GuestPointsController extends AbstractFOSRestController{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;
    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    /**
     * List all guest points records
     * @Rest\Get("/guest-points")
     * @return Response
     */
    public function list_guest_points(): Response{
        // $em = $this->doctrine->getManager();
        // $guest_points = $em->getRepository(GuestPoints::class)->findAll();
        $guest_points = $this->doctrine->getRepository(GuestPoints::class)->findAll();
        return $this->handleView($this->view($guest_points));
    }
    /**
     * Get a guest points record
     * @Rest\Get("/guest-points/{id}")
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function get_guest_points(int $id): Response{
        // $em = $this->doctrine->getManager();
        // $guest_points = $em->getRepository(GuestPoints::class)->find($id);
        $guest_points = $this->doctrine->getRepository(GuestPoints::class)->find($id);
        if (!$guest_points) {
            throw $this->createNotFoundException(
                'No guest points found for id '.$id
            );
        }
        return $this->handleView($this->view($guest_points));
    }
    /**
     * create a guest points record
     * @Rest\Post("/guest-points")
     */
    public function create_guest_points(Request $request): Response{
        $guest_points = new GuestPoints();
        $guest_points->set_guest_id($request->get('guest_id'));
        $guest_points->set_total_points($request->get('total_points'));
        $guest_points->set_created_at(new \DateTime());
        $guest_points->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($guest_points);
        $entity_manager->flush();
        return $this->handleView($this->view($guest_points));
    }
    /**
     * update a guest points record
     * @Rest\Put("/guest-points/{id}")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update_guest_points(Request $request, int $id): Response{
        // $em = $this->doctrine->getManager();
        // $guest_points = $em->getRepository(GuestPoints::class)->find($id);
        $guest_points = $this->doctrine->getRepository(GuestPoints::class)->find($id);
        if (!$guest_points) {
            throw $this->createNotFoundException(
                'No guest points found for id '.$id
            );
        }
        $guest_points->set_guest_id($request->get('guest_id'));
        $guest_points->set_total_points($request->get('total_points'));
        $guest_points->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($guest_points);
        $entity_manager->flush();
        return $this->handleView($this->view($guest_points));
    }
    /**
     * delete a guest points record
     * @Rest\Delete("/guest-points/{id}
     * @param int $id
     * @return Response
     * @throws \Exception 
     */
    public function delete_guest_points(int $id): Response{
        // $em = $this->doctrine->getManager();
        // $guest_points = $em->getRepository(GuestPoints::class)->find($id);
        $guest_points = $this->doctrine->getRepository(GuestPoints::class)->find($id);
        if (!$guest_points) {
            throw $this->createNotFoundException(
                'No guest points found for id '.$id
            );
        }
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->remove($guest_points);
        $entity_manager->flush();
        return $this->handleView($this->view($guest_points));
    }
}