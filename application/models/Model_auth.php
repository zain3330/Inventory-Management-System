<?php 

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
	*/
	public function check_email($email) 
	{
		if($email) {
			$sql = 'SELECT * FROM users WHERE email = ?';
			$query = $this->db->query($sql, array($email));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
	}

	/* 
		This function checks if the email and password matches with the database
	*/
	public function login($email, $password) {
		if($email && $password) {
			$sql = "SELECT * FROM users WHERE email = ?";
			$query = $this->db->query($sql, array($email));
			// return true;
			if($query->num_rows() == 1) {
				$result = $query->row_array();

				$hash_password = password_verify($password, $result['password']);
				if($hash_password === true) {
					return $result;	
				}
				else {
					return false;
				}

				
			}
			else {
				return false;
			}
		}
	}

		/* 
		This function checks if the email and password matches with the database
	*/
	public function register($data) {
		if($data['email'] && $data['password']) {
			// Check if email already exists
			$email_check = $this->db->get_where('users', array('email' => $data['email']))->num_rows();
			if($email_check > 0) {
				return false;
			}
	
			// Hash the password before storing it in the database
			$hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
	
			// Insert user data into the database
			$insert_data = array(
				'email' => $data['email'],
				'password' => $hashed_password
			);
			$this->db->insert('users', $insert_data);
	
			// Return the newly created user object
			$user_id = $this->db->insert_id();
			$new_user = $this->db->get_where('users', array('id' => $user_id))->row_array();
			return $new_user;
		}
	}
	
}