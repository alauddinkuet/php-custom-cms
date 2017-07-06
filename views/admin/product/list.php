<table class="table table-hover">
    <thead class="thead-default">
    <tr>
        <?php
        /** Build headers */
        $keys = array_keys($this -> tableData[0]);
        foreach ($keys as $key => $val) {
            if($val == 'product_id')
                continue;
            echo "<th id='$val'>" . ucwords(trim(str_replace('_', ' ', $val))) . "</th>";
        }
        ?>
        <th colspan="3" class="text-center">Action</th>
    </tr>
    </thead>
    <?php
    foreach ($this->tableData as $key => $row) {
        echo '<tr id="' . $row['product_id'] . '">';
        foreach ($row as $key => $val) {
            if($key == 'product_id')
                continue;
            echo '<td><span>' . $val . '</span></td>';
        }
        echo '<td class="text-center" style="width:20px;"> 
                    <a href="' . BASEPATH . 'admin/product/form/' . $row['product_id'] . '"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
              </td>
              <td class="text-center" style="width:20px;"> 
                <a href="' . BASEPATH . 'admin/product/image/' . $row['product_id'] . '"><i class="fa fa-image fa-2x" aria-hidden="true"></i> </a>
              </td>
              <td class="text-center" style="width:20px;"> 
                <a onclick="javascript:return confirm(\'Are you sure you want to delete the category?\')" href="' . BASEPATH . 'admin/product/delete/' . $row['product_id'] . '"><i class="fa fa-remove fa-2x" aria-hidden="true"></i> </a>
              </td>';
        echo '</tr>';
    }
    ?>
</table>