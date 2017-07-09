<?php
/**
 * Controller class example
 * 
 * note: Model name passed in the constructor
 * 
 * TODO implement get/post request handler
 * 
 */
class Controller {
	
	function __construct($modelName='Model') {
			$this->viewLoader = new LoadView();
			$this->model = new $modelName();
	}
    function loadModel($modelName, $nickName){
	    if(!$modelName)
	        return false;
	    $name = $nickName ? $nickName : $modelName;
        $this->$name = new $modelName();
    }

    function category_list(){
        $this->loadModel('category_model', 'category');
        $categories = $this->category->getCategoryList();
        $indexed_categories = array();
        foreach($categories as $item){
            if($item['parent_category_id'])
                $indexed_categories[$item['parent_category_id']][] = $item;
        }
        return $indexed_categories;
    }

}
