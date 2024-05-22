<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Reward;
/**
 * Reward controller.
 * @Rest\Route("/api")
 */
class RewardController extends AbstractFOSRestController{
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
     * Lists all rewards.
     * @Rest\Get("/rewards")
     * @return Response
     */
    public function list_rewards()
    {
        $repository = $this->doctrine->getRepository(Reward::class);
        $rewards = $repository->findAll();
        // $data = [];
        // foreach ($rewards as $reward) {
        //     $data[] = [
        //         'id' => $reward->getId(),
        //         'name' => $reward->getName(),
        //         'description' => $reward->getDescription(),
        //         'points' => $reward->getPoints(),
        //     ];
        // }
        // return $this->handleView($this->view($data));
        return $this->handleView($this->view($rewards));
    }
    /**
     * Get a reward by ID.
     * @Rest\Get("/reward/{id}")
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function get_reward(int $id){
        $reward = $this->doctrine->getRepository(Reward::class)->find($id);
        if (!$reward) {
            throw new \Exception('Reward not found');
        }
        return $this->handleView($this->view($reward));
    }
    /**
     * Creates a new reward.
     * @Rest\Post("/reward")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function create_reward(Request $request){
        // $data = json_decode($request->getContent(), true);
        $reward = new Reward();
        // $reward->setName($data['name']);
        // $reward->setDescription($data['description']);
        // $reward->setPoints($data['points']);
        $reward->set_reward_id($request->get('reward_id'));
        $reward->set_reward_name($request->get('reward_name'));
        $reward->set_description($request->get('description'));
        $reward->set_points_required($request->get('points_required'));
        $reward->set_created_at(new \DateTime());
        $reward->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($reward);
        $entity_manager->flush();
        return $this->handleView($this->view($reward));
    }
    /**
     * Updates an existing reward.
     * @Rest\Put("/reward/{id}")
     * @param int $id
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function update_reward(int $id, Request $request){
        $reward = $this->doctrine->getRepository(Reward::class)->find($id);
        // $data = json_decode($request->getContent(), true);
        // $reward->setName($data['name']);
        // $reward->setDescription($data['description']);
        // $reward->setPoints($data['points']);
        $reward->set_reward_id($request->get('reward_id'));
        $reward->set_reward_name($request->get('reward_name'));
        $reward->set_description($request->get('description'));
        $reward->set_points_required($request->get('points_required'));
        $reward->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($reward);
        $entity_manager->flush();
        return $this->handleView($this->view($reward));
    }
    /**
     * Deletes a reward.
     * @Rest\Delete("/reward/{id}")
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function delete_reward(int $id){
        $reward = $this->doctrine->getRepository(Reward::class)->find($id);
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->remove($reward);
        $entity_manager->flush();
        return $this->handleView($this->view($reward));
    }
}