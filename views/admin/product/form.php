<form action="<?php echo BASEPATH;?>admin/product/save" method="post" >
    <input type="hidden" name="product_id" id="product_id" value="<?php echo isset($product['product_id']) ? $product['product_id'] : '';?>"/>
    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" required="required" class="form-control" id="product_name" name="product_name" value="<?php echo isset($product['product_name']) ? $product['product_name'] : '';?>">
    </div>
    <div class="form-group">
        <label for="product_price">Product Price</label>
        <input required="required" min="0" max="99999" type="number" step="any" class="form-control" id="product_price" name="product_price" value="<?php echo isset($product['product_price']) ? $product['product_price'] : '';?>">
    </div>
    <div class="form-group">
        <label for="category_id">Product Category</label>
        <select class="form-control" name="category_id" id="category_id" required="required">
            <option value="0"> Product Category</option>
            <?php foreach($this->category as $item) : if(!$item['parent_category_id']) continue; ?>
                <option <?php echo isset($product['category_id']) && $product['category_id'] == $item['category_id'] ? 'SELECTED' : '';?>  value="<?php echo $item['category_id']?>"><?php echo $item['category_title']?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
        <label for="category_title">Product Description</label>
        <textarea class="form-control" id="product_description" name="product_description"><?php echo isset($product['product_description']) ? $product['product_description'] : '';?></textarea>
    </div>

    <div class="form-group">
        <label for="category_title">Product Details</label>
        <textarea class="form-control" id="product_details" name="product_details"><?php echo isset($product['product_details']) ? $product['product_details'] : '';?></textarea>
    </div>
    <button type="submit" class="btn btn-default"><?php echo isset($product['product_id']) && $product['product_id'] ? 'Update' : 'Add';?> Product</button>
</form>

<script src="//cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'product_details', {
        // Define the toolbar groups as it is a more accessible solution.
        toolbarGroups: [
            {"name":"basicstyles","groups":["basicstyles"]},
            {"name":"links","groups":["links"]},
            {"name":"paragraph","groups":["list","blocks"]},
            {"name":"document","groups":["mode"]},
            {"name":"insert","groups":["insert"]},
            {"name":"styles","groups":["styles"]},
            {"name":"about","groups":["about"]}
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    } );
</script>