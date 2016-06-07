<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SHOP 管理中心 - 类型管理 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="backend/styles/general.css" rel="stylesheet" type="text/css" />
    <link href="backend/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
    <span class="action-span"><a href="index.php?controller=backend/productAttributeCategory&action=create">新建商品属性分类</a></span>
    <span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品属性分类 </span>
    <div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
    <!-- start goods type list -->
    <div class="list-div" id="listDiv">

        <table width="100%" cellpadding="3" cellspacing="1" id="listTable">
            <tbody>
            <tr>
                <th>商品属性分类名称</th>
                <th>操作</th>
            </tr>
            <?php foreach($productAttributeCategorys as $productAttributeCategory): ?>
                <tr>
                    <td class="first-cell"><span onclick="javascript:listTable.edit(this, 'edit_type_name', 1)"><?php echo $productAttributeCategory['name'] ?></span></td>
                    <td align="center">
                        <a href="index.php?controller=backend/productAttribute&action=index&category_id=<?php echo $productAttributeCategory['id'] ?>" title="属性列表">属性列表</a> |
                        <a href="index.php?controller=backend/productAttributeCategory&action=update&id=<?php echo $productAttributeCategory['id'] ?>" title="编辑">编辑</a> |
                        <a href="index.php?controller=backend/productAttributeCategory&action=delete&id=<?php echo $productAttributeCategory['id'] ?>" onclick="return window.confirm('确认吗?');" title="移除">移除</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td align="right" nowrap="true" colspan="6" style="background-color: rgb(255, 255, 255);">
                    <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
                    <div id="turn-page">
                        <?php echo $pageHtml; ?>
                    </div>
                </td>
            </tr>
            </tbody></table>

    </div>
    <!-- end goods type list -->
</form>

<div id="footer">
    版权所有 &copy; 2012-2013 传智播客 - PHP培训 - </div>
</div>

</body>
</html>