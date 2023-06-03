<?php include 'layouts/header.php';?>

<body>
    <div class="site-wrapper">
        <?php include 'layouts/navigation.php';?>
        <section>
            <div class=" petmark-slick-slider  home-slider dot-position-1" data-slick-setting='{
        "autoplay": true,
        "autoplaySpeed": 8000,
        "slidesToShow": 1,
        "dots": true
    }'>
                <div class="single-slider home-content bg-image" data-bg="assets/image/newprod/product1.jpg">
                    <span class="herobanner-progress"></span>
                </div>
                <div class="single-slider home-content bg-image" data-bg="assets/image/newprod/product2.jpg" style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;">
                    <span class="herobanner-progress"></span>
                </div>
                <div class="single-slider home-content bg-image" data-bg="assets/image/newprod/product3.jpg">
                    <span class="herobanner-progress"></span>
                </div>
            </div>
        </section>
        <div class="container pt--50">
            <div class="policy-block border-four-column">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="policy-block-single">
                            <div class="icon">
                                <span class="ti-truck"></span>
                            </div>
                            <div class="text">
                                <h3>Free Delivery</h3>
                                <p>On orders of 200+AED</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="policy-block-single">
                            <div class="icon">
                                <span class="ti-credit-card"></span>
                            </div>
                            <div class="text">
                                <h3>Cod</h3>
                                <p>Cash on Delivery</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="policy-block-single">
                            <div class="icon">
                                <span class="ti-gift"></span>
                            </div>
                            <div class="text">
                                <h3>Free Gift Box</h3>
                                <p>Buy a Gift</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="policy-block-single">
                            <div class="icon">
                                <span class="ti-headphone-alt"></span>
                            </div>
                            <div class="text">
                                <h3>Free Support 24/7</h3>
                                <p>Online 24hrs a Day</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider One / Normal Two Column Slider -->

        <div class="pt--50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block-title">
                            <h2>Featured Categories</h2>
                        </div>
                        <!-- Two row Three Column Slider -->
                        <div class="petmark-slick-slider border grid-column-slider" data-slick-setting='{
                            "autoplay": true,
                            "autoplaySpeed": 3000,
                            "slidesToShow": 5,
                            "rows" :1,
                            "arrows": true
                        }' data-slick-responsive='[
                            {"breakpoint":991, "settings": {"slidesToShow": 3} },
                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                            {"breakpoint":480, "settings": {"slidesToShow": 1,"rows" :1} }
                        ]'>
                            <?php if(get_featured_categories()->num_rows > 0) { ?>
                            <?php foreach(get_featured_categories() as $fc) { ?>
                            <div class="single-slide ">
                                <div class="pm-product">
                                    <div class="image">
                                    
                                        <a href="category.php?id=<?=$fc['id']?>">
                                            <?php if(empty($fc['images']) || $fc['images'] == null) { ?>
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsNGGjrfSqqv8UjL18xS4YypbK-q7po_8oVQ&usqp=CAU" alt="">
                                            <?php } else { ?>
                                                <img src="assets/image/category/<?=$fc['images']?>" alt="">
                                            <?php } ?>
                                        </a>
                                        <!-- <span class="onsale-badge">Sale!</span> -->
                                    </div>
                                    <div class="content">
                                        <div class="price">
                                            <span></span>
                                        </div>
                                        <h3 style="text-align:center"><?=$fc['parent']?></h3>
                                        <div class="btn-block">
                                            <a href="category.php?id=<?=$fc['id']?>"
                                                class="btn btn-outlined btn-rounded">Visit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- Modal -->
        <!-- Promotion Block 1 -->

        <!-- Slider Block Two -->
        <div class="pt--50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block-title">
                            <h2>Featured Product</h2>
                        </div>
                        <!-- Two row Three Column Slider -->
                        <div class="petmark-slick-slider border grid-column-slider" data-slick-setting='{
                            "autoplay": true,
                            "autoplaySpeed": 3000,
                            "slidesToShow": 4,
                            "rows" :1,
                            "arrows": true
                        }' data-slick-responsive='[
                            {"breakpoint":991, "settings": {"slidesToShow": 3} },
                            {"breakpoint":768, "settings": {"slidesToShow": 2} },
                            {"breakpoint":480, "settings": {"slidesToShow": 1,"rows" :1} }
                        ]'>
                            <?php foreach(get_featured_product() as $featured) { ?>
                            <div class="single-slide ">
                                <div class="pm-product">
                                    <div class="image">
                                        <a href="product-details.php?id=<?=$featured['id']?>"><img
                                                src="assets/image/product/<?=$featured['featured_image']?>" alt=""></a>
                                        <!-- <span class="onsale-badge">Sale!</span> -->
                                    </div>
                                    <?php if($featured['discount']>0){ ?>
                                <span class="onsale-badge"><?=$featured['discount']?>% Off</span>
                            <?php } ?>
                                    <div class="content" style="text-align:center">
                                        <h3><?=$featured['title']?></h3>
                                        <div class="price">
                                            <?php if($featured['discount'] != 0) { ?>
                                                <span class="old">₱<?=number_format($featured['price'],2)?></span>
                                            <?php } else { ?>
                                            <?php } ?>
                                        <span>₱<?=number_format($featured['price'] - ($featured['price'] * ($featured['discount'] / 100)) ,2)?></span>
                                        </div>
                                        <div class="btn-block">
                                            <a href="?add-to-cart=true&id=<?=$featured['id']?>&success=true&message=<?=urlencode('Item has added to your cart')?>""
                                                class="btn btn-outlined btn-rounded">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- SLider Block 3 / Tab -->
        <div class="pt--50 mb--50">
            <div class="container">

                <div class="slider-header-block tab-header d-flex">
                    <div class="block-title">
                        <h2>All Products</h2>
                    </div>

                    <ul class="pm-tab-nav nav nav-tabs" id="myTab" role="tablist">
                        <?php $i=1;?>
                        <?php foreach(get_all_categories() as $categories) { ?>
                        <li class="nav-item">
                            <a class="nav-link <?=$i==1?'active' : ''?>" data-bs-toggle="tab" href="#tab_<?=$i?>"
                                role="tab" aria-selected="true"><?=$categories['parent']?></a>
                        </li>
                        <?php $i++; ?>
                        <?php } ?>
                    </ul>
                </div>

                <div class="tab-content pm-slider-tab-content" id="myTabContent">
                    <?php $j=1; foreach(get_all_categories() as $categories) { ?>
                    <div class="tab-pane <?=$j==1 ? 'show active' : ''?>" id="tab_<?=$j?>" role="tabpanel">
                        <div class="petmark-slick-slider border grid-column-slider  arrow-type-two" data-slick-setting='{
                                "autoplay": true,
                                "autoplaySpeed": 3000,
                                "slidesToShow": 4,
                                "rows" :1,
                                "arrows": true
                            }' data-slick-responsive='[
                                {"breakpoint":991, "settings": {"slidesToShow": 3} },
                                {"breakpoint":768, "settings": {"slidesToShow": 2} },
                                {"breakpoint":480, "settings": {"slidesToShow": 1,"rows" :1} }
                            ]'>
                            <?php foreach(get_all_products_by_category($categories['id']) as $product) { ?>
                            <div class="single-slide">
                                <div class="pm-product">
                                    <div class="image">
                                        <a href="product-details.php?id=<?=$product['id']?>"><img
                                                src="assets/image/product/<?=$product['featured_image']?>" alt=""></a>
                                        <!-- <span class="onsale-badge">Sale!</span> -->
                                        
                                    </div>
                                    <?php if($product['discount']>0){ ?>
                                        <span class="onsale-badge"><?=$product['discount']?>% Off</span>
                                    <?php } ?>
                                    <div class="content" style="text-align:center">
                                        <h3><?=$product['title']?></h3>
                                        <div class="price">
                                        <?php if($product['discount'] != 0) { ?>
                                            <span class="old">₱<?=number_format($product['price'],2)?></span>
                                        <?php } else { ?>
                                        <?php } ?>
                                        <span>₱<?=number_format($product['price'] - ($product['price'] * ($product['discount'] / 100)) ,2)?></span>
                                        </div>
                                        <div class="btn-block">
                                            <a href="?add-to-cart=true&id=<?=$product['id']?>&success=true&message=<?=urlencode('Item has added to your cart')?>"
                                                class="btn btn-outlined btn-rounded">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php $j++;?>
                    <?php } ?>

                </div>


            </div>

            <section class="pt--50 mb--5 space-db--30">
                <h2 class="d-none">Promotion Block
                </h2>
                <div class="container">
                    <a class="promo-image overflow-image">
                        <img src="assets/image/advertisement/1100x150.png" alt="">
                    </a>
                </div>
            </section>

        </div>



        <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>
</body>

</html>