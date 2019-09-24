<?php

class Api {

	private $connect = '';

	function __construct(){

		$this->database_connection();
	}

	function database_connection() {

		$this->connect = new PDO("mysql:host=localhost;dbname=web_api", "root", "");
		$this->connect->exec("SET NAMES 'utf8';");
	}

	function accountCheck($username, $password)	{

		$sql = "SELECT * FROM account WHERE username='$username' AND password='$password'";
		$stmt = $this->connect->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($result) {

			$_SESSION['username'] = $username;

			header('Location: index.php');
		} else {

		?>
			<html>
				<div class='alert alert-warning'>Helytelen felhasználónév vagy jelszó!</div>
			</html>
		<?php
		}
	}

	function accountReg($fullname, $username, $password) {

		$sql = "INSERT INTO account (fullname,username,password) VALUES (:fullname,:username,:password)";
		$query = $this->connect->prepare($sql);
		$query->bindParam(':fullname', $fullname);
		$query->bindValue(':username', $username);
		$query->bindValue(':password', $password);
		$result = $query->execute();

		if ($result) {
		
		?>
			<script>
				alert("Sikeres regisztráció!")
			</script>
			<script>
				window.location = "login.php";
			</script>
		<?php
		}
	}

	function fetch_all() {

		$query = "SELECT * FROM vasarolttermekek ORDER BY id";
		$statement = $this->connect->prepare($query);

		if ($statement->execute()) {

			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}

			return $data;
		}
	}

	function fetch_single($id) {

		$query = "SELECT * FROM vasarolttermekek WHERE id=" . $id . "";
		$statement = $this->connect->prepare($query);

		if ($statement->execute()) {

			foreach ($statement->fetchAll() as $row) {

				$data['termekId'] = $row['termekId'];
				$data['darab'] = $row['darab'];
				$data['termeknev'] = $row['termeknev'];
				$data['ar'] = $row['ar'];
				$data['vasarlo'] = $row['vasarlo'];
			}

			return $data;
		}
	}

	function insert() {

		if (isset($_POST["termekId"])) {

			$form_data = array(

				':termekId' => $_POST["termekId"],
				':darab' => $_POST["darab"],
				':termeknev' => $_POST["termeknev"],
				':ar' => $_POST["ar"],
				':vasarlo' => $_POST["vasarlo"]
			);

			$query = "INSERT INTO vasarolttermekek (termekId, darab, termeknev, ar, vasarlo) Values (:termekId, :darab, :termeknev, :ar, :vasarlo)";

			$statement = $this->connect->prepare($query);

			if ($statement->execute($form_data)) {

				$data[] = array(
					"success" => "1"
				);
			} else {
				$data[] = array(
					"success" => "0"
				);
			}
		} else {

			$data[] = array(
				"success" => "0"
			);
		}

		return $data;
	}

	function update() {

		if (isset($_POST["termekId"])) {

			$form_data = array(

				':termekId' => $_POST["termekId"],
				':darab' => $_POST["darab"],
				':termeknev' => $_POST["termeknev"],
				':ar' => $_POST["ar"],
				':vasarlo' => $_POST["vasarlo"],
				':id' => $_POST["id"]
			);

			$query = "UPDATE vasarolttermekek SET termekId= :termekId, darab= :darab, termeknev= :termeknev, ar= :ar, vasarlo= :vasarlo WHERE id= :id";

			$statement = $this->connect->prepare($query);

			if ($statement->execute($form_data)) {

				$data[] = array(
					"success" => "1"
				);
			} else {

				$data[] = array(
					"success" => "0"
				);
			}
		} else {

			$data[] = array(
				"success" => "0"
			);
		}

		return $data;
	}

	function destroy($id) {

		$query = "DELETE FROM vasarolttermekek WHERE id= " . $id . "";
		$statement = $this->connect->prepare($query);

		if ($statement->execute()) {

			$data[] = array(
				"success" => "1"
			);
		} else {

			$data[] = array(
				"success" => "0"
			);
		}

		return $data;
	}
}
?>