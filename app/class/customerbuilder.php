<?php

class Customerbuilder
{
	protected $customer = NULL;
	protected $customer_data = array();

	public function __construct($customer_data)
	{
		$this->customer_data = $customer_data;
	}

	public function build()
	{
		$this->customer = new Customerdata();
		if (isset($this->customer_data['customer_id']))	$this->customer->set_id($this->customer_data['customer_id']);
		$this->customer->set_phone($this->customer_data['phone']);
		$this->customer->set_first_name($this->customer_data['first_name']);
		$this->customer->set_last_name($this->customer_data['last_name']);
		$this->customer->set_address($this->customer_data['address']);
		$this->customer->set_address2($this->customer_data['address2']);
		$this->customer->set_city($this->customer_data['city']);
		$this->customer->set_postal_code($this->customer_data['postal_code']);
		if (isset($this->customer_data['active'])) $this->customer->set_status($this->customer_data['active']);
		$this->customer->set_comments($this->customer_data['comments']);
	}

	public function getcustomer()
	{
		return $this->customer;
	}
}
