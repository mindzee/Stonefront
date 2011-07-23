<?php

interface Stonefront_Resource_Category_Interface
{
    public function getCategoriesByParentId($id);
    public function getCategoryByIdent($ident);
    public function getCategoryById($id);
}