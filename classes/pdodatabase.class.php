<?php
class pdodatabase
{
	private $config;
	private $connection;
	private $pdoString;
	function __construct()
	{
		$this->config = new config;
		$this->pdoString = $this->config->values->DB_TYPE;
		$this->pdoString .= ':dbname='.$this->config->values->DB_NAME;
		$this->pdoString .= ';host='.$this->config->values->DB_HOST;		
		try
		{
			$this->connection = new PDO($this->pdoString, $this->config->values->DB_USERNAME, $this->config->values->DB_PASSWORD);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo 'ERROR: ' . $e->getMessage();
		}
	}

	function query($q)
	{
		try
		{
			$stmt = $this->connection->prepare($q);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		catch(PDOException $e)
		{
			echo 'ERROR: ' . $e->getMessage();
		}
	}

	function singleRow($q)
	{
		try
		{
			$stmt = $this->connection->prepare($q);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
		}
		catch(PDOException $e)
		{
			echo 'ERROR: ' . $e->getMessage();
		}		
	}

	/* Create, Update, Delete */
	function crud($q)
	{
		try
		{
			$stmt = $this->connection->prepare($q);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			echo 'ERROR: ' . $e->getMessage();
		}
	}

	function lastInserted($table)
	{
		$row = $this->singleRow("SELECT * FROM `{$table}` ORDER BY `id` DESC LIMIT 1");
		return $row->id;
	}

	function __destruct()
	{
		$this->connection = NULL;
	}
}
?>