<?php include 'layouts/header.php';?>
<?php
if(!isset($_GET['id'])) {
    header('location: products.php');
}

if(get_specific_products($_GET['id'])->num_rows > 0) {
    $product      = get_specific_products($_GET['id'])->fetch_assoc();
    $category     = get_specific_category($product['product_categories_id'])->fetch_assoc();
    $sub_category = get_specific_sub_category($product['product_sub_categories_id'])->fetch_assoc();
} else {
    header('location: products.php');

}

if(isset($_GET['add-to-cart-details']) == true) {
    add_to_cart_from_details($_GET['id'],$_GET['quantity']);
}

?>

<body>
    <div class="site-wrapper">
        <?php include 'layouts/navigation.php';?>
        <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item">Products</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)"><?=$category['parent']?></a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)"><?=$sub_category['child']?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$product['title']?></li>
                </ol>
            </div>
        </nav>
        <!-- Promotion Block 2 -->
        <main class="product-details-section">
            <div class="container">
                <div class="pm-product-details">
                    <div class="row">
                        <!-- Blog Details Image Block -->
                        <div class="col-md-6">
                            <div class="image-block left-thumbnail">

                                <div class="main-image">
                                    <!-- Zoomable IMage -->
                                    <img id="zoom_03" src="assets/image/product/<?=$product['featured_image']?>"
                                        data-zoom-image="assets/image/product/<?=$product['featured_image']?>" alt="" />
                                        
                                </div>
                                <!-- <?php if($product['discount']>0){ ?>
                                        <span class="onsale-badge"><?=$product['discount']?>% Off</span>
                                    <?php } ?> -->

                                <!-- Product Gallery with Slick Slider -->
                                <div id="product-view-gallery" class="elevate-gallery">
                                    <!-- Slick Single -->
                                    <?php foreach(get_all_product_gallery($product['id']) as $gallery) { ?>
                                    <a href="#" class="gallary-item"
                                        data-image="assets/image/product/gallery/<?=$gallery['images']?>"
                                        data-zoom-image="assets/image/product/gallery/<?=$gallery['images']?>">
                                        <img src="assets/image/product/gallery/<?=$gallery['images']?>" alt="" />
                                    </a>
                                    
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5 mt-md-0">
                            <div class="description-block">
                                <div class="header-block">
                                    <h3><?=$product['title']?></h3>
                                </div>
                                <!-- Rating Block -->
                                <div class="rating-block d-flex  mt--10 mb--15">
                                    <div class="rating-widget">
                                        <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
                                        <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
                                        <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
                                        <a href="#" class="single-rating"><i class="fas fa-star-half-alt"></i></a>
                                        <a href="#" class="single-rating"><i class="far fa-star"></i></a>
                                    </div>
                                    <p class="rating-text"><a href="#comment-form">(1 customer review)</a></p>


                                </div>

                                <!-- <div class=" mb--10" >
                                    <div class="product-countdown" data-countdown="<?=date('Y/m/d',strtotime('+1 day'))?>"></div>
                                </div> -->

                                <!-- Price -->
                                <?php if($product['discount'] != 0) { ?>
                                <p class="price"><span class="old-price">₱<?=number_format($product['price'],2)?></span>₱<?=number_format($product['price'] - ($product['price'] * ($product['discount'] / 100)) ,2)?></p>
                                    <span class="old"></span>
                                <?php } else { ?>
                                <p class="price" style="color:#000">₱<?=number_format($product['price'],2)?></p>
                                <?php } ?>
                                <!-- Blog Short Description -->
                                <div class="product-short-para">
                                    <p style="text-align:justify">
                                        <?=$product['short_description']?>
                                    </p>
                                </div>
                                <div class="status">
                                    <i class="fas fa-check-circle"></i><?=$product['stocks']?> IN STOCK
                                </div>
                                <!-- Amount and Add to cart -->
                                <form method="GET" class="add-to-cart">
                                    <div class="count-input-block " style="width:100px">
                                        <input type="hidden" value="<?=$product['id']?>" name="id">
                                        <input type="hidden" name="add-to-cart-details" value="true">
                                        <input type="number"  name="quantity" class="form-control text-center" min=1 max="<?=$product['stocks']?>" value="1">
                                    </div>
                                    <div class="btn-block">
                                        <?php if($product['stocks'] == 0) { ?>
                                            <button type="button" class="btn ml--10 btn-success text-white" disabled>Not Available</button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn ml--10 btn-success text-white">Add to cart</button>
                                        <?php } ?>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <section class="review-section pt--60">
                    <h2 class="sr-only d-none">Product Review</h2>
                    <div class="container">

                        <div class="product-details-tab">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">DESCRIPTION</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">REVIEWS (1)</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <article>
                                        <h2 class="d-none sr-only">tab article</h2>
                                        <p style="text-align:justify">
                                            <?=$product['long_description']?>
                                        </p>
                                    </article>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="review-wrapper">
                                        <h2 class="title-lg mb--20">1 REVIEW FOR AUCTOR GRAVIDA ENIM</h2>
                                        <div class="review-comment mb--20">
                                            <div class="avatar">
                                                <img src="assets/image/icon-logo/author-logo.png" alt="">
                                            </div>
                                            <div class="text">
                                                <div class="rating-widget mb--15">
                                                    <span class="single-rating"><i class="fas fa-star"></i></span>
                                                    <span class="single-rating"><i class="fas fa-star"></i></span>
                                                    <span class="single-rating"><i class="fas fa-star"></i></span>
                                                    <span class="single-rating"><i
                                                            class="fas fa-star-half-alt"></i></span>
                                                    <span class="single-rating"><i class="far fa-star"></i></span>
                                                </div>
                                                <h6 class="author">ADMIN – <span class="font-weight-400">March 23,
                                                        2015</span> </h6>
                                                <p>Lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan
                                                    elit
                                                    odio quis mi.</p>
                                            </div>
                                        </div>
                                        <h2 class="title-lg mb--20 pt--15">ADD A REVIEW</h2>
                                        <div class="rating-row pt-2">
                                            <p class="d-block">Your Rating</p>
                                            <span class="rating-widget-block">
                                                <input type="radio" name="star" id="star1">
                                                <label for="star1"></label>
                                                <input type="radio" name="star" id="star2">
                                                <label for="star2"></label>
                                                <input type="radio" name="star" id="star3">
                                                <label for="star3"></label>
                                                <input type="radio" name="star" id="star4">
                                                <label for="star4"></label>
                                                <input type="radio" name="star" id="star5">
                                                <label for="star5"></label>
                                            </span>
                                            <form action="./" class="mt--15 site-form ">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="message">Comment</label>
                                                            <textarea name="message" id="message" cols="30" rows="10"
                                                                class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">Name *</label>
                                                            <input type="text" id="name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="email">Email *</label>
                                                            <input type="text" id="email" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="submit-btn">
                                                            <a href="#" class="btn btn-success  ">Post Comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="pt--50">
                        <div class="container">

                            <div class="block-title">
                                <h2>RELATED PRODUCTS</h2>
                            </div>
                            <div class="petmark-slick-slider border normal-slider" data-slick-setting='{
                              "autoplay": true,
                              "autoplaySpeed": 3000,
                              "slidesToShow": 5,
                              "arrows": true
                          }' data-slick-responsive='[
                              {"breakpoint":991, "settings": {"slidesToShow": 3} },
                              {"breakpoint":480, "settings": {"slidesToShow": 1,"rows" :1} }
                          ]'>

                                <?php foreach(get_related_products($product['id'],$product['product_categories_id']) as $related)  { ?>
                                <div class="single-slide">
                                    <div class="pm-product">
                                        <div class="image">
                                            <a href="product-details.php?id=<?=$related['id']?>"><img src="assets/image/product/<?=$related['featured_image']?>" alt=""></a>
                                            <!-- <span class="onsale-badge">Sale!</span> -->
                                        </div>
                                        <?php if($related['discount']>0){ ?>
                                <span class="onsale-badge"><?=$related['discount']?>% Off</span>
                            <?php } ?>
                                        <div class="content">
                                            <h3><?=$related['title']?></h3>
                                            <div class="price">
                                                <!-- <span class="old">$200</span> -->
                                                <?php if($related['discount'] != 0) { ?>
                                                <p class="price"><span class="old-price">₱<?=number_format($related['price'],2)?></span>₱<?=number_format($related['price'] - ($related['price'] * ($related['discount'] / 100)) ,2)?></p>
                                                    <span class="old"></span>
                                                <?php } else { ?>
                                                <p class="price" style="color:#000">₱<?=number_format($related['price'],2)?></p>
                                                <?php } ?>
                                            </div>
                                            <div class="btn-block">
                                                <a href="?add-to-cart=true&id=<?=$related['id']?>" class="btn btn-outlined btn-rounded">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </section>
        </main>
        <!-- Slider bLock 4 -->

        <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>
    <script>
        document.getElementsByTagName('meta')["keywords"].content = "<?=$product['meta_keywords']?>";
        document.getElementsByTagName('meta')["description"].content = "<?=$product['meta_description']?>";
        document.title = "<?=$product['title']?>";
    </script>
</body>

</html>