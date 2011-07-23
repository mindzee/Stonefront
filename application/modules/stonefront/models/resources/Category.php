<?php

class Stonefront_Resource_Category extends Zend_Db_Table_Abstract
                                   implements Stonefront_Resource_Category_Interface
{
    protected $_name = 'category';
    
    protected $_primary = 'categoryId';
    
    protected $_rowClass = 'Stonefront_Resource_Category_Item';
    
    protected $_referenceMap = array(
        'SubCategory' => array(
            'columns' => 'parentId',
            'refTableClass' => 'Stonefront_Resource_Category',
            'refColumns'    => 'categoryId',
        )
    );
    
    /**
     * Gets available categories by parent Id.
     * 
     * @return Zend_Db_Table_Rowset
     * @param int $parentId
     */
    public function getCategoriesByParentId($parentId)
    {
        $query = $this->select()
                       ->where('parentId = ?', $parentId)
                       ->order('name');
                       
        return $this->fetchAll($query);
    }
    
	/**
     * Gets category by ident
     * 
     * @param string $ident
     * @return Storefront_Resource_Category_Item|null
     */
    public function getCategoryByIdent ($ident)
    {
        $query = $this->select()
                      ->where('ident = ?', $ident);
                      
        return $this->fetchRow($query);
    }

	/**
     * Gets Category by Id
     * 
     * @param int $id
     * @return Storefront_Resource_Category_Item|null
     */
    public function getCategoryById ($id)
    {
        $query = $this->select()
                      ->where('categoryId = ?', $id);
                      
        return $this->fetchRow($query);
    }

}