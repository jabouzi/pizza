<?php

class pizzamodel extends Model
{
	private $pizzadata;
	private $pizzadatadao;

	public function __construct()
	{
		parent::__construct();
		$this->pizzadata = new Pizzadata();
		$this->pizzadatadao = new Pizzadao();
	}

	public function add_pizza($pizzadata)
	{
		$builder = new pizzabuilder($pizzadata);
		$builder->build();
		$pizza = $builder->getpizza();
		$this->pizzadatadao->insert_pizza($pizza);
	}

	public function update_pizza($pizzadata)
	{
		$builder = new pizzabuilder($pizzadata);
		$builder->build();
		$pizza = $builder->getpizza();
		$this->pizzadatadao->update_pizza($pizza);
	}
	
	public function delete_pizza($pizza_id)
	{
		$this->pizzadatadao->delete_pizza($pizza_id);
	}

	public function get_pizza($pizza_id)
	{
		$result = $this->pizzadatadao->select_pizza($pizza_id);
		$builder = new pizzabuilder($result);
		$builder->build();
		$pizza = $builder->getpizza();
		return $pizza;
	}

	public function get_pizzas()
	{
		$pizzas = array();
		$results = $this->pizzadatadao->select_all();
		if (!$results) return array();
		foreach($results as $result)
		{
			$builder = new pizzabuilder($result);
			$builder->build();
			$pizzas[] = $builder->getpizza();
		}
		return $pizzas;
	}
}
