<?php

class Stonefront_Resource_Product extends Zend_Db_Table_Abstract
                                  implements Stonefront_Resource_Product_Interface
{
    protected $_name = 'product';
    
    protected $_primary = 'productId';
    
    protected $_rowClass = 'Stonefront_Resource_Product_Item';
	
	/**
     * Gets Product row by ID
     * 
     * @param int $id
     * @return Stonefront_Resource_Product_Item|null
     */
    public function getProductById ($id)
    {
        return $this->find($id)->current();
    }

	/**
     * Gets Product by ident
     * 
     * @param string $ident
     * @return Stonefront_Resource_Product_Item|null
     */
    public function getProductByIdent ($ident)
    {
        return $this->fetchRow($this->select()->where('ident = ?', $ident));
    }

	/**
     *  Gets Product list by category
     *  
     *  @param int $categoryId
     *  @param int|null $paged
     *  @param array|null $order
     *  @return Zend_Db_Table_Rowset|Zend_Paginator
     */
    public function getProductsByCategory ($categoryId, $paged = null, $order = null)
    {
        $query = $this->select()
                      ->from('product')
                      ->where('categoryId IN(?)', $categoryId);
                      
        if (true === is_array($order))
        {
            $query->order($order);
        }
        
        if (null !== $paged)
        {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($query);
            
            $count = clone $query;
            $count->reset(Zend_Db_Select::COLUMNS);
            $count->reset(Zend_Db_Select::FROM);
            $count->from(
            	'product', 
                new Zend_Db_Expr('COUNT(*) AS `zend_paginator_row_count')
            );
            
            $adapter->setRowCount($count);
            
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(5)
                      ->setCurrentPageNumber((int) $paged);
                      
            return $paginator;
        }
        
        return $this->fetchAll($query);
    }

	/**
     * 
     */
    public function saveProduct ($info)
    {
        // TODO Auto-generated method stub
        
    }

    
    
}