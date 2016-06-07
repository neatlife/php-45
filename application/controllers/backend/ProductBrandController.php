<?php

class ProductBrandController extends BackendController
{
    public function createAction()
    {
        if (!empty($_POST)) {
            /**
             * 1. 收集表单数据
             */
            $productBrand = array();
            $productBrand['name'] = $_POST['brand_name'];
            $productBrand['site'] = $_POST['url'];
            $productBrand['description'] = $_POST['brand_desc'];
            $productBrand['display_order'] = $_POST['sort_order'];
            $productBrand['is_display'] = $_POST['is_show'];

            // 处理文件上传
            $this->loadLibrary('Upload');
            $upload = new Upload();
            $filename = $upload->up($_FILES['logo']);
            if ($filename) {
                $productBrand['image_path'] = $filename;
            } else {
                return $this->redirect('index.php?controller=backend/productBrand&action=create', '请上传产品品牌的logo', 3, 2);
            }

            /**
             * 2. 校验和过滤
             */
            if (!$productBrand['name']) {
                return $this->redirect('index.php?controller=backend/productBrand&action=create', '产品品牌的名称不能为空', 3, 2);
            }
            $productBrand['display_order'] = (int) $productBrand['display_order'];
            // 校验url 策略:
            // 策略1. 如果不是url, 将site字段置为空字符串
            // 策略2. 如果不是url, 调用redirect返回提示信息,结束当前请求的处理逻辑


            /**
             * 3. 尝试在数据库里添加当前产品品牌
             * 策略:
             *     1. 添加成功,跳转回产品品牌管理的列表, 添加失败,跳转回添加页面, 给提示信息
             */
            $productBrandModel = new ProductBrandModel('product_brand');
            if ($productBrandModel->insert($productBrand)) {
                return $this->redirect('index.php?controller=backend/productBrand&action=index', '添加成功.', 3, 2);
            } else {
                return $this->redirect('index.php?controller=backend/productBrand&action=create', '添加失败.', 3, 2);
            }
        } else {
            return $this->render('backend/product-brand/create');
        }
    }

    public function indexAction()
    {
        $productBrandModel = new ProductBrandModel('product_brand');
        $productBrands = $productBrandModel->getList();
        return $this->render('backend/product-brand/index', array(
            'productBrands' => $productBrands,
        ));
    }

    public function deleteAction()
    {
        $id = $_GET['id'];
        $productBrandModel = new ProductBrandModel('product_brand');
        if ($productBrandModel->delete($id)) {
            return $this->redirect('index.php?controller=backend/productBrand&action=index', '删除成功.', 3, 2);
        } else {
            return $this->redirect('index.php?controller=backend/productBrand&action=index', '删除失败.', 3, 2);
        }
    }

    public function updateAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            /**
             * 1. 收集表单数据
             */
            $productBrand = array();
            $productBrand['id'] = $_GET['id'];
            $productBrand['name'] = $_POST['brand_name'];
            $productBrand['site'] = $_POST['url'];
            $productBrand['description'] = htmlspecialchars($_POST['brand_desc']);
            $productBrand['display_order'] = $_POST['sort_order'];
            $productBrand['is_display'] = $_POST['is_show'];

            /**
             * 2. 校验和过滤
             */
            if (!$productBrand['name']) {
                return $this->redirect('index.php?controller=backend/productBrand&action=create', '产品品牌的名称不能为空', 3, 2);
            }
            $productBrand['display_order'] = (int) $productBrand['display_order'];
            // 校验url 策略:
            // 策略1. 如果不是url, 将site字段置为空字符串
            // 策略2. 如果不是url, 调用redirect返回提示信息,结束当前请求的处理逻辑

            if ($_FILES['logo']['error'] == 0) {
                // 处理文件上传
                $this->loadLibrary('Upload');
                $upload = new Upload();
                $filename = $upload->up($_FILES['logo']);
                if ($filename) {
                    $productBrand['image_path'] = $filename;
                } else {
                    return $this->redirect('index.php?controller=backend/productBrand&action=create', '请上传产品品牌的logo', 3, 2);
                }
            }

            /**
             * 3. 尝试在数据库里修改当前产品品牌
             * 策略:
             *     1. 修改成功,跳转回产品品牌管理的列表, 修改失败,跳转回修改页面, 给提示信息
             */
            $productBrandModel = new ProductBrandModel('product_brand');
            if ($productBrandModel->update($productBrand)) {
                return $this->redirect('index.php?controller=backend/productBrand&action=index', '产品品牌修改成功', 3, 2);
            } else {
                return $this->redirect('index.php?controller=backend/productBrand&action=update&id=' . $productBrand['id'], '产品品牌修改失败或者没有找到要修改的记录', 3, 2);
            }
        } else {
            $id = $_GET['id'];
            $productBrandModel = new ProductBrandModel('product_brand');
            $productBrand = $productBrandModel->selectByPk($id);

            return $this->render('backend/product-brand/update', array(
                'productBrand' => $productBrand,
            ));
        }
    }
}













