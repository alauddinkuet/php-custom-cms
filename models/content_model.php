<?php
/**
 * main page model example
 *
 * */
class Content_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getContent($page_name_seo){
        $sql = "SELECT *FROM tbl_content_page WHERE page_name_seo = :page_name_seo";
        return $this->db->fetchSingle($sql, array(':page_name_seo' => $page_name_seo));
    }
}