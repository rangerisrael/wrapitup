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

<?php


?>
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
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"></span> 
                        Staff</h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-sm-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="#" class="breadcrumb-item">Dashboard</a>
                            <a href="#" class="breadcrumb-item active">Staff</a>
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
                            
                            <?php
                            
                             if (isset($_SESSION['administrator']) && $_SESSION['administrator'] == 1) {
                                ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_sales">Search</button>
                          
                              <div class="btn-group float-right">
                               <button title="add_staff" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal_staff">Add Staff</button>
                             </div>
                          <?php
                                
                             }
                            
                            ?>
                          
                            <?php if(isset($t)) { ?> 
                                <div class="btn-group float-right">
                                    <button title="Printer" class="btn btn-info btn-sm" id="staff"><i class="icon-printer"></i></button>
                                    <a href="users-excel.php?from=<?=urlencode($from)?>&to=<?=urlencode($to)?>" title="Excel" class="btn btn-success btn-sm" id="excel"><i class="icon-file-excel"></i></a>
                                    <a href="users-pdf.php?from=<?=urlencode($from)?>&to=<?=urlencode($to)?>" target="_blank" title="PDF" class="btn btn-warning btn-sm" id="pdf"><i class="icon-file-pdf"></i></a>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if(isset($t)) { ?> 
                            <div class="text-center text-uppercase">
                                <h6>Users report from <?=$f?> to <?=$t?></h6>
                            </div>
                        <?php } ?>
                        <div class="table-responsive" >
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Contact #</th>
                                        <th class='text-center'>Action</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i=1;
                                    $getStaff = get_all_staff($from, $to);

                                    if (isset($_SESSION['administrator']) && $_SESSION['administrator'] == 2) {
                                        $getStaff = get_individual_staff($from, $to, $_SESSION['admin_id']);
                                    }
                                    
                                    ?>
                                          

                                    <?php foreach($getStaff as $staff) { ?>
                                    <tr>
                                        <td style="width:1px"><?=$i++?></td>
                                        <td><?=($staff['firstname']  == '' ? 'NA' : $staff['firstname'].' '.$staff['surname'])?></td>
                                        <td><?= empty($staff['email']) ? 'N/A' : $staff['email'] ?>
                                       </td> <td><?=empty($staff['username']) ? 'N/A' : $staff['username']?></td>
                                
                                        <td><?= empty($staff['contact']) ? 'N/A' : $staff['contact'] ?></td>
                                        <td class='text-center'>
                                        <button onclick="editStaff(<?php echo $staff['id'] ?>)" title="edit" class="text text-success btn-sm" id="staff"><i class="ion-edit mr-2"></i>Edit</button>
                                        <button onclick="deleteStaff(<?php echo $staff['id'] ?>)"  title="delete" class="text text-danger btn-sm" id="staff"><i class="ion-android-delete mr-2"></i>Delete</button>                   
                                        </td>
                                        
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

     <div id="modal_staff" class="modal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title update-modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
            <div class="modal-body">
                <form id='staffForm' >

                     <div class="row">
                           <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" id='email' required/>
                                    
                            </div>
                        </div>
    
                         <div class="col-12">
                            <div class="form-group">
                                <label for="">Firstname</label>
                                <input type="text" class="form-control" name="fname" id="fname" required/>
                                    
                            </div>
                        </div>

                         <div class="col-12">
                            <div class="form-group">
                                <label for="">Lastname</label>
                                <input type="text" class="form-control" name="lname" id='lname' required/>
                                    
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" id="username" required/>
                                    
                            </div>
                        </div>

                         <div class="col-12">
                            <div class="form-group">
                                <label id='passwordLbl' for="password">Password</label>
                                <input type="password" class="form-control" name="password" id='password'  required/>
                                    
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                            <label for="">Gender</label>
                               <select name='gender' id='gender' class="form-control form-control-lg">
                                <option disabled selected value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select>
                                    
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Contact</label>
                                <input type="number" class="form-control" name="contact" id='contact' required/>
                                    
                            </div>
                        </div>

                          <div class="col-12">
                            <div class="form-group">
                                <label for="">Birthaday</label>
                                <input type="date" class="form-control" name="bday" id="bday"  required/>
                                    
                            </div>
                        </div>

                          <div class="col-12">
                            <div class="form-group">
                                <label for="">Age</label>
                                <input type="number" class="form-control" name="age" id='age' required/>
                                    
                            </div>
                        </div>
                    </div>

                      <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" id='actionBtn' name="btn_search" class="btn btn-primary">Save</button>
                </form>
                </div>
                
                </div>
    
              
           
                     
                        
            </div>
        </div>
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

<script>

let getID = '';
  function editStaff(id){

    getID = id;

    const data  = new FormData();
    data.append('id', id);

     $.ajax({
                url: 'get-staff.php',
                method: 'POST',
                data: data,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {


                    $('#email').val(response.email);
                    $('#fname').val(response.firstname);
                    $('#lname').val(response.surname);
                    $('#username').val(response.username);
                    $('#passwordLbl').hide();
                    $('#password').hide();
                    $('#password').val('hidden');
                    $('#password').removeAttr('required');
                    $('#gender').val(response.gender);
                    $('#contact').val(response.contact);
                    $('#bday').val(response.birthday);
                    $('#age').val(response.age);
                    $('#actionBtn').html('Update');
                    $('#modal_staff').modal('show');
                    
                }

            });


  
     
  }


    function deleteStaff(id){


        
        const formData = new FormData();
        formData.append('id', id);

        $.ajax({
        url: 'delete-staff.php',
        type: 'POST',
        processData: false,
        contentType: false,
        data  : formData,
        async: false,
        cache: false,
        dataType: 'json',
        success: function (response) {

        if(response.status === 'valid'){
            Swal.fire(
                'Deleted!',
                'Staff has been deleted.',
                'success'
                )
                setTimeout(() => {
                    location.reload();
                }, 1000);
        }
        
            
        },
        error: function (response) {
            console.log('Failed');
        }
    });



    }


    $(document).ready(function() {
        
      


        $('#staffForm').submit(function(e) {
            e.preventDefault();

            
            let password = document.getElementById('password').value;
            let form = document.getElementById('staffForm');
            let formData = new FormData(form);
            
            if(password !== 'hidden'){
           

                $.ajax({
                        url: 'add_staff.php',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {

                            console.log(response);

                            if(response.success == 'exist') {
                                Swal.fire({
                                icon: 'error',
                                title: 'Accout already exist',
                                text: 'Something went wrong!',
                            
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Staff created Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(() => {
                                $('#modal_staff').modal('hide');
                                    location.reload(); 
                                }, 1000);
                            }
                        }

                    });
            }
            else{

                formData.append('id', getID);
                
                    $.ajax({
                            url: 'update_staff.php',
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {

                                console.log(response);

                                if(response.success == 'not-exist') {
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Accout not exist',
                                    text: 'Something went wrong!',
                                
                                    })
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Staff updated Successfully',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    setTimeout(() => {
                                    $('#modal_staff').modal('hide');
                                    $("#staffForm")[0].reset();
                                        location.reload(); 
                                    }, 1000);
                                }
                            }

                        });
            }

        })

        $('#updateStaffForm').submit(function(e) {
            e.preventDefault();

            
            let form = document.getElementById('updateStaffForm');
            let formData = new FormData(form);
          

        })
    })
</script>