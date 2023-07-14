<?php include 'layouts/header.php';?>

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
                   <!-- <input type="hidden" name="role" value="1"> -->

                            <form id='loginFrm' class="login-form">
                                <div class="row">
                                    <div class="col-md-12 col-12 mb--20">
                                        <label>Username/Email </label>
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
                                        <!-- <p><a href="forgot-password.php" class="pass-lost mt-3">Lost your password?</a></p> -->
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

<script>
    $(document).ready(function() {

                
                     let mobileScreen = window.matchMedia("(max-width: 640px)");

                      

                      mobileScreen.addListener(function(mobileScreen) {
                            if (mobileScreen.matches) {
                                
                                localStorage.setItem('screen', 1)

                             } else {
                        
                                localStorage.setItem('screen', 2)

                            }
                        });

                function dispatchCache(){
                    return localStorage.getItem('screen')
                }
                        

                $('#loginFrm').submit(function(e) {
                    e.preventDefault();

                       
                 const screen = dispatchCache() ?? 1;

        
                const formData =document.getElementById("loginFrm");
                let data = new FormData(formData);
                data.append('role', screen);

    
                    $.ajax({
                    url: './mail/login.php',
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.success == true) {
                        console.log('get success');

                        let mobileScreen = window.matchMedia("(max-width: 640px)");

                        // Function to handle changes in screen size
                        function handleScreenChange(mobileScreen) {
                            if (mobileScreen.matches) {
                            console.log('get screen mobile');
                            if (data.role == 1) {
                                window.location.href = 'my-account.php';
                            } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Unauthorized credentials.',
                                text: 'Something went wrong!'
                                });
                            }
                            } else {
                            console.log('get screen desk');
                            if (data.role == 2) {
                                window.location.href = 'my-account.php';
                            } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Unauthorized credentials.',
                                text: 'Something went wrong!'
                                });
                            }
                            }
                        }

                        // Initial check for screen size
                        handleScreenChange(mobileScreen);

                        // Add listener for screen size changes
                        mobileScreen.addListener(handleScreenChange);
                        } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid credentials.',
                            text: 'Something went wrong!'
                        });
                        }
                    }
                    });

        
        

           })

         })
</script>