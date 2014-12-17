<?php

class Customerdata {

	private $customer_id;
	private $first_name;
	private $last_name;
	private $phone;
	private $address;
	private $address2;
	private $city;
	private $postal_code;
	private $comments;
	private $status;

	function __construct()
	{

	}
	
	public function set_id($customer_id)
	{
		$this->customer_id = $customer_id;
	}
	
	public function set_phone($phone)
	{
		$this->phone = $phone;
	}

	public function set_first_name($first_name)
	{
		$this->first_name = $first_name;
	}

	public function set_last_name($last_name)
	{
		$this->last_name = $last_name;
	}
    
	public function set_address($address)
	{
		$this->address = $address;
	}
	
	public function set_address2($address2)
	{
		$this->address2 = $address2;
	}
	
	public function set_city($city)
	{
		$this->city = $city;
	}
	
	public function set_postal_code($postal_code)
	{
		$this->postal_code = $postal_code;
	}
	
	public function set_comments($comments)
	{
		$this->comments = $comments;
	}
	
	public function set_status($status)
	{
		$this->status = $status;
	}
	
	public function get_id()
	{
		return $this->customer_id;
	}
	
	public function get_phone()
	{
		return $this->phone;
	}

	public function get_first_name()
	{
		return $this->first_name;
	}

	public function get_last_name()
	{
		return $this->last_name;
	}
    
	public function get_address()
	{
		return $this->address;
	}
	
	public function get_address2()
	{
		return $this->address2;
	}
	
	public function get_city()
	{
		return $this->city;
	}
	
	public function get_postal_code()
	{
		return $this->postal_code;
	}
	
	public function get_comments()
	{
		return $this->comments;
	}
	
	public function get_status()
	{
		return $this->status;
	}
	
	public function __toArray()
	{
		return array(
			'customer_id' => $this->get_id(),
			'phone' => $this->get_phone(),
			'first_name' => $this->get_first_name(),
			'last_name' => $this->get_last_name(),
			'address' => $this->get_address(),
			'address2' => $this->get_address2(),
			'city' => $this->get_city(),
			'postal_code' => $this->get_postal_code(),
			'status' => $this->get_status(),
		);
	}
}
