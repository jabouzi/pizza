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
		redirect('pizza/add');
	}

	public function add()
	{
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/pizza/add');
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function processadd()
	{
		if ($this->pizzamodel->pizza_email_exists($_POST['pizza_email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.email.exists');
			redirect('pizza/add');
		}
		else if ($this->pizzamodel->pizza_name_exists($_POST['pizza_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.pizza.name.exists');
			redirect('pizza/add');
		}
		else
		{
			$this->pizzamodel->add_pizza($_POST);
			$this->sendemail($_POST, self::ADD);
			$_SESSION['message'] = lang('account.pizza.added');
			redirect('/');
		}
	}
}
