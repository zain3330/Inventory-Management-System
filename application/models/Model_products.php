<?php

class Model_products extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getProductData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM products p 
			inner join products_attributes a on a.product_id= p.id
			inner join attributes ar on ar.id=a.attribute_id
			 where p.id = ?";
			$query = $this->db->query($sql, array($id));
			// $attr_sql = "SELECT "
			return $query->row_array();
		}

		$sql = "SELECT * FROM products ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getOrderProductData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM products where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM products ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getActiveProductData()
	{
		$sql = "SELECT * FROM products WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		$arr = $query->result_array();

		return $query->result_array();
	}
	private function update_attributes($material_array)
	{
		$ids = array();
		foreach ($material_array as $material) {
			array_push($ids, $material['material_id']);
		}

		$query = $this->db->where_in('id', $ids)->get('attributes');
		$materials = $query->result_array();
		foreach ($materials as $item) {
			if ($item['id'] == $material_array['material_id']) {
				$material['quantity'] -= $material_array['material_quantity'];
			}
		}

		$this->db->update(
			'attributes',
			array(
				'id' => $material['material_id'],
				'quantity' => $material['quantity']
			)
		);

	}
	public function create($data)
	{
		$insert = null;
		if ($data) {
			$product_materials = $data['data_list'];
			unset($data['data_list']);
			$this->db->trans_start(); // start transaction
			$insert = $this->db->insert('products', $data);
			$product_id = $this->db->insert_id(); // retrieve ID of newly inserted product
			$product_quantity = $data['qty'];
			foreach ($product_materials as $material) {
				$this->db->insert(
					'products_attributes',
					array(
						'product_id' => $product_id,
						'attribute_id' => $material['material_id'],
						'quantity' => $material['material_quantity']
					)
				);


			}

			$this->db->query("
            UPDATE attributes a
            INNER JOIN products_attributes pa ON pa.attribute_id = a.id
            SET a.quantity = a.quantity - (pa.quantity * $product_quantity)
            WHERE pa.product_id = $product_id;
			");

		}
		$this->db->trans_complete();
		return ($insert == true) ? true : false;
	}


	public function update($data, $id)
	{
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('products', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('products');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM products";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function update_quantity($id, $quantity, $price)
	{
		// die($id);
		$sql = "UPDATE attributes a
	INNER JOIN products_attributes pa ON pa.attribute_id = a.id
	SET a.quantity = a.quantity - (pa.quantity * $quantity)
	WHERE pa.product_id = $id";
		$this->db->query($sql);
		$update = $this->db->query("
            UPDATE products 
            SET qty = $quantity,
			price = $price
            WHERE id = $id;
			");
		return ($update == true) ? true : false;
	}
	public function getQuantity($id)
	{
		$sql = "SELECT a.name, p.quantity, a.quantity as attribute_quantity
		FROM products_attributes p 
		INNER JOIN products pr ON pr.id = p.product_id 
		INNER JOIN attributes a ON a.id = p.attribute_id 
		WHERE p.product_id = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}