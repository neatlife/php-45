<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title></title>
    <link href="backend/styles/general.css" rel="stylesheet" type="text/css" />
    <link href="backend/styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="backend/js/utils.js"></script>
    <script type="text/javascript" src="backend/js/selectzone.js"></script>
    <script type="text/javascript" src="backend/js/colorselector.js"></script>
    <script type="text/javascript" src="backend/js/calendar.php?lang="></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="index.php?p=admin&c=goods&a=index">商品列表</a></span>
    <span class="action-span1"><a href="index.php?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 编辑商品信息 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
            <span class="tab-back" id="detail-tab">详细描述</span>
            <span class="tab-back" id="mix-tab">其他信息</span>
            <span class="tab-back" id="properties-tab">商品属性</span>
            <span class="tab-back" id="gallery-tab" style="display: none;">商品相册</span>
        </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="index.php?controller=backend/product&action=create" method="post" name="theForm">
            <!-- 通用信息 -->
            <table width="90%" id="general-table" align="center" style="display: table;">
                <tbody>
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="" size="30"><span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品货号： </td>
                    <td><input type="text" name="goods_sn" value="" size="20" onblur="checkGoodsSn(this.value,'32')"><span id="goods_sn_notice"></span><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cat_id" onchange="hideCatDiv()">
                            <?php foreach($productCategorys as $productCategory): ?>
                                <option value="<?php echo $productCategory['id']; ?>"><?php echo str_repeat('&nbsp;', ($productCategory['level'] - 1) * 4) . $productCategory['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <select name="brand_id" onchange="hideBrandDiv()">
                            <?php foreach($productBrands as $productBrand): ?>
                                <option value="<?php echo $productBrand['id']; ?>"><?php echo $productBrand['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td><input type="text" name="shop_price" value="" size="20" onblur="priceSetted()">
                        <input type="button" value="按市场价计算" onclick="marketPriceSetted()">
                        <span class="require-field">*</span></td>
                </tr>

                <tr>
                    <td class="label">市场售价：</td>
                    <td><input type="text" name="market_price" value="" size="20">
                        <input type="button" value="取整数" onclick="integral_market_price()">
                    </td>
                </tr>

                <tr>
                    <td class="label">上传商品图片：</td>
                    <td>
                        <input type="file" name="goods_img" size="35">
                        <a href="#" target="_blank"><img src="backend/images/yes.gif" border="0"></a>
                    </td>
                </tr>
                </tbody></table>

            <!-- 详细描述 -->
            <table width="90%" id="detail-table" style="display: none;">
                <tbody><tr>
                    <td><input type="hidden" id="goods_desc" name="goods_desc" value="" style="display:none"><input type="hidden" id="goods_desc___Config" value="" style="display:none"><iframe id="goods_desc___Frame" src="backend/fckeditor/editor/fckeditor.html?InstanceName=goods_desc&amp;Toolbar=Normal" width="100%" height="320" frameborder="0" scrolling="no" style="margin: 0px; padding: 0px; border: 0px; background-color: transparent; background-image: none; width: 100%; height: 320px;"></iframe></td>
                </tr>
                </tbody></table>

            <!-- 其他信息 -->
            <table width="90%" id="mix-table" style="display: none;" align="center">
                <tbody>
                <tr>
                    <td class="label">
                        <a href="javascript:showNotice('noticeStorage');" title="点击此处查看提示信息">
                            <img src="backend/images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a>
                        商品库存数量：
                    </td>
                    <td><input type="text" name="goods_number" value="" size="20"><br>
                        <span class="notice-span" style="display:block" id="noticeStorage">库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量</span></td>
                </tr>
                <tr>
                    <td class="label">加入推荐：</td>
                    <td><input type="checkbox" name="is_best" value="1">精品 <input type="checkbox" name="is_new" value="1" checked="checked">新品 <input type="checkbox" name="is_hot" value="1">热销</td>
                </tr>
                </tbody></table>

            <!-- 商品属性 -->
            <table width="90%" id="properties-table" style="display: none;" align="center">
                <tbody>
                <tr>
                    <td class="label">商品属性分类：</td>
                    <td>
                        <select name="type_id" onchange="loadAttributeTable(this.value)">
                            <option value="0">请选择...</option>
                            <?php foreach($productAttributeCategorys as $productAttributeCategory): ?>
                                <option value="<?php echo $productAttributeCategory['id'] ?>"><?php echo $productAttributeCategory['name'] ?></option>
                            <?php endforeach; ?>
                        </select><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
                    </td>
                </tr>
                <tr>
                    <td id="tbody-goodsAttr" colspan="2" style="padding:0">
                        <table width='100%' id='attrTable'>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="button-div">
                <input type="submit" value=" 确定 " class="button">
                <input type="reset" value=" 重置 " class="button">
            </div>
        </form>
    </div>
</div>


<div id="footer">
    版权所有 &copy; 2012-2013 传智播客 - PHP培训 -
</div>
<script type="text/javascript" src="backend/js/tab.js"></script>
<script type="text/javascript">
    function addImg(obj){
        var src  = obj.parentNode.parentNode;
        var idx  = rowindex(src);
        var tbl  = document.getElementById('gallery-table');
        var row  = tbl.insertRow(idx + 1);
        var cell = row.insertCell(-1);
        cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
    }

    function removeImg(obj){
        var row = rowindex(obj.parentNode.parentNode);
        var tbl = document.getElementById('gallery-table');
        tbl.deleteRow(row);
    }

    function dropImg(imgId){
        Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
    }

    function dropImgResponse(result){
        if (result.error == 0){
            document.getElementById('gallery_' + result.content).style.display = 'none';
        }
    }

    //增加一个属性行
    function addSpec(obj) {
        var src   = obj.parentNode.parentNode;
        var idx   = rowindex(src);
        var tbl   = document.getElementById('attrTable');
        var row   = tbl.insertRow(idx + 1);
        var cell1 = row.insertCell(-1);
        var cell2 = row.insertCell(-1);
        var regx  = /<a([^>]+)<\/a>/i;

        cell1.className = 'label';
        cell1.innerHTML = src.childNodes[0].innerHTML.replace(/(.*)(addSpec)(.*)(\[)(\+)/i, "$1removeSpec$3$4-");
        cell2.innerHTML = src.childNodes[1].innerHTML.replace(/readOnly([^\s|>]*)/i, '');
    }

    /**
     * 删除一个属性行
     */
    function removeSpec(obj) {
        var row = rowindex(obj.parentNode.parentNode);
        var tbl = document.getElementById('attrTable');

        tbl.deleteRow(row);
    }

    /**
     * 处理
     */
    function handleSpec() {
        var elementCount = document.forms['theForm'].elements.length;
        for (var i = 0; i < elementCount; i++)
        {
            var element = document.forms['theForm'].elements[i];
            if (element.id.substr(0, 5) == 'spec_')
            {
                var optCount = element.options.length;
                var value = new Array(optCount);
                for (var j = 0; j < optCount; j++)
                {
                    value[j] = element.options[j].value;
                }

                var hiddenSpec = document.getElementById('hidden_' + element.id);
                hiddenSpec.value = value.join(String.fromCharCode(13)); // 鐢ㄥ洖杞﹂敭闅斿紑姣忎釜瑙勬牸
            }
        }
        return true;
    }

function loadAttributeTable(productAttributeCategoryId) {
    var iframe = document.getElementById('loadAttributeTableIframe');
    iframe.src = 'index.php?controller=backend/product&action=loadAttributeTable&category_id=' + productAttributeCategoryId;
}

</script>
<iframe id="loadAttributeTableIframe" style="display: none;">
</iframe>
</body>
</html>