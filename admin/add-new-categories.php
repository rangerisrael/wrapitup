<?php include 'layouts/header.php';?>
<?php
if(isset($_POST['btn_create_category'])) { 
    global $db;
    $parent      = $db->real_escape_string($_POST['parent']);
    $is_featured = $db->real_escape_string($_POST['is_featured']);
    product_categories($parent,$is_featured);
}

if(isset($_POST['btn_update_category'])) { 
    global $db;
    $id          = $db->real_escape_string($_POST['update_id']);
    $parent      = $db->real_escape_string($_POST['update_parent']);
    $is_featured = $db->real_escape_string($_POST['update_is_featured']);
    update_product_categories($id,$parent,$is_featured);
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
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Categories</span>
                            - Create</h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-sm-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="#" class="breadcrumb-item">Dashboard</a>
                            <a href="#" class="breadcrumb-item">Categories</a>
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
                                    <h5 class="modal-title">Category Details</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Upload Thumbnail</label>
                                                <input type="file" class="form-control" name="images">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <input type="text" class="form-control" name="parent" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Feature Category</label>
                                                <select name="is_featured" class="form-control">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                    <button type="submit" name="btn_create_category"
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
                                            <th>Category</th>
                                            <th style="width:1px">Count</th>
                                            <th style="width:1px">Featured</th>
                                            <th style="width:1px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach(get_all_categories() as $data) { ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['parent']?></td>
                                            <td style="text-align:center">
                                                <a
                                                    href="add-new-sub-categories.php"><?=get_all_sub_categories($data['id'])->num_rows?></a>
                                            </td>
                                            <th style="text-align:center">
                                                <?php if($data['is_featured'] == 0) { ?>
                                                <span class="badge badge-danger">No</span>
                                                <?php } else { ?>
                                                <span class="badge badge-success">Yes</span>
                                                <?php } ?>
                                            </th>
                                            <td><a href="javascript:void(0)" onclick="modal_default_update('<?=$data['id']?>','<?=$data['images']?>','<?=$data['parent']?>','<?=$data['is_featured']?>')"><i class="icon-eye"></i></a>
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
                <div id="modal_default_update" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title update-modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <img style="width:100%" id="update-image" alt="">
                                        </div>
                                    </div>

                                    <div class="col-md-8 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Upload Thumbnail</label>
                                                    <input type="file" class="form-control" name="update_images">
                                                    <input type="hidden" id="update_id" class="form-control"
                                                        name="update_id">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Category</label>
                                                    <input type="text" class="form-control" name="update_parent"
                                                        id="update_parent" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Feature Category</label>
                                                    <select name="update_is_featured" id="update_is_featured"
                                                        class="form-control">
                                                        <option value="0">
                                                            No</option>
                                                        <option value="1">
                                                            Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                <button type="submit" name="btn_update_category" class="btn btn-primary">Save
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
        function modal_default_update(id,images,parent,is_featured) {
            $('#modal_default_update').modal()
            $('#update_id').val(id);
            $('#update_parent').val(parent);
            $('#update_is_featured').val(is_featured);
            if(images == '' || images == null) {
                $("#update-image").attr("src","https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsNGGjrfSqqv8UjL18xS4YypbK-q7po_8oVQ&usqp=CAU");
            } else {
                $("#update-image").attr("src","../assets/image/category/"+images);
            }
        }
    </script>
</body>

</html>