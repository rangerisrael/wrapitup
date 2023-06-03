<header class="header petmark-header-1">
    <div class="header-wrapper">
        <!-- Site Wrapper Starts -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <!-- Template Logo -->
                    <div class="col-lg-3 col-md-12 col-sm-4">
                        <div class="site-brand  text-center text-lg-start">
                            <a href="javascript:void(0)" class="brand-image">
                                <img src="assets/image/wrapitup-logo.jpg" alt="" style="width: 100px; height: 100px;">
                            </a>
                        </div>
                    </div>
                    <!-- Category With Search -->
                    <div class="col-lg-5 col-md-7 order-3 order-md-2">
                        <form class="category-widget" method="GET">
                            <input type="hidden" name="search" value="true">
                            <input type="text" name="wildcard" value="<?=isset($_GET['wildcard']) ? $_GET['wildcard'] : ''?>" placeholder="Search products ">
                            <div class="search-form__group search-form__group--select">
                                <select name="category" id="searchCategory" class="search-form__select nice-select">
                                    <option value="all" <?=isset($_GET['category']) == 'all' ? 'selected' : ''?>>All Categories</option>
                                    <?php foreach(get_all_categories() as $categories) { ?>
                                    <option value="<?=$categories['id']?>" <?=$categories['id'] == @$_GET['category'] ? 'selected' : ''?>><?=$categories['parent']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" name="btn_search" value="search" class="search-submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Call Login & Track of Order -->
                    <div class="col-lg-4 col-md-5 col-sm-8 order-2 order-md-3">
                        <div class="header-widget-2 text-center text-sm-end ">
                            <div class="call-widget">
                                <p>CALL US NOW: <br><i class="icon ion-ios-telephone"></i><span
                                        class="font-weight-mid">+91-012
                                        345 678</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav-wrapper">
        <div class="container">
            <div class="header-bottom-inner">
                <div class="row g-0">
                    <!-- Category Nav -->
                    <div class="col-lg-3 col-md-8">
                        <!-- Category Nav Start -->
                        <div class="category-nav-wrapper bg-blue">
                            <div class="category-nav">
                                <h2 class="category-nav__title primary-bg" id="js-cat-nav-title"><i
                                        class="fa fa-bars"></i>
                                    <span>All Categories</span></h2>

                                <ul class="category-nav__menu" id="js-cat-nav">
                                    <?php foreach(get_all_categories() as $categories) { ?>
                                    <li
                                        class="category-nav__menu__item <?=get_all_sub_categories($categories['id'])->num_rows > 0 ? 'has-children' : ''?>">
                                        <?php if(get_all_sub_categories($categories['id'])->num_rows > 0 ) { ?>
                                            <a href="javascript:void(0)"><?=$categories['parent']?></a>
                                        <?php } else { ?>
                                            <a href="category.php?id=<?=$categories['id']?>"><?=$categories['parent']?></a>
                                        <?php } ?>
                                        <div class="category-nav__submenu">
                                            <div class="category-nav__submenu--inner">
                                                <ul>
                                                    <?php foreach(get_all_sub_categories($categories['id']) as $sc) { ?>
                                                    <li><a href="sub-category.php?sub_id=<?=$sc['id']?>"><?=$sc['child']?></a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <!-- Category Nav End -->
                        <div class="category-mobile-menu"></div>
                    </div>
                    <!-- Main Menu -->
                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="main-navigation">
                            <!-- Mainmenu Start -->
                            <ul class="mainmenu">
                                <li class="mainmenu__item  ">
                                    <a href="home.php" class="mainmenu__link ">Home</a>
                                </li>

                                <li class="mainmenu__item ">
                                    <a href="products.php" class="mainmenu__link">Products</a>
                                </li>

                                <li class="mainmenu__item ">
                                    <a href="track-orders.php" class="mainmenu__link">Track Your Order</a>
                                </li>

                                <?php if(@$_SESSION['customer']) { ?>
                                    <li class="mainmenu__item ">
                                        <a href="my-account.php" class="mainmenu__link">My Account</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="mainmenu__item menu-item-has-children ">
                                        <a href="javascript:void(0)" class="mainmenu__link">My Account</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="login.php">Login</a>
                                            </li>
                                            <li>
                                                <a href="register.php">Register</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                            <!-- Mainmenu End -->
                        </nav>
                    </div>
                    <!-- Cart block-->
                    <div class="col-lg-2 col-6 offset-6 offset-md-0 col-md-3 order-3">
                        <div class="cart-widget-wrapper slide-down-wrapper">
                            <div class="cart-widget slide-down--btn">
                                <div class="cart-icon">
                                    <i class="ion-bag"></i>
                                    <span class="cart-count-badge">
                                        <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
                                        0
                                        <?php } else { ?>
                                        <?php $total = 0?>
                                        <?php $totalQuantity = 0?>
                                        <?php foreach($_SESSION['cart'] as $cart) { ?>
                                        <?php $total += $cart['price'] * $cart['quantity'];?>
                                        <?php $totalQuantity += $cart['quantity']?>
                                        <?php } ?>
                                        <?=$totalQuantity?>
                                        <?php } ?>
                                        
                                    </span>
                                </div>
                                <div class="cart-text">
                                    <span class="d-block">Your cart</span>
                                    <strong><span class="amount"><span class="currencySymbol">₱</span><?=number_format(isset($total) ? $total : 0,2)?></span></strong>
                                </div>
                            </div>
                            <div class="slide-down--item ">
                                <div class="cart-widget-box">
                                    <ul class="cart-items">

                                        <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
                                        <li class="single-cart text-center text-bold">Your cart is empty</li>
                                        <?php } else { ?>
                                        <?php $total = 0?>
                                        <?php foreach($_SESSION['cart'] as $cart) { ?>
                                        <?php $total += $cart['price'] * $cart['quantity'];?>
                                        <li class="single-cart">
                                            <a href="javascript:void(0)" class="cart-product">
                                                <div class="cart-product-img">
                                                    <img src="assets/image/product/<?=$cart['image']?>" alt="">
                                                </div>
                                                <div class="product-details">
                                                    <h4 class="product-details--title"> <?=$cart['title']?></h4>
                                                    <span class="product-details--price"><?=$cart['quantity']?> x
                                                        ₱<?= number_format($cart['price'] * $cart['quantity'],2) ?></span>
                                                </div>
                                                <span onclick="remove('<?=$cart['id']?>')" class="cart-cross">x</span>
                                            </a>
                                        </li>
                                        <?php } ?>
                                        <?php } ?>

                                        <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
                                        <?php } else { ?>
                                        <li class="single-cart">
                                            <div class="cart-product__subtotal">
                                                <span class="subtotal--title">Subtotal</span>
                                                <span class="subtotal--price">₱<?=number_format($total,2)?></span>
                                            </div>
                                        </li>
                                        <li class="single-cart">
                                            <a href="cart.php" class="btn btn-outlined">View Cart</a>
                                            <a href="checkout.php" class="btn btn-outlined">Check Out</a>
                                        </li>
                                        <?php } ?>



                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12 d-flex d-lg-none order-2 mobile-absolute-menu">
                        <!-- Main Mobile Menu Start -->
                        <div class="mobile-menu"></div>
                        <!-- Main Mobile Menu End -->
                    </div>
                </div>
            </div>


            <div class="row">

            </div>
        </div>
    </div>
</header>