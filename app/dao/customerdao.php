<?php

class Customerdao {

	private $db;

	function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function insert_customer($customer)
	{
		$args = array(
			':first_name' => $customer->get_first_name(),
			':last_name' => $customer->get_last_name(),
			':address' => $customer->get_address(),
			':address2' => $customer->get_address2(),
			':city' => $customer->get_city(),
			':postal_code' => $customer->get_postal_code(),
			':phone' => $_SESSION['request']['phone'] = preg_replace("/[^0-9]/","",$customer->get_phone()),
			':comments' => $customer->get_comments()
		);
		$query = "INSERT INTO customer (first_name, last_name, address, address2, city, postal_code, phone, comments) 
				VALUES (:first_name, :last_name, :address, :address2, :city, :postal_code, :phone, :comments)";
		$insert = $this->db->query($query, $args);
		return $this->db->lastInsertId();
	}

	public function update_customer($customer)
	{
		$args = array(
			':customer_id' => $customer->get_id(),
			':first_name' => $customer->get_first_name(),
			':last_name' => $customer->get_last_name(),
			':address' => $customer->get_address(),
			':address2' => $customer->get_address2(),
			':city' => $customer->get_city(),
			':postal_code' => $customer->get_postal_code(),
			':phone' => preg_replace("/[^0-9]/","",$customer->get_phone()),
			':comments' => $customer->get_comments(),
			':active' => $customer->get_status()
		);

		$query = "UPDATE customer SET first_name = :first_name, last_name = :last_name, address = :address, address2 = :address2, city = :city, 
					postal_code = :postal_code, phone = :phone, comments = :comments, active = :active WHERE customer_id = :customer_id";
		$update = $this->db->query($query, $args);
		return $update;
	}

	public function delete_customer($customer_id)
	{
		$args = array(':customer_id' => $customer_id);
		$query = "DELETE FROM customer WHERE customer_id = :customer_id";
		$delete = $this->db->query($query, $args);
		return $delete;
	}

	public function select_all()
	{
		$args = array();
		$query = "SELECT * FROM customer WHERE 1 ORDER BY customer_id ASC";
		$results = $this->db->query($query, $args);
		if (!count($results)) return false;
		return $results;
	}
	
	public function select_by_phone($phone)
	{
		$args = array(':phone' => $phone);
		$query = "SELECT * FROM customer WHERE phone = :phone ORDER BY customer_id ASC";
		$results = $this->db->query($query, $args);
		if (!count($results)) return false;
		return $results;
	}

	public function select_customer($customer_id)
	{
		$args = array(':customer_id' => $customer_id);
		$query = "SELECT * FROM customer WHERE customer_id = :customer_id";
		$result = $this->db->query($query, $args);
		if (!count($result)) return false;
		return $result[0];
	}
}
