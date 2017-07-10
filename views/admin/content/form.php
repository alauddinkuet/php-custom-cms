<form action="<?php echo BASEPATH;?>admin/product/save" method="post" >
    <input type="hidden" name="page_id" id="page_id" value="<?php echo isset($page['page_id']) ? $page['page_id'] : '';?>"/>
    <div class="form-group">
        <label for="product_name">Page Name</label>
        <input type="text" required="required" class="form-control" id="page_name" name="page_name" value="<?php echo isset($page['page_name']) ? $page['page_name'] : '';?>">
    </div>

    <div class="form-group">
        <label for="category_title">Page Content</label>
        <textarea class="form-control" id="page_content" name="page_content"><?php echo isset($page['page_content']) ? $page['page_content'] : '';?></textarea>
    </div>
    <div class="form-group">
        <label for="meta_keywords">Meta Keywords</label>
        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="<?php echo isset($page['meta_keywords']) ? $page['meta_keywords'] : '';?>">
    </div>

    <div class="form-group">
        <label for="meta_description">Meta description</label>
        <textarea class="form-control" id="meta_description" name="meta_description"><?php echo isset($page['meta_description']) ? $page['meta_description'] : '';?></textarea>
    </div>
    <button type="submit" class="btn btn-default"><?php echo isset($page['page_id']) && $page['page_id'] ? 'Update' : 'Add';?> Page</button>
</form>

<script src="//cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'page_content', {
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