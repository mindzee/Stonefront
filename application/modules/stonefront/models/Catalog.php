<?php

class Stonefront_Model_Catalog extends SF_Model_Abstract
{
    public function getCategoriesByParentId($parentID)
    {}
    
    public function getCategoryByIdent($ident)
    {}
    
    public function getProductById($id)
    {}
    
    public function getProductByIdent($dent)
    {}
    
    public function getProductsByCategory($category, $paged = false, $order = null, $deep = true)
    {}
    
    public function getCategoryChildrenIds($categoryId, $recursive = false)
    {}
    
    public function getParentCategories($category)
    {}
}