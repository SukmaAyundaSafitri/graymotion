<?php

class QueryBuilder {
	protected $pdo; 
	protected $table;
	protected $query;
	protected $primary;
	protected $columns;

	public function __construct($pdo, $database, $table, $primary) {
		$this->pdo = $pdo;
		$this->table = $table;
		$this->primary = $primary;

		$this->initColumns($database);
	}

	public function initColumns($database) {
		$prepare = $this->pdo->prepare("SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$this->table' AND EXTRA != 'auto_increment'");
		$prepare->execute();

		foreach($prepare->fetchAll(PDO::FETCH_NUM) as $column) {
			$this->columns[] = $column[0];
		}
	}

	public function QueryInsert() {
		return 'INSERT INTO ' . $this->table . ' (' . implode(', ', $this->columns) . ') VALUES (:' . implode(', :', $this->columns) . ')';
	}

	public function QueryUpdate($data) {
		$values = '';

		$i = 0;
		foreach($data as $key => $value) {
			$values .= $key . " = '$value'";

			if(++$i != count($data))
				$values .= ', ';
		}

		return 'UPDATE ' . $this->table . ' SET ' . $values;
	}

	public function QueryDelete() {
		return 'DELETE FROM ' . $this->table;
	}

	public function QuerySelect($columns) {
		$this->query = 'SELECT ' . $columns . ' FROM ' . $this->table . ' :join :where :group :order :limit';
	}

	public function print_query() {
		$query = str_replace(':where', "", $this->query);
		$query = str_replace(':join', "", $query);
		$query = str_replace(':group', "", $query);
		$query = str_replace(':order', "", $query);
		$query = str_replace(':limit', "", $query);

		echo $query;
	}

	public function get() {
		$query = str_replace(':where', "", $this->query);
		$query = str_replace(':join', "", $query);
		$query = str_replace(':group', "", $query);
		$query = str_replace(':order', "", $query);
		$query = str_replace(':limit', "", $query);

		$prepared = $this->pdo->prepare($query);
		$prepared->execute();

		$data = [];
		foreach($prepared->fetchAll(PDO::FETCH_ASSOC) as $b) {
			$data[] = $b;
		}

		return $data;
	}

	public function group($group) {
		$this->query = str_replace(':group', "GROUP BY $group", $this->query);

		return $this;
	}

	public function where($where) {
		$this->query = str_replace(':where', "WHERE $where", $this->query);

		return $this;
	}

	public function order($by, $sort) {
		$this->query = str_replace(':order', "ORDER BY $by $sort", $this->query);

		return $this;
	}

	public function limit($from, $num) {
		$this->query = str_replace(':limit', "LIMIT $from, $num", $this->query);

		return $this;
	}

	public function join($tbls) {
		$val = '';

		foreach ($tbls as $key => $value) {
			$val .= $key . ' ON ' . $value; 
		}

		$this->query = str_replace(':join', $val, $this->query);

		return $this;
	}
}