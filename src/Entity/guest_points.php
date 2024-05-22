<?php
namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="tbl_guest_points")
 */
class GuestPoints{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $guest_id;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $total_points;
    /**
     * @ORM\Column(type="timestamp")
     * @Assert\DateTime
     */
    private $created_at;
    /**
     * @ORM\Column(type="timestamp")
     * @Assert\DateTime
     */
    private $updated_at;
    /**
     * @return mixed
     */
    function get_guest_id(){
        return $this->guest_id;
    }
    /**
     * @param mixed $guest_id
     */
    function set_guest_id($guest_id){
        $this->guest_id = $guest_id;
    }
    /**
     * @return mixed
     */
    function get_total_points(){
        return $this->total_points;
    }
    /**
     * @param mixed $total_points
     */
    function set_total_points($total_points){
        $this->total_points = $total_points;
    }
    /**
     * @return mixed
     */
    function get_created_at(){
        return $this->created_at;
    }
    /**
     * @param mixed $created_at
     */
    function set_created_at($created_at){
        $this->created_at = $created_at;
    }
    /**
     * @return mixed
     */
    function get_updated_at(){
        return $this->updated_at;
    }
    /**
     * @param mixed $updated_at
     */
    function set_updated_at($updated_at){
        $this->updated_at = $updated_at;
    }
}