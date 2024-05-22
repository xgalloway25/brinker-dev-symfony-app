<?php
namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="tbl_redemptions")
 */
class Redemption{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $redemption_id;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $guest_id;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $reward_id;
    /**
     * @ORM\Column(type="date")
     * @Assert\Date
     * @Assert\NotBlank()
     */
    private $redemption_date;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $points_redeemed;
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
    function get_redemption_id() {
        return $this->redemption_id;
    }
    /**
     * @param mixed $redemption_id
     */
    function set_redemption_id($redemption_id) {
        $this->redemption_id = $redemption_id;
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
    function get_reward_id() {
        return $this->reward_id;
    }
    /**
     * @param mixed $reward_id
     */
    function set_reward_id($reward_id) {
        $this->reward_id = $reward_id;
    }
    /**
     * @return mixed
     */
    function get_redemption_date() {
        return $this->redemption_date;
    }
    /**
     * @param mixed $redemption_date
     */
    function set_redemption_date($redemption_date) {
        $this->redemption_date = $redemption_date;
    }
    /**
     * @return mixed
     */
    function get_points_redeemed() {
        return $this->points_redeemed;
    }
    /**
     * @param mixed $points_redeemed
     */
    function set_points_redeemed($points_redeemed) {
        $this->points_redeemed = $points_redeemed;
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