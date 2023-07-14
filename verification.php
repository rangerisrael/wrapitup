<?php include 'layouts/header.php';?>
<?php 
    // if(isset($_POST['btn_login'])) {
    //     global $db;
    //     $role     = $db->real_escape_string($_POST['role']);
    //     $username = $db->real_escape_string($_POST['username']);
    //     $password = $db->real_escape_string($_POST['password']);
    //     login($username,$password,$role);
    // }
?>
<style>
    :root {
  --spacing: 8px;
  --hue: 400;
  --background1: hsl(214, 14%, 20%);
  --background2: hsl(214, 14%, 13%);
  --background3: hsl(214, 14%, 5%);
  --brand1: hsl(var(--hue) 80% 60%);
  --text1: hsl(0, 0%, 100%);
  --text2: hsl(0, 0%, 90%);
}

.number-code {
  overflow: auto;
  > div {
    display: flex;
    > input:not(:last-child) {
      margin-right: calc(var(--spacing) * 2);
    }
  }
}


.code-input{
    font-size:2rem;
    text-align:center;
}

form {
  
  input.code-input {
    font-size: 1.5em;
    width: 1em;
    text-align: center;
    flex: 1 0 1em;
  }

  input {
    
    padding: var(--spacing);
    border-radius: calc(var(--spacing) / 2);
    color: var(--text1);
    background: var(--background1);
    border: 0;
    border: 4px solid transparent;
    &:invalid {
      box-shadow: none;
    }
    &:focus {
      outline: none;
      border: 4px solid var(--brand1);
      background: var(--background3);
    }
  }
}

</style>
<body>
    <div class="site-wrapper">
      
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
                        <p style='color:#ff0000; font-weight:600;' class='alert alert-warning text-center'>Your account is not verified, Please check your email </p>

                        <form id='verifyForm' method="POST">
                        <input type="hidden" name="role" value="1">

                            <div class="login-form">
                                <div class="row">
                                    <div class="col-md-12 col-12 mb--20">
                                <fieldset class='number-code'>
                                    <legend>Verify Code</legend>
                                    <div class='mt-5'>
                                    <input name='code[]' class='code-input' required/>
                                    <input name='code[]' class='code-input' required/>
                                    <input name='code[]' class='code-input' required/>
                                    <input name='code[]' class='code-input' required/>
                                  
                                    </div>
                                </fieldset>
                                 </div>
                                  
                                    <div class="col-md-12">
                                        <p id='resend' class="text-right"><a href='#'>Resend Code</a></p>
                                        <div class="d-flex align-items-center flex-wrap">
                                            <button type="submit" name="btn_login" class="btn btn-success text-white w-100">Verify</button>
                                        </div>
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



<script>
    const inputElements = [...document.querySelectorAll('input.code-input')]

inputElements.forEach((ele,index)=>{
  ele.addEventListener('keydown',(e)=>{
    // if the keycode is backspace & the current field is empty
    // focus the input before the current. Then the event happens
    // which will clear the "before" input box.
    if(e.keyCode === 8 && e.target.value==='') inputElements[Math.max(0,index-1)].focus()
  })
  ele.addEventListener('input',(e)=>{
    // take the first character of the input
    // this actually breaks if you input an emoji like 👨‍👩‍👧‍👦....
    // but I'm willing to overlook insane security code practices.
    const [first,...rest] = e.target.value
    e.target.value = first ?? '' // first will be undefined when backspace was entered, so set the input to ""
    const lastInputBox = index===inputElements.length-1
    const didInsertContent = first!==undefined
    if(didInsertContent && !lastInputBox) {
      // continue to input the rest of the string
      inputElements[index+1].focus()
      inputElements[index+1].value = rest.join('')
      inputElements[index+1].dispatchEvent(new Event('input'))
    }
  })
})

</script>
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


function dispatchCache(){
  return JSON.parse(localStorage.getItem('details'));
}

function getUrlSearch(){
  const url = new URL(window.location.href);
  const searchParams = new URLSearchParams(url.search);
  return {
    username:searchParams.get('username'),
    email:searchParams.get('email')
  };
}



        $('#resend').click((e)=>{
            e.preventDefault();
            
          const cacheItem = dispatchCache() ?? getUrlSearch();
          

            var formData = new FormData();
            formData.append('username',cacheItem.username);
            formData.append('email', cacheItem.email);
            formData.append('code', generateCode(4));
            formData.append('reset', 'true');

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
                url: './mail/update_code.php',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                dataType: "json",
                success: function (response) {
                  

                   if(response.success === false){
                          Swal.fire({
                        icon: 'error',
                        title: 'Invalid credentials',
                        text: 'Something went wrong!',
                    
                        });
                   }
                   else{
                         verification();
                   }

               

                },
                error: function (response) {
                  console.log("Failed");
                }
            


             });



            function verification(){
                
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
                  title: 'Email resend successfully',
                  showConfirmButton: false,
                  timer: 1500
                })
                },
                error: function (response) {
                  console.log("Failed");
                }
            
            });

              
         

            }

     
        });



      $('#verifyForm').submit((e)=>{
            e.preventDefault();
            
             var form = document.getElementById("verifyForm");

             const cacheItem = dispatchCache() ?? getUrlSearch();
          

            var formData = new FormData(form);
            formData.append('username',cacheItem.username);
            formData.append('email', cacheItem.email);
            formData.append('reset', 'false');

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
                        <h3>Your accunt was verified</h3> 
                    </div>
                    <div style="clear: both;"></div>
                </div>
                </div>`
			}


            $.ajax({
                url: './mail/update_code.php',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                dataType: "json",
                success: function (response) {

                 console.log(response,'get respponse')
                
                   if(response.success === false){
                         Swal.fire({
                        icon: 'error',
                        title: 'Invalid credentials',
                        text: 'Something went wrong!',
                    
                        });
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
                  title: 'Congratulation! Your account was verified',
                  showConfirmButton: false,
                  timer: 1500
                })
                 setTimeout(() => {
                  localStorage.removeItem('details');
                   location.href='login.php';
                 }, 1000);

                },
                error: function (response) {
                  console.log("Failed");
                }
            
            });

               
            }

     
        });




</script>

</html>