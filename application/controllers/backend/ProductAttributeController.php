<?php

class ProductAttributeController extends BackendController
{
    /**
     * 产品属性列表页
     */
    public function indexAction()
    {
        $categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : false;
        /**
         * 拿所有的产品属性记录
         */
        $productAttributeModel = new ProductAttributeModel('product_attribute');
        $productAttributes = $productAttributeModel->getList($categoryId);

        return $this->render('backend/product-attribute/index', array(
            'productAttributes' => $productAttributes,
        ));
    }

    public function createAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productAttribute = array();
            $productAttribute['name'] = $_POST['attr_name'];
            $productAttribute['category_id'] = $_POST['type_id'];
            $productAttribute['select_type'] = $_POST['attr_input_type'];
            $productAttribute['optional_value'] = isset($_POST['attr_value']) ? $_POST['attr_value'] : '';

            $productAttribute['category_id'] = (int) $productAttribute['category_id'];
            if (!$productAttribute['name']) {
                return $this->redirect('index.php?controller=backend/productAttribute&action=create', '属性名不能为空', 3, 2);
            }
            // 更多的过滤和校验

            $productAttributeModel = new ProductAttributeModel('product_attribute');
            if ($productAttributeModel->insert($productAttribute)) {
                return $this->redirect('index.php?controller=backend/productAttribute&action=index', '属性添加成功', 3, 2);
            } else {
                return $this->redirect('index.php?controller=backend/productAttribute&action=create', '属性添加失败s', 3, 2);
            }
        } else {
            $productAttributeCategoryModel = new ProductAttributeCategoryModel('product_attribute_category');
            $productAttributeCategorys = $productAttributeCategoryModel->getList();

            return $this->render('backend/product-attribute/create', array(
                'productAttributeCategorys' => $productAttributeCategorys,
            ));
        }
    }
}










