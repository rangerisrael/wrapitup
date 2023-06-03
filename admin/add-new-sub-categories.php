<?php include 'layouts/header.php';?>
<?php
if(isset($_POST['btn_create_sub_category'])) { 
    global $db;
    $product_categories_id  = $db->real_escape_string($_POST['product_categories_id']);
    $child                  = $db->real_escape_string($_POST['child']);
    product_sub_categories($product_categories_id,$child);
}

if(isset($_POST['btn_update_sub_category'])) { 
    global $db;
    $id                             = $db->real_escape_string($_POST['update_id']);
    $update_product_categories_id   = $db->real_escape_string($_POST['update_product_categories_id']);
    $update_child                   = $db->real_escape_string($_POST['update_child']);
    update_sub_categories($id,$update_product_categories_id,$update_child);
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
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sub Categories</span>
                            - Create</h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-sm-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="#" class="breadcrumb-item">Dashboard</a>
                            <a href="#" class="breadcrumb-item">Sub Categories</a>
                            <a href="#" class="breadcrumb-item active">Create</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <div class="form-group">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_default">Add New</button>
                </div>

                <form method="POST" enctype="multipart/form-data">
                    <div id="modal_default" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title">Sub Category Details</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <select name="product_categories_id" class="form-control" id="">
                                                    <?php foreach(get_all_category() as $category) { ?>
                                                        <option value="<?=$category['id']?>"><?=$category['parent']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Sub Category</label>
                                                <input type="text" class="form-control" name="child" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                    <button type="submit" name="btn_create_sub_category"
                                        class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Basic card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table class="table datatable-responsive">
                                    <thead>
                                        <tr>
                                            <th style="width:1px">#</th>
                                            <th>Sub Category</th>
                                            <th style="width:1px">Count</th>
                                            <th style="width:1px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach(all_sub_categories() as $data) { ?>
                                            <?php $query = get_specific_category($data['product_categories_id'])->fetch_assoc()?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$query['parent']?> - <?=$data['child']?></td>
                                            <td style="text-align:center"><?=count_product($data['id'])?></td>
                                            <td><a href="javascript:void(0)" onclick="modal_default_update('<?=$data['id']?>','<?=$data['product_categories_id']?>','<?=$data['child']?>')"><i class="icon-eye"></i></a>
                                            </td>
                                        </tr>


                                        <?php $i++?>

                                        <?php } ?>
                                    </tbody>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="update_id" id="update_id">
                <div id="modal_default_update" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title update-modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select name="update_product_categories_id" class="form-control" id="update_product_categories_id">
                                                <?php foreach(get_all_category() as $category) { ?>
                                                    <option value="<?=$category['id']?>"><?=$category['parent']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Sub Category</label>
                                            <input type="text" class="form-control" id="update_child" name="update_child" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                <button type="submit" name="btn_update_sub_category" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    <script>
        function modal_default_update(id,product_categories_id,child) {
            $('#modal_default_update').modal()
            $('#update_id').val(id);
            $('#update_product_categories_id').val(product_categories_id);
            $('#update_child').val(child);
        }
    </script>
</body>

</html>