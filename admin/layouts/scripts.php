	<!-- Core JS files -->
	<script src="assets/js/main/jquery.min.js"></script>
	<script src="assets/js/main/bootstrap.bundle.min.js"></script>
	<!-- /core JS files -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Theme JS files -->
	<script src="assets/js/app.js"></script>
	<!-- /theme JS files -->

	<script>
		
    function deleteAction(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {



							const getId = {
								id:id
							}
							
								 fetch('delete-review.php',{
										method:'POST',
										header: {
											"Content-type": "application/json; charset=UTF-8"
										},
										body: JSON.stringify(getId)
									}).then((res) => res.json()).then((data) => {

										console.log(data)
										
										if(data.response === 'valid'){
											successMessage()
										}
										if(data.response ===  'notfound'){
											failedMessage('Product review is not created');
										}
										if(data.response === 'invalid'){
											failedMessage('Opps😔, Sorry there\'s something went wrong')

										}
									
									}).catch((err)=> console.log(err))


             
            }
            })
    }


		    function successMessage(){
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Product selected deleted successfully',
        showConfirmButton: false,
        timer: 1500
        })
        setTimeout(() => {
            location.reload();
        }, 2000);
    }
    function failedMessage(message){
          Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: message,
        showConfirmButton: false,
        timer: 2000
        })

    }

	</script>