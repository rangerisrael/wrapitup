<script src="assets/js/plugins.js"></script>
<script src="assets/js/ajax-mail.js"></script>
<script src="assets/js/custom.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    function remove(id) {
        location.href = "?remove-cart=true&id="+id+"&success=true&message=<?=urlencode('Item has removed to your cart')?>"
    }
    <?php if(isset($_GET['success'])) { ?>
        Swal.fire({
            title: '<?=$_GET['success'] == 'false' ? 'Error!' : 'Success!'?>',
            text: '<?=urldecode($_GET['message'])?>',
            icon: '<?=$_GET['success'] == 'false' ? 'error' : 'success'?>',
        })
    <?php }  ?>

    function successMessage(){
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Thanks for submitting your review to us,Hope we give our best to serve you',
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
