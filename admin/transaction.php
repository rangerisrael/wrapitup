<?php include 'layouts/header.php';?>

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
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Product</span> -
                            Transaction</h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-sm-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="#" class="breadcrumb-item">Dashboard</a>
                            <a href="#" class="breadcrumb-item">Products</a>
                            <a href="#" class="breadcrumb-item active">Transaction</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <!-- Basic card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table datatable-responsive">
                                    <thead>
                                        <tr>
                                            <th style="width:1px">#</th>
                                            <th>Reference</th>
                                            <th>Mode of Payment</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th style="width:1px">Total</th>
                                            <th style="width:1px">Items</th>
                                            <th style="width:1px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach(view_orders() as $orders) { ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$orders['reference']?></td>
                                                <td><?=$orders['method_of_payment']?></td>
                                                <td><?=$orders['created_at']?></td>
                                                <td>
                                                    <?php 
                                                        if($orders['status'] == 0) {
                                                            echo 'Pending';
                                                        } elseif($orders['status'] == 1) {
                                                            echo 'Processing';
                                                        } elseif($orders['status'] == 2) {
                                                            echo 'Completed';
                                                        } else {
                                                            echo 'Cancelled';
                                                        }
                                                    ?>
                                                </td>
                                                <td>AED&nbsp;<?=number_format($orders['total'],2)?></td>
                                                <td><?=$orders['items']?></td>
                                                <td style="width:1px"> <a href="orders.php?reference=<?=$orders['reference']?>" ><i class="icon-eye"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
    <!-- /page content -->
    <?php include 'layouts/scripts.php';?>
    <!-- Theme JS files -->
    <script src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <script src="assets/js/demo_pages/datatables_responsive.js"></script>
</body>


</html>