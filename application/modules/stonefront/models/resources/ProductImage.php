<?php

class Stonefront_Resource_ProductImage extends Zend_Db_Table_Abstract
                                       implements Stonefront_Resource_ProductImage_Interface
{
    protected $_name = 'productImage';
    
    protected $_primary = 'imageId';
    
    protected $_rowClass = 'Stonefront_Resource_ProductImage_Item';
    
    protected $_referenceMap = array(
        'Image' => array(
            'columns'       => 'productId',
            'refTableClass' => 'Stonefront_Resource_Product',
            'refColumns'    => 'productId',
        )
    );
}