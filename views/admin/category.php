<div id="main">

    <form action="/admin/category/saveCategory" method="post" >
        <div class="form-group">
            <label for="category_title">Category Title</label>
            <input type="text" class="form-control" id="category_title" name="category_title">
        </div>
        <div class="form-group">
            <label for="pwd">Parent  Category</label>
            <select class="form-control">
                <option value="0"> Parent Category</option>
                <?php foreach($this->tableData as $category) : ?>
                    <?php if(!$category['parent_category_title']) : ?>
                        <option value="<?php echo $category['category_id']?>"><?php echo $category['category_title']?></option>
                    <?php endif;?>
                <?php endforeach;?>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Add Category</button>
    </form>
    <hr />
    <table class="table">
        <thead class="thead-default">
        <tr>
            <?php

            /** Build headers */

            $keys = array_keys($this -> tableData[0]);
            foreach ($keys as $key => $val) {
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

                echo '<td><span>' . $val . '</span></td>';

            }

            echo '<td class="text-center"> Edit </td><td class="text-center"> Delete </td>';
            echo '</tr>';

        }
        ?>
    </table>
</div>
