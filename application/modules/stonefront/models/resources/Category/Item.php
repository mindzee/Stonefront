<?php

class Stonefront_Resource_Category_Item extends SF_Model_Resource_Db_Table_Row_Abstract
                                        implements Stonefront_Resource_Category_Item_Interface
{
	/**
     * 
     */
    public function getParentCategory ()
    {
        return $this->findParentRow('Stonefront_Resource_Category', 'SubCategory');
    }

    
}