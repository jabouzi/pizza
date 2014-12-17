<?php

class Pizzadata {

	private $pizza_id;
	private $customer;
	private $ingredients = array();
	private $price;
	private $isDelivery;
	private $isCanceled;

	function __construct()
	{
		
	}
	
	public function set_id($pizza_id)
	{
		$this->pizza_id = $pizza_id;
	}
	
	public function set_customer($customer_id)
	{
		$this->customer = $customer_id;
	}

	public function set_ingredients($ingredients)
	{
		foreach($ingredients as $key => $value)
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

	public function get_id()
	{
		return $this->pizza_id;
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
	
	public function __toArray()
	{
		return array(
			'pizza_id' => $this->get_id(),
			'customer_id' => $this->get_customer(),
			'ingredients_1' => item($this->get_ingredients(), 0),
			'ingredients_2' => item($this->get_ingredients(), 1),
			'ingredients_3' => item($this->get_ingredients(), 2),
			'delivery' => $this->get_type(),
			'status' => $this->get_status(),
		);
	}
}
