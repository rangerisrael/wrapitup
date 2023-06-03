<?php include 'layouts/header.php';?>
<?php 
if(isset($_POST['btn_search'])) {
    $from   = $db->real_escape_string($_POST['from']).' 00:00:00';
    $to     = $db->real_escape_string($_POST['to']).' 23:59:59';
    $f      = $db->real_escape_string($_POST['from']);
    $t      = $db->real_escape_string($_POST['to']);
} else {
    $from   = '';
    $to     = '';
}
?>

<body>

    <!-- Main navbar -->
    <?php include 'layouts/top-navigation.php';?>
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <?php include 'layouts/navigation.php';?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="page-header-content d-sm-flex">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Reports</span> -
                        Product</h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-sm-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="#" class="breadcrumb-item">Dashboard</a>
                            <a href="#" class="breadcrumb-item">Reports</a>
                            <a href="#" class="breadcrumb-item active">Product</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <!-- Basic card -->
                <div class="row" id="sales" >
                    <div class="col-12">
                        <div class="form-group no-print">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_sales">Search</button>
                            <?php if(isset($t)) { ?> 
                                <div class="btn-group float-right">
                                    <button title="Printer" class="btn btn-info btn-sm" id="print"><i class="icon-printer"></i></button>
                                    <a href="product-excel.php?from=<?=urlencode($from)?>&to=<?=urlencode($to)?>" title="Excel" class="btn btn-success btn-sm" id="excel"><i class="icon-file-excel"></i></a>
                                    <a href="product-pdf.php?from=<?=urlencode($from)?>&to=<?=urlencode($to)?>" target="_blank" title="PDF" class="btn btn-warning btn-sm" id="pdf"><i class="icon-file-pdf"></i></a>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if(isset($t)) { ?> 
                        
                            <div class="text-center text-uppercase">
                                <h6>Most Buying Product report from <?=$f?> to <?=$t?></h6>
                            </div>
                        <?php } ?>

                        <div class="table-responsive" >
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i=1;?>
                                    <?php foreach(most_buying_product($from,$to) as $payment) { ?>
                                    <tr>
                                        <td style="width:1px"><?=$i++?></td>
                                        <td><?=$payment['product']?></td>
                                        <td><?=$payment['items']?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /content area -->


            <!-- Footer -->
            <?php include 'layouts/footer.php';?>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>

        <form method="POST" enctype="multipart/form-data">
            <div id="modal_sales" class="modal" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title update-modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">From</label>
                                        <input type="date" class="form-control" name="from" value="<?=isset($f) ? $f : '' ?>" equired>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">To</label>
                                        <input type="date" class="form-control" name="to" value="<?=isset($t) ? $t : '' ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" name="btn_search" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    <!-- /page content -->
    <?php include 'layouts/scripts.php';?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?php 
    if(isset($_POST['btn_search'])) { ?>
        <script>
            $('#print').click( e => {
                $("#sales").print({
                    addGlobalStyles : true,
                    stylesheet : null,
                    rejectWindow : true,
                    noPrintSelector : ".no-print",
                    iframe : true,
                    append : null,
                    prepend : null
                });
            })
            
        </script>
    <?php } ?>

</body>

</html>