<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="tbl_rewards")
 */
class Reward{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $reward_id;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $reward_name;
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $points_required;
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
    function get_reward_name() {
        return $this->reward_name;
    }
    /**
     * @param mixed $reward_name
     */
    function set_reward_name($reward_name) {
        $this->reward_name = $reward_name;
    }
    /**
     * @return mixed
     */
    function get_description() {
        return $this->description;
    }
    /**
     * @param mixed $description
     */
    function set_description($description) {
        $this->description = $description;
    }
    /**
     * @return mixed
     */
    function get_points_required() {
        return $this->points_required;
    }
    /**
     * @param mixed $points_required
     */
    function set_points_required($points_required) {
        $this->points_required = $points_required;
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