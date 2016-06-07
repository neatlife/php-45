<?php

class ProductCategoryController extends BackendController
{
    public function createAction()
    {
        $productCategoryModel = new ProductCategoryModel('product_category');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productCategory = array();
            $productCategory['name'] = $_POST['cat_name'];
            $productCategory['parent_id'] = $_POST['parent_id'];

            if (!$productCategory['name']) {
                return $this->redirect('index.php?controller=backend/productCategory&action=create', '添加失败.', 3, 2);
            }

            if ($productCategoryModel->insert($productCategory)) {
                return $this->redirect('index.php?controller=backend/productCategory&action=index', '添加成功.', 3, 2);
            } else {
                return $this->redirect('index.php?controller=backend/productCategory&action=create', '添加失败.', 3, 2);
            }
        } else {
            $productCategorys = $productCategoryModel->getTree();
            return $this->render('backend/product-category/create', array(
                'productCategorys' => $productCategorys,
            ));
        }
    }

    public function indexAction()
    {
        $productCategoryModel = new ProductCategoryModel('product_category');
        $productCategorys = $productCategoryModel->getTree();
        return $this->render('backend/product-category/index', array(
            'productCategorys' => $productCategorys,
        ));
    }

    public function deleteAction()
    {
        $id = $_GET['id'];
        $productCategoryModel = new ProductCategoryModel('product_category');

        // 1. 先查询删除的分类下边是否有子分类，如果有子分类，不让删除。
        if ($productCategoryModel->total('parent_id=' . $id)) {
            return $this->redirect('index.php?controller=backend/productCategory&action=index', '删除失败, 请先清空子分类.', 4, 2);
        }

        // 删除操作
        if ($productCategoryModel->delete($id)) {
            return $this->redirect('index.php?controller=backend/productCategory&action=index', '删除成功.', 4, 2);
        } else {
            return $this->redirect('index.php?controller=backend/productCategory&action=index', '删除失败.', 4, 2);
        }
    }

    public function updateAction()
    {
        $productCategoryModel = new ProductCategoryModel('product_category');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productCategory = array();
            $productCategory['id'] = $_GET['id'];
            $productCategory['name'] = $_POST['cat_name'];
            $productCategory['parent_id'] = $_POST['parent_id'];

            // 过滤和验证
            if (!$productCategory['name']) {
                return $this->redirect('index.php?controller=backend/productCategory&action=create', '添加失败.', 3, 2);
            }
            // 产品分类的上级分类不能为商品分类本身...


            if ($productCategoryModel->update($productCategory)) {
                return $this->redirect('index.php?controller=backend/productCategory&action=index', '修改成功.', 3, 2);
            } else {
                return $this->redirect('index.php?controller=backend/productCategory&action=create', '修改失败.', 3, 2);
            }
        } else {
            $id = $_GET['id'];
            $productCategory = $productCategoryModel->selectByPk($id);
            $productCategorys = $productCategoryModel->getTree();
            return $this->render('backend/product-category/update', array(
                'productCategorys' => $productCategorys,
                'productCategory' => $productCategory,
            ));
        }
    }
}











