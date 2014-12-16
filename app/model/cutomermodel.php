<?php

class Customermodel extends Model
{
	private $customer;
	private $customerdao;
	private $cache;
	private $log;

	public function __construct()
	{
		parent::__construct();
		$this->customer = new customer();
		$this->customerdao = new customerdao();
	}

	public function add_customer($customerdata)
	{
		if (!isset($customerdata['customer'])) $customerdata['customer'] = 0;
		if (!isset($customerdata['status'])) $customerdata['status'] = 0;
		$builder = new customerbuilder($customerdata);
		$builder->build();
		$customer = $builder->getcustomer();
		$this->customerdao->insert($customer);
	}

	public function update_customer($customerdata)
	{
		if (!isset($customerdata['customer'])) $customerdata['customer'] = 0;
		if (!isset($customerdata['status'])) $customerdata['status'] = 0;
		$builder = new customercustomerbuilder($customerdata);
		$builder->build();
		$customer = $builder->getcustomer();
		$this->customerdao->update($customer);
	}

	public function delete_customer($email)
	{
		$this->customerdao->delete($email);
	}

	public function get_customer($email)
	{
		$result = $this->customerdao->select_customer($email);
		$builder = new customerbuilder($result);
		$builder->build();
		$customer = $builder->getcustomer();
		return $customer;
	}

	public function get_customers()
	{
		$customers = array();
		$results = $this->customerdao->select_all();
		foreach($results as $result)
		{
			if($_SESSION['customer']['id'] != $result['id'])
			{
				$builder = new customerbuilder($result);
				$builder->build();
				$customers[] = $builder->getcustomer();
			}
		}
		return $customers;
	}
}
