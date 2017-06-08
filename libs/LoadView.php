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
 */
	public function render($name, $data = null, $return = false) {
		if (is_array($data)) {
			extract($data);
		}
		if (!empty($this->properties) && is_array($this->properties) ) {
			extract($this->properties);
		}

        ob_start();
        include VIEWPATH . '/admin/' .$name . '.php';
        $content = ob_get_contents();
        ob_end_clean();

        if($return)
           return $content;
		include VIEWPATH . '/admin/header.php';
        echo $content;
        include VIEWPATH . '/admin/footer.php';

	}
    public function renderFront($name, $data = null, $return = false) {
        if (is_array($data)) {
            extract($data);
        }
        if (!empty($this->properties) && is_array($this->properties) ) {
            extract($this->properties);
        }
        ob_start();
        include VIEWPATH . '/admin/' .$name . '.php';
        $content = ob_get_contents();
        ob_end_clean();

        if($return)
            return $content;

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
