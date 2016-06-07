<?php

class ProductController extends BackendController
{
    public function createAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product = array();
            $product['category_id'] = $_POST['cat_id'];
            $product['brand_id'] = $_POST['brand_id'];
            $product['name'] = $_POST['goods_name'];
            $product['serial_number'] = $_POST['goods_sn'];
            $product['market_price'] = $_POST['market_price'];
            $product['shop_price'] = $_POST['shop_price'];
            $product['stock'] = $_POST['goods_number'];
            $product['on_time'] = time();
            $product['description'] = $_POST['goods_desc'];
            $product['is_best'] = isset($_POST['is_best']) ? $_POST['is_best'] : 0;
            $product['is_new'] = isset($_POST['is_new']) ? $_POST['is_new'] : 1;
            $product['is_hot'] = isset($_POST['is_hot']) ? $_POST['is_hot'] : 0;

            if (!$product['name']) {
                return $this->redirect('index.php?controller=backend/product&action=create', '产品名不能为空', 3, 2);
            }
            // 产品名是否存在
            // category_id必须在product_category表中存在, 整形
            // brand_id必须在brand_category表中存在, 整形
            // ....

            // 处理图片上传
            if ($_FILES['goods_img']['error'] !=0) {
                return $this->redirect('index.php?controller=backend/product&action=create', '图片上传失败.', 3, 2);
            }
            $this->loadLibrary('Upload');
            $upload = new Upload();
            $filename = $upload->up($_FILES['goods_img']);
            if (!$filename) {
                return $this->redirect('index.php?controller=backend/product&action=create', '图片上传失败.', 3, 2);
            }
            $product['orginal_image_path'] = $filename;

            // 处理图片缩略图
            $this->loadLibrary('Image');
            $image = new Image();
            $thumbnailFilename = $image->thumbnail(UPLOAD_PATH . $filename, 200, 200, UPLOAD_PATH);
            if (!$thumbnailFilename) {
                return $this->redirect('index.php?controller=backend/product&action=create', '缩略图生成失败.', 3, 2);
            }
            $product['thumbnail_image_path'] = $thumbnailFilename;

            $productModel = new ProductModel('product');
            $productId = $productModel->insert($product);
            if ($productId) {
                // 保存产品的属性
                $productAttributeRelModel = new ProductAttributeRelModel('product_attribute_rel');
                foreach($_POST['attr_id_list'] as $index => $productAttributeId) {
                    $productAttributeValue = $_POST['attr_value_list'][$index];
                    $productAttributeRel = array();
                    $productAttributeRel['attribute_id'] = $productAttributeId;
                    $productAttributeRel['value'] = $productAttributeValue;
                    $productAttributeRel['product_id'] = $productId;
                    $productAttributeRelModel->insert($productAttributeRel);
                }
                return $this->redirect('index.php?controller=backend/product&action=create', '产品添加成功.', 3, 2);
            } else {
                return $this->redirect('index.php?controller=backend/product&action=create', '产品添加失败.', 3, 2);
            }
        } else {
            $productCategoryModel = new ProductCategoryModel('product_category');
            $productCategorys = $productCategoryModel->getTree();
            $productBrandModel = new ProductBrandModel('product_brand');
            $productBrands = $productBrandModel->getList();
            $productAttributeCategoryModel = new ProductAttributeCategoryModel('product_attribute_category');
            $productAttributeCategorys = $productAttributeCategoryModel->getList();
            return $this->render('backend/product/create', array(
                'productCategorys' => $productCategorys,
                'productBrands' => $productBrands,
                'productAttributeCategorys' => $productAttributeCategorys,
            ));
        }
    }

    public function loadAttributeTableAction()
    {
        $productAttributeCategoryId = (int) $_GET['category_id'];
        $productAttributeModel = new ProductAttributeModel('product_attribute');
        $attributeTable = $productAttributeModel->generateTable($productAttributeCategoryId);
        echo <<<HTML
<script>
    window.parent.document.getElementById('attrTable').innerHTML = "{$attributeTable}";
</script>
HTML;

    }
}













