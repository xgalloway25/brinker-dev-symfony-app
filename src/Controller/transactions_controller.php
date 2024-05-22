<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Transaction;
/**
 * Transaction controller.
 * @Rest\Route("/api")
 */
class TransactionController extends AbstractFOSRestController{
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
     * Lists all transactions.
     * @Rest\Get("/transactions")
     * @return Response
     */
    public function list_transactions(): Response
    {
        $transactions = $this->doctrine->getRepository(Transaction::class)->findAll();
        // $data = [];
        // foreach ($transactions as $transaction) {
        //     $data[] = [
        //         'id' => $transaction->getId(),
        //         'amount' => $transaction->getAmount(),
        //         'description' => $transaction->getDescription(),
        //         'date' => $transaction->getDate(),
        //         'category' => $transaction->getCategory()->getName(),
        //         'account' => $transaction->getAccount()->getName(),
        //     ];
        // }
        // return $this->handleView($this->view($data));
        return $this->handleView($this->view($transactions));
    }
    /**
     * Get a single transaction.
     * @Rest\Get("/transactions/{id}")
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function get_transaction(int $id): Response{
        $transaction = $this->doctrine->getRepository(Transaction::class)->find($id);
        if (!$transaction) {
            throw new \Exception('Transaction not found');
        }
        return $this->handleView($this->view($transaction));
    }
    /**
     * Creates a new transaction.
     * @Rest\Post("/transactions")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function create_transaction(Request $request): Response{
        // $data = json_decode($request->getContent(), true);
        $transaction = new Transaction();
        // $transaction->setAmount($data['amount']);
        // $transaction->setDescription($data['description']);
        // $transaction->setDate(new \DateTime());
        // $transaction->setCategory($this->doctrine->getRepository(Transaction::class)->find($data['category']));
        // $transaction->setAccount($this->doctrine->getRepository(Transaction::class)->find($data['account']));
        $transaction->set_transaction_id($request->get('transaction_id'));
        $transaction->set_guest_id($request->get('guest_id'));
        $transaction->set_transaction_date(date("Y-m-d"));
        $transaction->set_amount($request->get('amount'));
        $transaction->set_points_awarded($request->get('points_awarded'));
        $transaction->set_created_at(new \DateTime());
        $transaction->set_updated_at(new \DateTime());
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($transaction);
        $entity_manager->flush();
        return $this->handleView($this->view($transaction));
    }
    /**
     * Updates an existing transaction.
     * @Rest\Put("/transactions/{id}")
     * @param int $id
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function update_transaction(int $id, Request $request): Response{
        $transaction = $this->doctrine->getRepository(Transaction::class)->find($id);
        if (!$transaction) {
            throw new \Exception('Transaction not found');
        }
        // $data = json_decode($request->getContent(), true);
        // $transaction->setAmount($data['amount']);
        // $transaction->setDescription($data['description']);
        // $transaction->setDate(new \DateTime());
        // $transaction->setCategory($this->doctrine->getRepository(Transaction::class)->find($data['category']));
        // $transaction->setAccount($this->doctrine->getRepository(Transaction::class)->find($data['account']));
        $transaction->set_transaction_id($request->get('transaction_id'));
        $transaction->set_guest_id($request->get('guest_id'));
        $transaction->set_transaction_date($request->get('transaction_date'));
        $transaction->set_amount($request->get('amount'));
        $transaction->set_points_awarded($request->get('points_awarded'));
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->persist($transaction);
        $entity_manager->flush();
        return $this->handleView($this->view($transaction));
    }
    /**
     * Deletes a transaction.
     * @Rest\Delete("/transactions/{id}")
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function delete_transaction(int $id): Response{
        $transaction = $this->doctrine->getRepository(Transaction::class)->find($id);
        if (!$transaction) {
            throw new \Exception('Transaction not found');
        }
        $entity_manager = $this->doctrine->getManager();
        $entity_manager->remove($transaction);
        $entity_manager->flush();
        return $this->handleView($this->view($transaction));
    }
}