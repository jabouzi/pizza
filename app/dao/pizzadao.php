<?php

class Pizzadao {

	private $db;

	function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function insert_pizza($pizza)
	{
		$args = array(
			':customer_id' => $pizza->get_customer(),
			':ingredient_1' => item($pizza->get_ingredients(), 0),
			':ingredient_2' => item($pizza->get_ingredients(), 1),
			':ingredient_3' => item($pizza->get_ingredients(), 2),
			':delivery' => $pizza->get_type(),
			':canceled' => $pizza->get_status()
		);
		$query = "INSERT INTO pizza (customer_id, ingredient_1, ingredient_2, ingredient_3, delivery, canceled) 
				VALUES (:customer_id, :ingredient_1, :ingredient_2, :ingredient_3, :delivery, :canceled)";
		$insert = $this->db->query($query, $args);
		return $insert;
	}

	public function update_pizza($pizza, $pizza_id)
	{
		$args = array(
			':pizza_id' => $pizza_id;
			':customer_id' => $pizza->get_customer(),
			':ingredient_1' => item($pizza->get_ingredients(), 0),
			':ingredient_2' => item($pizza->get_ingredients(), 1),
			':ingredient_3' => item($pizza->get_ingredients(), 2),
			':delivery' => $pizza->get_type(),
			':canceled' => $pizza->get_status()
		);

		$query = "UPDATE pizza SET
				customer_id = :customer_id, ingredient_1 = :ingredient_1, ingredient_2 = :ingredient_2, ingredient_3 = :ingredient_3, 
				delivery = :delivery, canceled = :canceled WHERE pizza_id = :pizza_id";
		$update = $this->db->query($query, $args);
		return $update;
	}

	public function delete_pizza($pizza_id)
	{
		$args = array(':pizza_id' => $pizza_id);
		$query = "DELETE FROM pizza WHERE pizza_id = :pizza_id";
		$delete = $this->db->query($query, $args);
		return $delete;
	}

	public function select_all()
	{
		$args = array();
		$query = "SELECT * FROM pizza WHERE 1 ORDER BY pizza_id ASC";
		$results = $this->db->query($query, $args);
		if (!count($results)) return false;
		return $results;
	}

	public function select_pizza($pizza_id)
	{
		$args = array(':pizza_id' => $pizza_id);
		$query = "SELECT * FROM pizza_info WHERE pizza_id = :pizza_id";
		$result = $this->db->query($query, $args);
		if (!count($result)) return false;
		return $result[0];
	}
}
