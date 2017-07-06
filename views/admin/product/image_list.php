<table class="table table-hover table-image-list">
    <thead>
    <tr>
        <th>Image</th>
        <th>Image Title</th>
        <th>Is Primary</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($images as $item) : ?>
        <tr>
            <td><img style="width: 50px" src="<?php echo BASEPATH;?>product_image/<?php echo $item['file_name']?>"></td>
            <td><?php echo $item['file_org_name'];?></td>
            <td><?php echo $item['is_primary'] ? 'Yes' : 'no';?></td>
            <td>
                <a onclick="javascript:return confirm('Are you sure you want to delete the image?')"
                   href="<?php echo BASEPATH . 'admin/product/deleteImage/' . $item['id'] ?>">
                    <i class="fa fa-remove fa-2x" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<style>
table.table-image-list tr td{
    vertical-align: middle !important;
}
</style>