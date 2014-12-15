<?php

class Pizza extends Controller
{
	private $pizzamodel;

	function __construct()
	{
		$this->pizzamodel = new pizzamodel();
	}

	public function index($message = null)
	{
		$users = new pizzaiterator($this->pizzamodel->get_pizzas());
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		if ($users)
		{
			$data['users'] = $users;
			view::load_view('default/accounts/pizzaslist', $data);
		}
		else
		{
			view::load_view('default/index/welcome');
		}
		view::load_view('default/standard/footer');
	}

	public function add()
	{
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/accounts/add');
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function edit($user_name)
	{
		$user = $this->usermodel->get_user($user_name);
		$data['user'] = $user;
		$_SESSION['user_edit'] = $user->__toArray();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/accounts/edit', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function processadd()
	{
		if ($this->usermodel->user_email_exists($_POST['user_email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.email.exists');
			redirect('application/add');
		}
		else if ($this->usermodel->user_name_exists($_POST['user_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.user.name.exists');
			redirect('application/add');
		}
		else
		{
			$this->usermodel->add_user($_POST);
			$this->sendemail($_POST, self::ADD);
			$_SESSION['message'] = lang('account.user.added');
			redirect('/');
		}
	}

	public function processedit()
	{
		if ($_SESSION['user_edit']['user_name'] != $_POST['user_name'])
		{
			$_SESSION['message'] = lang('account.security.detected');
			redirect('application/edit/'.$_SESSION['user_edit']['user_name']);
		}
		else if ($this->usermodel->user_email_exists($_POST['user_email'], $_POST['user_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.email.exists');
			redirect('application/edit/'.$_POST['user_name']);
		}
		else
		{
			if (count(compare_user_data($_POST, $_SESSION['user_edit'])))
			{
				$this->usermodel->update_user($_POST);
				$user = $this->usermodel->get_user($_POST['user_name'])->__toArray();
				$this->sendemail($user, self::EDIT);
				$_SESSION['message'] = lang('account.user.updated');
			}
			redirect('application/edit/'.$_POST['user_name']);
		}
	}
}
