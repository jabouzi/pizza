<?php

class Pizzabuilder
{
	protected $pizza = NULL;
	protected $pizza_data = array();

	public function __construct($pizza_data)
	{
		$this->pizza_data = $pizza_data;
	}

	public function build()
	{
		$this->pizza = new Pizzadata();
		$this->pizza->set_customer($this->pizza_data['customer_id']);
		$this->pizza->set_ingredients(array($this->pizza_data['ingredient_1'], $this->pizza_data['ingredient_2'], $this->pizza_data['ingredient_3']));
		$this->pizza->set_price($this->pizza_data['price']);
		$this->pizza->set_type($this->pizza_data['delivery']);
		$this->pizza->set_status($this->pizza_data['cancelled']);
	}

	public function getpizza()
	{
		return $this->pizza;
	}
}
