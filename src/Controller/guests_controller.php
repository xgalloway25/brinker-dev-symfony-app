<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Guest;
/**
 * Guest controller.
 * @Rest\Route("/api")
 */
class GuestController extends AbstractFOSRestController
{
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
     * Lists all guest entities.
     * @Rest\Get("/guests")
     * @return Response
     */
    public function list_guests()
    {
        // $em = $this->doctrine->getManager();
        // $guests = $em->getRepository(Guest::class)->findAll();
        $guests = $this->doctrine->getRepository(Guest::class)->findAll();
        return $this->handleView($this->view($guests));
    }
    /**
     * Get a guest entity.
     * @Rest\Get("/guests/{id}")
     * @param $id
     * @return Response
     * @throws \Exception
     */
    public function get_guest($id)
    {
        // $em = $this->doctrine->getManager();
        // $guest = $em->getRepository(Guest::class)->find($id);
        $guest = $this->doctrine->getRepository(Guest::class)->find($id);
        if (!$guest) {
            throw new \Exception('Guest not found');
        }
        return $this->handleView($this->view($guest));
    }
    /**
     * Creates a new guest entity.
     * @Rest\Post("/guests")
     * @param Request $request
     * @return Response
     */
    public function create_guest(Request $request)
    {
        $guest = new Guest();
        $guest->set_first_name($request->get('first_name'));
        $guest->set_last_name($request->get('last_name'));
        $guest->set_email($request->get('email'));
        $guest->set_phone($request->get('phone'));
        $guest->set_address($request->get('address'));
        $guest->set_city($request->get('city'));
        $guest->set_state($request->get('state'));
        $guest->set_zip($request->get('zip'));
        $guest->set_country($request->get('country'));
        $guest->set_created_at(new \DateTime());
        $guest->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($guest);
        $entity_manager->flush();
        return $this->handleView($this->view($guest));
    }
    /**
     * Update a guest entity.
     * @Rest\Put("/guests/{id}")
     * @param $id
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function update_guest(Request $request, $id){
        // $em = $this->doctrine->getManager();
        // $guest = $em->getRepository(Guest::class)->find($id);
        $guest = $this->doctrine->getRepository(Guest::class)->find($id);
        if (!$guest){
            throw new \Exception('Guest not found');
        }
        $guest->set_first_name($request->get('first_name'));
        $guest->set_last_name($request->get('last_name'));
        $guest->set_email($request->get('email'));
        $guest->set_phone($request->get('phone'));
        $guest->set_address($request->get('address'));
        $guest->set_city($request->get('city'));
        $guest->set_state($request->get('state'));
        $guest->set_zip($request->get('zip'));
        $guest->set_country($request->get('country'));
        $guest->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($guest);
        $entity_manager->flush();
        return $this->handleView($this->view($guest));
    }
    /**
     * Delete a guest entity.
     * @Rest\Delete("/guests/{id}")
     * @param $id
     * @return Response
     * @throws \Exception
     */
    public function delete_guest($id){
        // $em = $this->doctrine->getManager();
        // $guest = $em->getRepository(Guest::class)->find($id);
        $guest = $this->doctrine->getRepository(Guest::class)->find($id);
        if (!$guest){
            throw new \Exception('Guest not found');
        }
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->remove($guest);
        $entity_manager->flush();
        return $this->handleView($this->view($guest));
    }
}