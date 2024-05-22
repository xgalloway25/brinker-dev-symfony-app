<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="tbl_transactions")
 */
class Transaction{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $transaction_id;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $guest_id;
    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date
     */
    private $transaction_date;
    /**
     * @ORM\Column(type="decimal")
     * @Assert\NotBlank()
     */
    private $amount;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $points_awarded;
    /**
     * @ORM\Column(type="timestamp")
     * @Assert\DateTime
     */
    protected $created_at;
    /**
     * @ORM\Column(type="timestamp")
     * @Assert\DateTime
     */
    protected $updated_at;
    /**
     * @return mixed
     */
    function get_transaction_id() {
        return $this->transaction_id;
    }
    /**
     * @param mixed $transaction_id
     */
    function set_transaction_id($transaction_id) {
        $this->transaction_id = $transaction_id;
    }
    /** 
     * @return mixed
     */
    function get_guest_id() {
        return $this->guest_id;
    }
    /**
     * @param mixed $guest_id
     */
    function set_guest_id($guest_id) {
        $this->guest_id = $guest_id;
    }
    /**
     * @return mixed
     */
    function get_transaction_date() {
        return $this->transaction_date;
    }
    /**
     * @param mixed $transaction_date
     */
    function set_transaction_date($transaction_date) {
        $this->transaction_date = $transaction_date;
    }
    /**
     * @return mixed
     */
    function get_amount() {
        return $this->amount;
    }
    /**
     * @param mixed $amount
     */
    function set_amount($amount) {
        $this->amount = $amount;
    }
    /**
     * @return mixed
     */
    function get_points_awarded() {
        return $this->points_awarded;
    }
    /**
     * @param mixed $points_awarded
     */
    function set_points_awarded($points_awarded) {
        $this->points_awarded = $points_awarded;
    }
    /**
     * @return mixed
     */
    function get_created_at() {
        return $this->created_at;
    }
    /**
     * @param mixed $created_at
     */
    function set_created_at($created_at) {
        $this->created_at = $created_at;
    }
    /**
     * @return mixed
     */
    function get_updated_at() {
        return $this->updated_at;
    }
    /**
     * @param mixed $updated_at
     */
    function set_updated_at($updated_at) {
        $this->updated_at = $updated_at;
    }
}