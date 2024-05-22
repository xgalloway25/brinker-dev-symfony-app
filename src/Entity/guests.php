<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="tbl_guests")
 */
class Guest{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $guest_id;
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $first_name;
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    protected $last_name;
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Unique
     */
    protected $email;
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $phone;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $address;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $city;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $state;
    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $zip;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $country;
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
    function get_first_name() {
        return $this->first_name;
    }
    /**
     * @param mixed $first_name
     */
    function set_first_name($first_name) {
        $this->first_name = $first_name;
    }
    /**
     * @return mixed
     */
    function get_last_name() {
        return $this->last_name;
    }
    /**
     * @param mixed $last_name
     */
    function set_last_name($last_name) {
        $this->last_name = $last_name;
    }
    /**
     * @return mixed
     */
    function get_email() {
        return $this->email;
    }
    /**
     * @param mixed $email
     */
    function set_email($email) {
        $this->email = $email;
    }
    /**
     * @return mixed
     */
    function get_phone() {
        return $this->phone;
    }
    /**
     * @param mixed $phone
     */
    function set_phone($phone) {
        $this->phone = $phone;
    }
    /**
     * @return mixed
     */
    function get_address() {
        return $this->address;
    }
    /**
     * @param mixed $address
     */
    function set_address($address) {
        $this->address = $address;
    }
    /**
     * @return mixed
     */
    function get_city() {
        return $this->city;
    }
    /**
     * @param mixed $city
     */
    function set_city($city) {
        $this->city = $city;
    }
    /**
     * @return mixed
     */
    function get_state() {
        return $this->state;
    }
    /**
     * @param mixed $state
     */
    function set_state($state) {
        $this->state = $state;
    }
    /**
     * @return mixed
     */
    function get_zip() {
        return $this->zip;
    }
    /**
     * @param mixed $zip
     */
    function set_zip($zip) {
        $this->zip = $zip;
    }
    /**
     * @return mixed
     */
    function get_country() {
        return $this->country;
    }
    /**
     * @param mixed $country
     */
    function set_country($country) {
        $this->country = $country;
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