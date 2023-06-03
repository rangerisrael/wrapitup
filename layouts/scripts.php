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
</script>
