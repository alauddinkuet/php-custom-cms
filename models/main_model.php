<?php
/**
 * main page model example
 *
 * */
class Main_Model extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getData() {
		$sth = $this -> db -> fetchAllAssoc('SELECT id,text FROM data');
		return $sth;

	}

	public function insertRow($data) {
		$sth = $this -> db -> onlyExecute('INSERT INTO data 
			(`text`) 
			VALUES (:data)
			', array(':data' => $data));
		if ($sth) {
			echo true;
		} else {
			echo false;
		}
	}

	public function updateSingleData($id, $data) {

		$sth = $this -> db -> onlyExecute('UPDATE data
			SET text = :text  WHERE id = :id', array(':id' => $id, ':text' => $data['value']));
		if ($sth) {
			echo true;
		} else {
			echo false;
		}
	
	}

	public function deleteRow($id) {
		$sth = $this -> db -> onlyExecute('DELETE FROM data WHERE id = :id', array(':id' => $id));
		if ($sth) {
			echo true;
		} else {
			echo false;
		}
	}

}
