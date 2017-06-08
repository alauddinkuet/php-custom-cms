<?php
/**
 *
 * basic view class  
 *
 */

class LoadView {

	private $properties;

	function __construct() {

	}
/**
 * 
 * Basic render function with attached header and footer
 * 
 * 
 */
	public function render($name, $data = null) {
		if (is_array($data)) {
			extract($data);
		}
		if (!empty($properties) && is_array($properties) ) {
			extract($properties);
		}

		include VIEWPATH . 'header.php';
		include VIEWPATH . $name . '.php';
		include VIEWPATH . 'footer.php';

	}

	public function __set($property, $value) {
		if (!isset($this -> $property)) {
			$this -> properties[$property] = $value;
		}
	}

	public function __get($property) {
		if (isset($this -> properties[$property])) {
			return $this -> properties[$property];
		}
	}

}
