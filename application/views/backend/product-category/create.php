<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SHOP 管理中心 - 添加分类 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="backend/styles/general.css" rel="stylesheet" type="text/css" />
    <link href="backend/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
    <span class="action-span"><a href="index.php?p=admin&c=category&a=index">商品分类</a></span>
    <span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
    <form action="index.php?controller=backend/productCategory&action=create" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
        <table width="100%" id="general-table">
            <tbody>
            <tr>
                <td class="label">分类名称:</td>
                <td><input type="text" name="cat_name" maxlength="20" value="" size="27"> <font color="red">*</font></td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id">
                        <option value="0">顶级分类</option>
                        <?php foreach($productCategorys as $productCategory): ?>
                            <option value="<?php echo $productCategory['id'] ?>"><?php echo str_repeat('&nbsp;', $productCategory['level'] * 2) . $productCategory['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            </tbody></table>
        <div class="button-div">
            <input type="submit" value=" 确定 ">
            <input type="reset" value=" 重置 ">
        </div>

    </form>
</div>



<div id="footer">
    版权所有 &copy; 2012-2013 传智播客 - PHP培训 -
</div>

</div>

</body>
</html>