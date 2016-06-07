<?php

class ProductCategoryModel extends Model
{
    public function getList()
    {
        $sql = 'SELECT * FROM product_category';
        return $this->db->getAll($sql);
    }

    public function getTree()
    {
        $productCategorys = $this->getList();
        return $this->_tree($productCategorys);
    }

    protected function _tree($productCategorys, $parentId = 0, $level = 1)
    {
        static $productCategoryTrees = array();
        foreach($productCategorys as $productCategory) {
            if ($productCategory['parent_id'] == $parentId) {
                $productCategory['level'] = $level;
                $productCategoryTrees[] = $productCategory;
                $this->_tree($productCategorys, $productCategory['id'], $level + 1);
            }
        }
        return $productCategoryTrees;
    }

    public function getHomeTree($stopLevel = 3)
    {
        $productCategorys = $this->getList();
        return $this->_homeTree($productCategorys, 1, $stopLevel, 0);
    }

    protected function _homeTree($productCategorys, $startLevel = 1, $stopLevel = 3, $parentId = 0)
    {
        $productHomeTree = array();
        foreach($productCategorys as $productCategory) {
            if ($productCategory['parent_id'] == $parentId) {
                if (($startLevel + 1) <= $stopLevel) {
                    $productCategory['subchildrens'] = $this->_homeTree($productCategorys, $startLevel + 1, $stopLevel, $productCategory['id']);
                }
                $productHomeTree[] = $productCategory;
            }
        }
        return $productHomeTree;
    }
}