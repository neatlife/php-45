<?php

class ProductBrandModel extends Model
{
    /**
     * 拿出所有的产品品牌
     */
    public function getList()
    {
        $sql = 'SELECT * FROM product_brand';
        return $this->db->getAll($sql);
    }
}