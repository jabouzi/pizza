<?php

class customermodel extends Model
{
	private $customerdata;
	private $customerdatadao;

	public function __construct()
	{
		parent::__construct();
		$this->customerdata = new customerdata();
		$this->customerdatadao = new customerdao();
	}

	public function add_customer($customerdata)
	{
		$builder = new customerbuilder($customerdata);
		$builder->build();
		$customer = $builder->getcustomer();
		return $this->customerdatadao->insert_customer($customer);
	}

	public function update_customer($customerdata)
	{
		$builder = new customerbuilder($customerdata);
		$builder->build();
		$customer = $builder->getcustomer();
		$this->customerdatadao->update_customer($customer);
	}
	
	public function delete_customer($customer_id)
	{
		$this->customerdatadao->delete_customer($customer_id);
	}

	public function get_customer($customer_id)
	{
		$result = $this->customerdatadao->select_customer($customer_id);
		$builder = new customerbuilder($result);
		$builder->build();
		$customer = $builder->getcustomer();
		return $customer;
	}
	
	public function get_by_phone($phone)
	{
		$customers = array();
		$results =  $this->customerdatadao->select_by_phone($phone);
		if (!$results) return array();
		foreach($results as $result)
		{
			$builder = new customerbuilder($result);
			$builder->build();
			$customers[] = $builder->getcustomer();
		}
		return $customers;
	}

	public function get_customers()
	{
		$customers = array();
		$results = $this->customerdatadao->select_all();
		if (!$results) return array();
		foreach($results as $result)
		{
			$builder = new customerbuilder($result);
			$builder->build();
			$customers[] = $builder->getcustomer();
		}
		return $customers;
	}
}
