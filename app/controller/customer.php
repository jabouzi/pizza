<?php

class Customer extends Controller
{
	private $customermodel;

	function __construct()
	{
		$this->customermodel = new customermodel();
	}

	public function add()
	{
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/admins/add');
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function edit($id)
	{
		if ($id == $_SESSION['user']['id']) redirect ('admin/profile');
		$user = $this->adminmodel->get_user($this->adminmodel->get_email_by_id($id));
		$data['user'] = $user;
		$_SESSION['admin_edit'] = $user->__toArray();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/admins/edit', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}
	
	public function search()
	{
		$_SESSION['request'] = $_POST;
		$customers = $this->customermodel->get_by_phone($_SESSION['request']['phone']);
		if (empty($customers))
		{
			$_SESSION['request']['customer_id'] = 0;
			redirect('pizza/add');
		}
		$data['customers'] = $customers;
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/pizza/customerlist', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}
	
	public function select($id)
	{
		$customer = $this->customermodel->get_customer($id);
		$_SESSION['request'] = $customer->__toArray();
		redirect('pizza/add');
	}

	public function delete()
	{
		if ($_SESSION['admin_edit']['id'] != $_POST['id'])
		{
			$_SESSION['message'] = lang('account.security.detected');
			redirect('admins/edit/'.$_SESSION['admin_edit']['email']);
		}
		$this->adminmodel->delete_user($_POST['email']);
		$_SESSION['message'] = lang('admin.user.deleted');
		redirect('admin');
	}
	
	public function processadd()
	{
		if ($this->adminmodel->email_exists($_POST['email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('admin.email.exists');
			redirect('admin/add');
		}
		else
		{
			$this->adminmodel->add_user($_POST);
			$this->sendemail($_POST, self::ADD);
			$_SESSION['message'] = lang('admin.user.added');
			redirect('admin');
		}
	}

	public function processedit()
	{
		if ($_SESSION['admin_edit']['id'] != $_POST['id'])
		{
			$_SESSION['message'] = lang('account.security.detected');
			redirect('admins/edit/'.$_SESSION['admin_edit']['id']);
		}
		else if ($this->adminmodel->email_exists($_POST['email'], $_POST['id']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('admin.email.exists');
			redirect('admin/edit/'.$_POST['id']);
		}
		else
		{
			$diff = compare_user_admin($_POST, $_SESSION['admin_edit']);
			if (count($diff))
			{
				$this->adminmodel->update_user($_POST);
				$admin = $this->adminmodel->get_user($this->adminmodel->get_email_by_id($_SESSION['admin_edit']['id']))->__toArray();
				if (!in_array('admin', $diff) && !in_array('status', $diff))
				{
					$this->sendemail($admin, self::EDIT);
				}
				$_SESSION['message'] = lang('admin.user.updated');
			}
			redirect('admin/edit/'.$_POST['id']);
		}
	}
}
