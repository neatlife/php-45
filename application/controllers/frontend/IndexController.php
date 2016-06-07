<?php

class IndexController extends Controller
{
    public function indexAction()
    {
        $productModel = new ProductModel('product');
        $productCategoryModel = new ProductCategoryModel('product_category');

        $limit = 4;
        // 拿4条热门商品
        $hotProducts = $productModel->getHot($limit);
        // 拿新品
        $newProducts = $productModel->getNew($limit);

        $productCategorys = $productCategoryModel->getHomeTree();

        return $this->render('frontend/index/index', array(
            'hotProducts' => $hotProducts,
            'newProducts' => $newProducts,
            'productCategorys' => $productCategorys,
        ));
    }
}