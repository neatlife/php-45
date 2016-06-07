<?php

class ProductModel extends Model
{
    /**
     * 获取热门商品
     * @param $limit integer 取多少条
     */
    public function getHot($limit)
    {
        $sql = 'select * from product where is_hot = 1 limit ' . $limit;
        return $this->db->getAll($sql);
    }

    public function getNew($limit)
    {
        $sql = 'select * from product where is_new = 1 limit ' . $limit;
        return $this->db->getAll($sql);
    }
}