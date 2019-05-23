<?php

include 'QueryBuilder.php';
 
class ORM {
	public $pdo;
	protected $table;
	protected $query;
	protected $primary = 'id';
	public $qBuilder;

	public function __construct() {
		include 'config.php';

		$this->table = get_called_class();
		$this->pdo = new PDO('mysql:host=' . $config['hostname'] . ';dbname=' . $config['database'], $config['username'], $config['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		$this->qBuilder = new QueryBuilder($this->pdo, $config['database'], $this->table, $this->primary);
	}

	public function CustomSelect($query) {
		$a = $this->pdo->prepare($query);
		$a->execute();

		return $a->fetchAll(PDO::FETCH_ASSOC);
	}

	public function IsExists($data, $where = '') {
		if($where == '')
			$res = $this->Select($data)->get();
		else
			$res = $this->Select($data)->where($where)->get();
		
		return $res[0]['ttl'] > 0;
	}

	public function Insert($data) {
		$query = $this->qBuilder->QueryInsert();
		$prepared = $this->pdo->prepare($query);
		$prepared->execute($data);

		return $prepared;
	}

	public function Update($data, $where = '') {
		$query = $this->qBuilder->QueryUpdate($data) . ' ' . $where;
		$prepared = $this->pdo->prepare($query);
		$prepared->execute();
	}

	public function Delete($where = '') {
		$query = $this->qBuilder->QueryDelete() . ' ' . $where;
		$prepared = $this->pdo->prepare($query);
		$prepared->execute();
	}

	public function Select($columns) {
		$this->qBuilder->QuerySelect($columns);
		return $this->qBuilder;
	}

	public function LastInsert() {
		return $this->pdo->lastInsertId();
	}

	
}