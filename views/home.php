                <!--div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <?php foreach($featured_images as $key => $item) : ?>
                                    <div class="item <?php echo $key ? '' : 'active'?>">
                                        <img class="slide-image" src="<?php echo PRODUCT_IMAGE_URL . $item['file_name'];?>" alt="">
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
                </div-->

                <div class="row">
                    <?php if(count($products) > 0) : ?>
                    <?php foreach($products as $item) : ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <?php if(isset($item['file_name'])) : ?>
                                <img src="<?php echo $item['file_name'];?>" alt="">
                            <?php else : ?>
                            <img src="http://placehold.it/320x150" alt="">
                            <?php endif;?>
                            <div class="caption">
                                <h4 class="pull-right price"><span class="currency">৳ </span><?php echo $item['product_price']?></h4>
                                <h4><a href="<?php echo BASEPATH . 'product/details/' . $item['product_name_seo'];?>"><?php echo $item['product_name'];?></a>
                                </h4>
                                <p><?php echo $item['product_description']?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?php echo $item['review_count'] ? $item['review_count'] : '0';?> reviews</p>
                                <p>
                                    <?php if($item['review_count']) : ?>
                                        <?php for ($i = 1;$i <= 5; $i++) : ?>
                                            <span class="glyphicon glyphicon-star <?php echo floor($item['rating']/$item['review_count']) >= $i ? '' :'glyphicon-star-empty' ?>"></span>
                                        <?php endfor;?>
                                    <?php else : ?>
                                    <span class="glyphicon glyphicon-star" ></span>
                                    <span class="glyphicon glyphicon-star" ></span>
                                    <span class="glyphicon glyphicon-star" ></span>
                                    <span class="glyphicon glyphicon-star" ></span>
                                    <span class="glyphicon glyphicon-star" ></span>
                                    <?php endif;?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <?php else : ?>
                        <div class="text-center alert  alert-info">No Product Found</div>
                    <?php endif ;?>
                </div>
