<?php include 'layouts/header.php';?>


<body>
    <div class="site-wrapper">
        <?php include 'layouts/navigation.php';?>
        <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">My Account</li>
                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                </ol>
            </div>
        </nav>
        <!-- Promotion Block 2 -->

        <main class="page-section pb--10 pt--50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">

                        <!-- Login Form s-->
                        <form id='registerFrm' class='login-form'>
                                <div class="row">
                                    <div class="col-md-12 col-12 mb--20">
                                        <label>Email Address </label>
                                        <input class="mb-0" type="email" name="email" required>
                                    </div>
                                    
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
                                            <button type="submit" name="btn_create_new_account" class="btn btn-success text-white w-100">Create New Account</button>
                                        </div>
                                    </div>

                                    
                                </div>
                        </form>
                    </div>
                </div>
            </div>


            
              
         </div>
        </main>

        <!-- Slider bLock 4 -->

        <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>
</body>


<script>

     

function generateCode(lengthNum){
   const numbers = '0123456789';

    let generate='';
    const charLength = numbers.length;
    
    for(let i=0; i< lengthNum; i++){

        generate += numbers.charAt(Math.floor(Math.random() * charLength));

        generate = Number(generate);
      
    }

    return generate;
}


        $('#registerFrm').submit((e)=>{
            e.preventDefault();
            
             var form = document.getElementById("registerFrm");
            var formData = new FormData(form);
            formData.append('code', generateCode(4));
             var data = {};

            for (var pair of formData.entries()) {
              data[pair[0]] = pair[1];
            }

    



           
           	const emailData = {
				"email":data.email,
                htmlSrc:`
            <div style="max-width:480px; margin: 0 auto;">
                <div style="text-align: center;">
                    <div style="float: left;">
                        <img style="border-radius: 50%;" src="https://wrapitup.store/assets/image/wrapitup-logo.jpg" width="80" height="80" />
                        <p style='font-weight:600;'>Wrapitup</p>
                    </div>
                    <div>
                        <h4>Thank you for registering with us</h4>
                        <h3>Username: ${data.username}</h3>
                        <h3>Email: ${data.email}</h3>
                        <h3 style="text-align:center;">Your code</h3>
                        <h2 style="text-align:center;margin-left:100px;">${data.code}</h2>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                </div>`
			}

             $.ajax({
                url: './mail/register-user.php',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                dataType: 'json',
                success: function (response) {


                
                   
                    if(response.exist === true){
                        Swal.fire({
                        icon: 'error',
                        title: 'Accout already exist',
                        text: 'Something went wrong!',
                    
                        })
                    }
                    else{
                        verify();
                    }

                },
                error: function (response) {
                  console.log("Failed");
                }
            
            });




            function verify(){
                

              $.ajax({
                url: './mail/mail-setup.php',
                type: "POST",
                data: JSON.stringify(emailData),
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                success: function (response) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Email sent successfully',
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout(() => {

                    Cache(['details']);
                    location.href = 'verification.php';

                }, 1000);

            
                },
                error: function (response) {
                  console.log("Failed");
                }
            
              });

            
     
            }


            function Cache(keyArr){
                keyArr.forEach((key)=>{
                    localStorage.setItem(key, JSON.stringify({username:data.username,email:data.email}));
                });
            }
       
});
   


</script>

</html>