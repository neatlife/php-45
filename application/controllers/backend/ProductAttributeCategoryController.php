<?php

class ProductAttributeCategoryController extends BackendController
{
    public function createAction()
    {
        if ($_POST) {
            $productAttributeCategory = array();
            $productAttributeCategory['name'] = $_POST['type_name'];

            if (!$productAttributeCategory['name']) {
                return $this->redirect('index.php?controller=backend/productAttributeCategory&action=create', '属性分类名称必填.', 3, 2);
            }

            $productAttributeCategoryModel = new ProductAttributeCategoryModel('product_attribute_category');
            if ($productAttributeCategoryModel->insert($productAttributeCategory)) {
                return $this->redirect('index.php?controller=backend/productAttributeCategory&action=index', '属性分类插入成功.', 3, 2);
            } else {
                return $this->redirect('index.php?controller=backend/productAttributeCategory&action=create', '属性分类插入失败.', 3, 2);
            }
        } else {
            return $this->render('backend/product-attribute-category/create');
        }
    }

    public function indexAction()
    {
        $productAttributeCategoryModel = new ProductAttributeCategoryModel('product_attribute_category');
        // 1. 当前是第几页
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        // 2. 每页显示取多少条数据
        $pageSize = 2;
        // 3. 拿出当前页的数据
        $offset = ($currentPage - 1) * $pageSize;
        $productAttributeCategorys = $productAttributeCategoryModel->pageRows($offset, $pageSize);

        // 生成分页链接
        /*
        * @param $total number 总的记录数, 用来计算总页数
        * @param $pagesize number 每页的记录数, 用来计算总页数
        * @param $current number 当前所在页
        * @param $script string 当前请求的脚本名称,默认为空
        * @param $params array url所携带的参数,默认为空
         */
        $this->loadLibrary('Page');
        $page = new Page($productAttributeCategoryModel->total(''), $pageSize, $currentPage, 'index.php', array(
            'controller' => 'backend/productAttributeCategory',
            'action' => 'index',
        ));
        $pageHtml = $page->showPage();
        return $this->render('backend/product-attribute-category/index', array(
            'productAttributeCategorys' => $productAttributeCategorys,
            'pageHtml' => $pageHtml,
        ));
    }

    public function deleteAction()
    {
        $id = (int) $_GET['id'];
        $productAttributeCategoryModel = new ProductAttributeCategoryModel('product_attribute_category');
        if ($productAttributeCategoryModel->delete($id)) {
            return $this->redirect('index.php?controller=backend/productAttributeCategory&action=index', '属性分类删除成功.', 3, 2);
        } else {
            return $this->redirect('index.php?controller=backend/productAttributeCategory&action=index', '属性分类删除失败.', 3, 2);
        }
    }

    public function updateAction()
    {
        $productAttributeCategoryModel = new ProductAttributeCategoryModel('product_attribute_category');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productAttributeCategory = array();
            $productAttributeCategory['name'] = $_POST['type_name'];
            $productAttributeCategory['id'] = (int) $_GET['id'];

            if (!$productAttributeCategory['name']) {
                return $this->redirect('index.php?controller=backend/productAttributeCategory&action=update&id=' . $productAttributeCategory['id'], '属性分类名称必填.', 3, 2);
            }

            // 先拿出selectByPk($id)
            // 比较数据库中的值和用户提交的值是否相同, 相同直接返回,不再进行update处理.

            if ($productAttributeCategoryModel->update($productAttributeCategory)) {
                return $this->redirect('index.php?controller=backend/productAttributeCategory&action=index', '属性分类修改成功.', 3, 2);
            } else {
                // 1. 修改失败(sql错了,数据库连接失败)
                // 2. 什么都没改
                return $this->redirect('index.php?controller=backend/productAttributeCategory&action=update&id=' . $productAttributeCategory['id'], '修改失败或者修改前后内容一致.', 3, 2);
            }
        } else {
            $id = (int) $_GET['id'];
            $productAttributeCategory = $productAttributeCategoryModel->selectByPk($id);
            return $this->render('backend/product-attribute-category/update', array(
                'productAttributeCategory' => $productAttributeCategory,
            ));
        }
    }
}



















