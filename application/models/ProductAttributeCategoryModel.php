<?php

class ProductAttributeCategoryModel extends Model
{
    public function getList()
    {
        $sql = 'SELECT * FROM product_attribute_category';
        return $this->db->getAll($sql);
    }
}