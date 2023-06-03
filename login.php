<?php include 'layouts/header.php';?>
<?php 
    if(isset($_POST['btn_login'])) {
        global $db;
        $role     = $db->real_escape_string($_POST['role']);
        $username = $db->real_escape_string($_POST['username']);
        $password = $db->real_escape_string($_POST['password']);
        login($username,$password,$role);
    }
?>
<body>
    <div class="site-wrapper">
        <?php include 'layouts/navigation.php';?>
        <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">My Account</li>
                    <li class="breadcrumb-item active" aria-current="page">Sign In</li>
                </ol>
            </div>
        </nav>
        <!-- Promotion Block 2 -->

        <main class="page-section pb--10 pt--50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                        <form method="POST">
                        <input type="hidden" name="role" value="1">

                            <div class="login-form">
                                <div class="row">
                                    <div class="col-md-12 col-12 mb--20">
                                        <label>Username </label>
                                        <input class="mb-0" type="text" name="username" required>
                                    </div>
                                    <div class="col-12 mb--20">
                                        <label>Password</label>
                                        <input class="mb-0" type="password" name="password" required>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center flex-wrap">
                                            <button type="submit" name="btn_login" class="btn btn-success text-white w-100">Login</button>
                                        </div>
                                        <p><a href="forgot-password.php" class="pass-lost mt-3">Lost your password?</a></p>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!-- Slider bLock 4 -->

        <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>
</body>

</html>