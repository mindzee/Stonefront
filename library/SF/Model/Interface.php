<?php
/**
 * SF_Model_Interface
 * 
 * All models use this interface
 * 
 * @category   Stonefront
 * @package    SF_Model
 * @copyright  Copyright (c) 2011 Mindaugas Dargis
 * @license    New BSD License
 */
interface SF_Model_Interface
{
    public function __construct($options = null);
    public function getResource($name);
    public function getForm($name);
    public function init();
}
