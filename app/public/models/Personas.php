<?php

namespace Clases;

require_once 'Database.php';

use PDO;

use Clases\Database;

class Personas
{
	protected $name;
	protected $lastName;
	protected $dni;
	protected $gender = "X";
	//
	private $email;
	private $addresses;
	private $country;

	private $pass;

	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = trim(ucwords(strtolower($name)));
	}

	public function getLastName()
	{
		return $this->lastName;
	}
	public function setLastName($lastName)
	{
		$this->lastName = trim(ucwords(strtolower($lastName)));
	}

	public function getDni()
	{
		return $this->dni;
	}
	public function setDni($dni)
	{
		$this->dni = $dni;
	}

	public function getGender()
	{
		return $this->gender;
	}
	public function setGender($gender)
	{
		$this->gender = $gender;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = strtolower(trim($email));
	}

	public function getAddresses()
	{
		return $this->addresses;
	}

	public function setAddresses($addresses)
	{
		$this->addresses = trim(ucwords(strtolower($addresses)));
	}

	public function getCountry()
	{
		return $this->country;
	}

	public function setCountry($country)
	{
		$this->country = trim(ucwords(strtolower($country)));
	}

	public function getPass()
	{
		return $this->pass;
	}

	public function setPass($pass)
	{
		$this->pass = password_hash($pass, PASSWORD_DEFAULT);
	}

	public function insert()
	{
		$insert = "INSERT INTO people (name,last_name,dni,gender,email,pass,addresses,country) VALUES (?,?,?,?,?,?,?,?)";

		$stmt = Database::conectar()->prepare($insert);
		$stmt->bindParam(1, $this->name);
		$stmt->bindParam(2, $this->lastName);
		$stmt->bindParam(3, $this->dni);
		$stmt->bindParam(4, $this->gender);
		$stmt->bindParam(5, $this->email);
		$stmt->bindParam(6, $this->pass);
		$stmt->bindParam(7, $this->addresses);
		$stmt->bindParam(8, $this->country);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $stmt->errorCode();
		} else {
			$result = ["Codigo de error: ", $stmt->errorCode(), "Detalle:", $stmt->errorInfo()];
			return $result;
		}
	}

	public function selectAll()
	{
		$query = '
		SELECT people.id AS "id"
			,CONCAT_WS(", ",people.name, people.last_name) AS "people"
    		,people.dni AS "dni"
    		,people.gender AS "gender"
    		,people.email AS "email"
    		,people.addresses AS "addresses"
    		,people.country AS "country"
		FROM people
		WHERE people.rol_id != 1
		';

		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectPeople()
	{
		$query = '
		SELECT people.id AS "id"
			,CONCAT_WS(", ",people.name, people.last_name) AS "people"
		FROM people
		WHERE people.rol_id != 1
		';

		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function update($id)
	{
		$update = "
		UPDATE `people` SET `name`= ?	
    		,`last_name`= ?
    		,`dni`= ?
    		,`gender`= ?
    		,`email`= ?
    		,`addresses`= ?
    		,`country`= ?
		WHERE `id` = ?
		";

		$stmt = Database::conectar()->prepare($update);
		$stmt->bindParam(1, $this->name);
		$stmt->bindParam(2, $this->lastName);
		$stmt->bindParam(3, $this->dni);
		$stmt->bindParam(4, $this->gender);
		$stmt->bindParam(5, $this->email);
		$stmt->bindParam(6, $this->addresses);
		$stmt->bindParam(7, $this->country);
		$stmt->bindParam(8, $id);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function delete($id)
	{
		$delete = "DELETE FROM `people` WHERE `id` = ?";

		$stmt = Database::conectar()->prepare($delete);
		$stmt->bindParam(1, $id);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectOne($id)
	{
		$query = '
		SELECT CONCAT_WS(", ",people.name, people.last_name) AS "titular"
    		,people.dni AS "dni"
    		,people.gender AS "gender"
    		,people.email AS "email"
    		,people.addresses AS "addresses"
    		,people.country AS "country"
		FROM people
		WHERE people.id = ?
		';

		$stmt = Database::conectar()->prepare($query);

		$stmt->bindParam(1, $id);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetch(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}
}
