<?php
/**
 * Generic model make db connection or what you need
 *
 */
class Model {
	function __construct() {
		$this -> db = new Database();
	}
}
