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
		$pizzas = new pizzaiterator($this->pizzamodel->get_pizzas());
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		if ($pizzas)
		{
			$data['pizzas'] = $pizzas;
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

	public function edit($pizza_name)
	{
		$pizza = $this->pizzamodel->get_pizza($pizza_name);
		$data['pizza'] = $pizza;
		$_SESSION['pizza_edit'] = $pizza->__toArray();
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/accounts/edit', $data);
		view::load_view('default/standard/footer');
		unset($_SESSION['request']);
	}

	public function processadd()
	{
		if ($this->pizzamodel->pizza_email_exists($_POST['pizza_email']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.email.exists');
			redirect('application/add');
		}
		else if ($this->pizzamodel->pizza_name_exists($_POST['pizza_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.pizza.name.exists');
			redirect('application/add');
		}
		else
		{
			$this->pizzamodel->add_pizza($_POST);
			$this->sendemail($_POST, self::ADD);
			$_SESSION['message'] = lang('account.pizza.added');
			redirect('/');
		}
	}

	public function processedit()
	{
		if ($_SESSION['pizza_edit']['pizza_name'] != $_POST['pizza_name'])
		{
			$_SESSION['message'] = lang('account.security.detected');
			redirect('application/edit/'.$_SESSION['pizza_edit']['pizza_name']);
		}
		else if ($this->pizzamodel->pizza_email_exists($_POST['pizza_email'], $_POST['pizza_name']))
		{
			$_SESSION['request'] = $_POST;
			$_SESSION['message'] = lang('account.email.exists');
			redirect('application/edit/'.$_POST['pizza_name']);
		}
		else
		{
			if (count(compare_pizza_data($_POST, $_SESSION['pizza_edit'])))
			{
				$this->pizzamodel->update_pizza($_POST);
				$pizza = $this->pizzamodel->get_pizza($_POST['pizza_name'])->__toArray();
				$this->sendemail($pizza, self::EDIT);
				$_SESSION['message'] = lang('account.pizza.updated');
			}
			redirect('application/edit/'.$_POST['pizza_name']);
		}
	}
}
