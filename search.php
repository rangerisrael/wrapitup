<?php include 'layouts/header.php';?>

<body>
    <div class="site-wrapper">
        <?php include 'layouts/navigation.php';?>
        <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </div>
        </nav>
        <!-- Promotion Block 2 -->
        <main class="section-padding shop-page-section">
            <div class="container">
                <div class="shop-toolbar mb--30">
                    <div class="row align-items-center">
                        <div class="col-5 col-md-3 col-lg-4">
                            <!-- Product View Mode -->
                            <div class="product-view-mode">
                                <a href="#" class="sortting-btn active" data-bs-target="list "><i
                                        class="fas fa-list"></i></a>
                                <a href="#" class="sortting-btn" data-bs-target="grid"><i class="fas fa-th"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-product-wrap list with-pagination row border grid-four-column  me-0 ms-0 g-0">
                    <?php foreach(get_searched_result($_GET['wildcard'],$_GET['category']) as $product){ ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="pm-product product-type-list  ">
                            <a href="product-details.php?id=<?=$product['id']?>" class="image" tabindex="0">
                                <img src="assets/image/product/<?=$product['featured_image']?>" alt="">
                            </a>
                            <?php if($product['discount']>0){ ?>
                                <span class="onsale-badge"><?=$product['discount']?>% Off</span>
                            <?php } ?>
                            <div class="content">
                                <h3 class="font-weight-500"><a href="product-details.php"><?=$product['title']?></a></h3>
                                <div class="price ">
                                    <?php if($product['discount'] != 0) { ?>
                                        <span class="old">AED<?=number_format($product['price'],2)?></span>
                                    <?php } else { ?>
                                    <?php } ?>
                                    <span>AED<?=number_format($product['price'] - ($product['price'] * ($product['discount'] / 100)) ,2)?></span>
                                </div>
                                <div class="btn-block grid-btn">
                                    <a href="?add-to-cart=true&id=<?=$product['id']?>" class="btn btn-outlined btn-rounded btn-mid" tabindex="0">Add to
                                        Cart</a>
                                </div>
                                <div class="card-list-content ">
                                    <div class="rating-widget ">
                                           <?php 
                                                   
                                                      for ($i=1; $i <= count_reviewsbyProduct($product['title']) && count_reviewsbyProduct($product['title']) <= 5; $i++) { 


                                                    
                                                            ?>
                                                     <a href="#" class="single-rating"><i class="fas fa-star"></i></a>

                                                    
                                                     <?php
                                                            
                                                    

                                                      }
                                                     
                                      ?>
                                           <?php 
                                                    $startWhite = 5 - count_reviewsbyProduct($product['title']);
                                                      for ($i=1; $i <=$startWhite && $startWhite <= 5; $i++) { 


                                                       
                                                            ?>
                                                  <a href="#" class="single-rating"><i class="far fa-star"></i></a>

                                                    
                                                     <?php
                                                            
                                                          

                                                    
                                                       

                                                      }
                                                     
                                            ?>
                                         <?php 
                                                    $star = count_reviewsbyProduct($product['title']);

                                                      if($star > 5){

                                                      for ($i=1; $i <= 5; $i++) { 


                                                       
                                                            ?>
                                                      <a href="#" class="single-rating"><i class="fas fa-star"></i></a>

                                                     <?php
                                                            
                                                          

                                                    
                                                       

                                                      }
                                                      }


                                                     
                                            ?>
                                    <span class="rating-text"><a href="#comment-form">(<?php echo count_reviewsbyProduct($product['title']) ?> customer review)</a></span>
                                    
                                        <!-- <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
                                        <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
                                        <a href="#" class="single-rating"><i class="fas fa-star"></i></a>
                                        <a href="#" class="single-rating"><i class="fas fa-star"></i></a> -->
                                    </div>
                                    <article>
                                        <h3 class="d-none sr-only">Article</h3>
                                        <p style="text-align:justify" class="mr--20"><?=$product['short_description']?></p>
                                    </article>
                                    <div class="btn-block d-flex">
                                        <a href="?add-to-cart=true&id=<?=$product['id']?>&wildcard=<?=urlencode($_GET['wildcard'])?>&category=<?=$_GET['category']?>&success=true&message=<?=urlencode('Item has added to your cart')?>" class="btn btn-outlined btn-rounded btn-mid"
                                            tabindex="0">Add to Cart</a>
                                        <!-- <div class="btn-options">
                                            <a href="wishlist.php?id=<?=$product['id']?>"><i class="ion-ios-heart-outline"></i>Add to
                                                Wishlist</a>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </main>
        <!-- Slider bLock 4 -->

        <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>
</body>

</html>