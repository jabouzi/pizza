<?php

class Customer extends Controller
{
	private $customermodel;

	function __construct()
	{
		$this->customermodel = new customermodel();
	}

	public function index($message = null)
	{

	}
	
	public function profile()
	{
		$user = $this->adminmodel->get_user($_SESSION['user']['email']);
		$data['user'] = $user;
		$_SESSION['admin_edit'] = $user->__toArray();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/admins/profile', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
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
	
	public function processprofile()
	{
		if ($_SESSION['admin_edit']['id'] != $_POST['id'])
		{
			$_SESSION['message'] = lang('account.security.detected');
			redirect('admin/profile');
		}
		else if ($this->adminmodel->email_exists($_POST['email'], $_POST['id']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('admin.email.exists');
			redirect('admin/profile');
		}
		else
		{
			$_POST['admin'] = $_SESSION['user']['admin'];
			$_POST['status'] = $_SESSION['user']['status'];
			$this->adminmodel->update_user($_POST);
			$_SESSION['message'] = lang('admin.user.updated');
			redirect('admin/profile');
		}
	}
}
