<?php

class ProductAttributeModel extends Model
{
    /**
     * 拿出所有的产品属性记录
     */
    public function getList($categoryId)
    {
        if ($categoryId) {
            $where = ' WHERE category_id=' . $categoryId;
        } else {
            $where = '';
        }
        $sql = 'SELECT * FROM product_attribute ' . $where;
        return $this->db->getAll($sql);
    }

    public function generateTable($productAttributeCategoryId)
    {
        /*
        <tr>
            <td class='label'>上市日期</td>
            <td>
                <input type='hidden' name='attr_id_list[]' value='172'>
                <select name='attr_value_list[]'>
                    <option value=''>请选择...</option>
                    <option value='2008年01月'>2008年01月</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class='label'>存储卡格式</td>
            <td>
                <input type='hidden' name='attr_id_list[]' value='180'>
                <input name='attr_value_list[]' type='text' value='MicroSD' size='40'>
            </td>
        </tr>
         */
        $sql = 'SELECT * FROM product_attribute WHERE category_id=' . $productAttributeCategoryId;
        $productAttributes = $this->db->getAll($sql);
        $html = '';
        foreach($productAttributes as $productAttribute) {
            $html .= '<tr>';
            $html .= "<td class='label'>" . $productAttribute['name'] . "</td>";
            $html .= '<td>';
            $html .= "<input type='hidden' name='attr_id_list[]' value='" . $productAttribute['id'] . "'>";
            if ($productAttribute['select_type'] == 1) {
                $html .= "<input name='attr_value_list[]' type='text' value='' size='40'>";
            } else if ($productAttribute['select_type'] == 2) {
                $html .= "<select name='attr_value_list[]'>";
                foreach(explode('/', $productAttribute['optional_value']) as $optionSingleValue) {
                    $html .= "<option value='" . $optionSingleValue . "'>" . $optionSingleValue . "</option>";
                }
                $html .= "</select>";
            }
            $html .= '</td>';
            $html .= '</tr>';
        }
        return $html;
    }
}












