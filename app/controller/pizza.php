<?php

class Pizza extends Controller
{
	private $pizzamodel;

	function __construct()
	{
		$this->pizzamodel = new pizzamodel();
		$this->customermodel = new customermodel();
	}

	public function index()
	{
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/pizza/search');
		view::load_view('default/standard/footer');
	}
	
	public function all()
	{
		$pizzas = $this->pizzamodel->get_pizzas();
		$data['pizzas'] = $pizzas;
		view::load_view('default/standard/header');
		view::load_view('default/standard/menu');
		view::load_view('default/pizza/pizzalist', $data);
		view::load_view('default/standard/footer');
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
		if (!$_POST['customer_id']) $_POST['customer_id'] = $this->customermodel->add_customer($_POST);
		else $this->customermodel->update_customer($_POST);
		for($i = 1; $i <=3; $i++)
		{
			if (!isset($_POST['ingredient_'.$i])) $_POST['ingredient_'.$i] = 0;
		}
		if (!isset($_POST['canceled'])) $_POST['canceled'] = 0;
		$this->pizzamodel->add_pizza($_POST);
		$_SESSION['message'] = lang('title.pizza.added');
		redirect('pizza/all');
	}
}
