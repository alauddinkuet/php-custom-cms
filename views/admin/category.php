<div id="main">
    <form action="<?php echo BASEPATH;?>admin/category/save" method="post" >
        <input type="hidden" name="category_id" id="category_id" value="<?php echo isset($category['category_id']) ? $category['category_id'] : '';?>"/>
        <div class="form-group">
            <label for="category_title">Category Title</label>
            <input type="text" required="required" class="form-control" id="category_title" name="category_title" value="<?php echo isset($category['category_title']) ? $category['category_title'] : '';?>">
        </div>
        <div class="form-group">
            <label for="pwd">Parent  Category</label>
            <select class="form-control" name="parent_category_id" id="parent_category_id">
                <option value="0"> Parent Category</option>
                <?php foreach($this->tableData as $item) : ?>
                    <?php if(!$item['parent_category_title']) : ?>
                        <option <?php echo isset($category['category_id']) && $category['parent_category_id'] == $item['category_id'] ? 'SELECTED' : '';?>  value="<?php echo $item['category_id']?>"><?php echo $item['category_title']?></option>
                    <?php endif;?>
                <?php endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-default"><?php echo isset($category['category_id']) && $category['category_id'] ? 'Update' : 'Add';?> Category</button>
    </form>
    <hr />
    <table class="table table-hover">
        <thead class="thead-default">
        <tr>
            <?php

            /** Build headers */

            $keys = array_keys($this -> tableData[0]);
            foreach ($keys as $key => $val) {
                if($val == 'parent_category_id')
                    continue;
                echo "<th id='$val'>" . ucwords(trim(str_replace('_', ' ', $val))) . "</th>";
            }
            ?>
            <th colspan="2" class="text-center">Action</th>
        </tr>
        </thead>
        <?php
        foreach ($this->tableData as $key => $row) {

            echo '<tr id="' . $row['category_id'] . '">';

            foreach ($row as $key => $val) {
                if($key == 'parent_category_id')
                    continue;
                echo '<td><span>' . $val . '</span></td>';
            }

            echo '<td class="text-center" style="width:20px;"> 
                        <a href="' . BASEPATH . 'admin/category/index/' . $row['category_id'] . '"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
                  </td>
                  <td class="text-center" style="width:20px;"> 
                    <a onclick="javascript:return confirm(\'Are you sure you want to delete the category?\')" href="' . BASEPATH . 'admin/category/delete/' . $row['category_id'] . '"><i class="fa fa-remove fa-2x" aria-hidden="true"></i> </a>
                  </td>';
            echo '</tr>';

        }
        ?>
    </table>
</div>
