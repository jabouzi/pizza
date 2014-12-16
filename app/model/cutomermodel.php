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

	public function add_user($userdata)
	{
		if (!isset($userdata['customer'])) $userdata['customer'] = 0;
		if (!isset($userdata['status'])) $userdata['status'] = 0;
		$builder = new usercustomerbuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->customerdao->insert($user);
		$this->cache->delete('select_customer_'.$userdata['email']);
		$this->cache->delete('select_customer_all');
		$this->log->save('ADD customer', $userdata);
	}

	public function update_user($userdata)
	{
		if (!isset($userdata['customer'])) $userdata['customer'] = 0;
		if (!isset($userdata['status'])) $userdata['status'] = 0;
		$builder = new usercustomerbuilder($userdata);
		$builder->build();
		$user = $builder->getUser();
		$this->customerdao->update($user);
		$this->cache->delete('select_customer_'.$userdata['email']);
		$this->cache->delete('select_customer_all');
		$this->log->save('UPDATE customer', $userdata);
	}

	public function delete_user($email)
	{
		$this->customerdao->delete($email);
		$this->cache->delete('select_customer_'.$email);
		$this->cache->delete('select_customer_all');
		$this->log->save('UPDATE customer', $email);
	}

	public function get_user($email)
	{
		if ($this->cache->get('select_customer_'.$email)) return $this->cache->get('select_customer_'.$email);
		$result = $this->customerdao->select_user($email);
		$builder = new usercustomerbuilder($result);
		$builder->build();
		$user = $builder->getUser();
		$this->cache->save('select_customer_'.$email, $user);
		return $user;
	}

	public function get_users()
	{
		if ($this->cache->get('select_customer_all')) return $this->cache->get('select_customer_all');
		$users = array();
		$results = $this->customerdao->select_all();
		foreach($results as $result)
		{
			if($_SESSION['user']['id'] != $result['id'])
			{
				$builder = new usercustomerbuilder($result);
				$builder->build();
				$users[] = $builder->getUser();
			}
		}
		$this->cache->save('select_customer_all', $users);
		return $users;
	}
}
