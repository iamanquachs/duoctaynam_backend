<?php
class database
{
	public $connect;
	public function __construct()
	{
		try {
			$this->connect = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
			// set the PDO error mode to exception
			$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}
	public function __destruct()
	{
		$this->connect = null;
	}
}
