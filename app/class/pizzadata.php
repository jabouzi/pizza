<?php

class Pizzadata {

	private $customer;
	private $ingredients = array();
	private $price;
	private $isDelivery;
	private $isCanceled;

	function __construct()
	{
		
	}
	
	public function set_customer($customer_id)
	{
		$this->customer = $customer_id;
	}

	public function set_ingredients($ingredients)
	{
		foreach($ingredient as $key => $value)
		{
			$this->ingredients[$key] = $value;
		}
	}

	public function set_price($price)
	{
		$this->price = $price;
	}
    
	public function set_type($type)
	{
		$this->isDelivery = $type;
	}
	
	public function set_status($status)
	{
		$this->isCanceled = $status;
	}
	
	public function get_customer()
	{
		return $this->customer;
	}

	public function get_ingredients()
	{
		return $this->ingredients;
	}

	public function get_price()
	{
		return $this->price;
	}

	public function get_type()
	{
		return $this->isDelivery;
	}
	
	public function get_status()
	{
		return $this->isCanceled;
	}
}
