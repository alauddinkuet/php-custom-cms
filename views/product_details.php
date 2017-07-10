<h2><?php echo $product['product_name']?></h2>
<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <?php foreach($images as $key => $item) : ?>
                <div class="item <?php echo $key ? '' : 'active'?>">
                    <img class="slide-image" src="<?php echo PRODUCT_IMAGE_URL . $item['file_name'];?>" alt="<?php echo $product['product_name']?>">
                </div>
                <?php endforeach;?>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>

</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12">
    <form class="form-horizontal product-details" action="/action_page.php">
        <div class="form-group">
            <label class="control-label col-sm-2">Product Price</label>
            <div class="col-sm-10">
                    <span class="spec"><span class="currency">৳ </span><?php echo $product['product_price']?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Product Code</label>
            <div class="col-sm-10">
                <span class="spec"><?php echo $product['product_code']?></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Description</label>
            <div class="col-sm-10">
                <span class="spec"><?php echo $product['product_details']?></span>
            </div>
        </div>
    </form>
    </div>
</div>

<div class="detailBox">
    <div class="titleBox">
        <label>Current Reviews</label>
        <button type="button" class="close" aria-hidden="true" data-toggle="collapse" data-target="#actionBox" >&times;</button>
    </div>
    <div class="actionBox collapse in" id="actionBox">
        <?php if(count($reviews)) : ?>
        <ul class="commentList">
            <?php foreach($reviews as $item) : ?>
            <li>
                <div class="commenterImage">
                    <img src="http://placehold.it/50x50" />
                </div>
                <div class="commentText">
                    <p><strong><?php echo $item['name'];?></strong></p>
                    <p class=""><?php echo $item['comment'];?></p>
                    <div class="ratings">
                        <p>
                            <?php for ($i = 1;$i <= 5; $i++) : ?>
                            <span class="glyphicon glyphicon-star <?php echo $item['rating'] >= $i ? '' :'glyphicon-star-empty' ?>"></span>
                            <?php endfor;?>
                        </p>
                    </div>

                    <span class="date sub-text">on
                        <?php echo date('jS F Y', strtotime($item['created_on']));?>
                    </span>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
        <?php else:  ?>
            No Review Found
        <?php endif;?>
    </div>
</div>

<div>&nbsp;</div>
<h2>Add Review</h2>
<hr />
<form class="form-horizontal" action="<?php echo BASEPATH?>product/review" method="post">
    <input type="hidden" name="product_id" id="product_id" value="<?php echo $product['product_id']?>" />
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Your Name</label>
        <div class="col-sm-10">
            <input type="text" required="required" class="form-control" id="name" placeholder="Your Name" name="name">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email Address</label>
        <div class="col-sm-10">
            <input type="email" required="required" class="form-control" id="email" placeholder="Email Address" name="email">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="commment">Comment</label>
        <div class="col-sm-10">
            <textarea name="comment" id="commment" class="form-control" required="required" ></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="rating">Rating</label>
        <div class="col-sm-10">
            <select name="rating" id="rating" required="required" >
                <option value="1">1 out of 5</option>
                <option value="2">2 out of 5</option>
                <option value="3">3 out of 5</option>
                <option value="4">4 out of 5</option>
                <option value="5">5 out of 5</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit Review</button>
        </div>
    </div>
</form>

