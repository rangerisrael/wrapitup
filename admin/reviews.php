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
                            Reviews</h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-sm-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="#" class="breadcrumb-item">Dashboard</a>
                            <a href="#" class="breadcrumb-item">Products</a>
                            <a href="#" class="breadcrumb-item active">Product Reviews</a>
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
                                            <th>Name</th>
                                            <th>Comments</th>
                                             <th>Product Name</th>
                                    
                                            <th>Product item</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                           

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach(getAllReviews() as $productReview) { ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?php echo $productReview['name'] ?></td>
                                                <td><?php echo $productReview['comment'] ?></td>
                                                <td><?php echo $productReview['product_name'] ?></td>
                                                <td>
                                           		<label for="upload">
                                                              <?php 
                                                            if(str_contains($productReview['filetype'],'image')){
                                                                ?>
                                                            <img src="../assets/review/image/<?php echo $productReview['filename'] ?>" class="img-fluid img-thumbnail" id='photoReview' width='150' height='150' alt="...">

                                                           <?php     
                                                            }
                                                           
                                                           ?>
                                                           <?php 
                                                            if(str_contains($productReview['filetype'],'video')){
                                                                ?>
                                                         <video  width='150' height='150' id='videoReview' controls  >
                                                                <source src='../assets/review/video-clip/<?php echo $productReview['filename'] ?>' />
                                                                Your browser does not support HTML5 video.
                                                            </video>
                                                           <?php     
                                                            }
                                                           
                                                           ?>
                                                </label/>


                                                </td>
                                                <td><?php echo $productReview['created_at'] ?></td>
                                                <td>
                                                <button type="button" onclick='deleteAction(<?php echo $productReview["id"] ?>)' class="btn btn-danger" data-dismiss="modal">Delete</button>

                                                </td>
                                                
                                                
                                                
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
  
    <!-- Theme JS files -->
    <script src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <script src="assets/js/demo_pages/datatables_responsive.js"></script>
    <script>
      function deleteAction(id){
        deleteAction(id)
      }
    </script>

      <?php include 'layouts/scripts.php';?>
</body>


</html>