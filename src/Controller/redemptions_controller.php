<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Redemption;
/**
 * Redemption controller.
 * @Rest\Route("/api")
 */
class RedemptionController extends AbstractFOSRestController{
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
     * Lists all Redemptions.
     * @Rest\Get("/redemptions")
     * @return Response
     * @throws \Exception
     */
    public function list_redemptions(){
        $redemptions = $this->doctrine->getRepository(Redemption::class)->findAll();
        if (!$redemptions) {
            throw new \Exception('Redemptions not found');
        }
        return $this->handleView($this->view($redemptions));
    }
    /**
     * Gets a single Redemption.
     * @Rest\Get("/redemptions/{id}")
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function get_redemption(int $id)
    {
        $redemption = $this->doctrine->getRepository(Redemption::class)->find($id);
        if (!$redemption) {
            throw new \Exception('Redemption not found');
        }
        return $this->handleView($this->view($redemption));
    }
    /**
     * Creates a new Redemption.
     * @Rest\Post("/redemptions")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function create_redemption(Request $request){
        $redemption = new Redemption();
        $redemption->set_redemption_id($request->request->get('redemption_id'));
        $redemption->set_guest_id($request->request->get('guest_id'));
        $redemption->set_reward_id($request->request->get("reward_id"));
        $redemption->set_redemption_date(date("Y-m-d"));
        $redemption->set_points_redeemed($request->request->get("points_redeemed"));
        $redemption->set_created_at(new \DateTime());
        $redemption->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($redemption);
        $entity_manager->flush();
        return $this->handleView($this->view($redemption));
    }
    /** 
     * Updates an existing Redemption.
     * @Rest\Put("/redemptions/{id}")
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function update_redemption(Request $request, int $id){
        $redemption = $this->doctrine->getRepository(Redemption::class)->find($id);
        if (!$redemption) {
            throw new \Exception('Redemption not found');
        }
        $redemption->set_redemption_id($request->request->get('redemption_id'));
        $redemption->set_guest_id($request->request->get('guest_id'));
        $redemption->set_reward_id($request->request->get("reward_id"));
        $redemption->set_redemption_date($request->request->get("reward_id"));
        $redemption->set_points_redeemed($request->request->get("points_redeemed"));
        $redemption->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($redemption);
        $entity_manager->flush();
        return $this->handleView($this->view($redemption));
    }
    /**
     * Deletes a Redemption.
     * @Rest\Delete("/redemptions/{id}")
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function delete_redemption(int $id){
        $redemption = $this->doctrine->getRepository(Redemption::class)->find($id);
        if (!$redemption) {
            throw new \Exception('Redemption not found');
        }
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->remove($redemption);
        $entity_manager->flush();
        return $this->handleView($this->view($redemption));
    }
}