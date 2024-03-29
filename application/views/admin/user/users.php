<?php 
error_reporting(0);
$isAdmin = false;
 if ($this->session->userdata('role') == 'admin'){
    $isAdmin = true;
}     
?>
<style type="text/css">
    thead, tfoot {
        background: #03a9f3;
    }
    thead tr th , tfoot tr th {
        color: #fff;
    }
    tbody{
        color:#000;
    }

    td .image-popup-no-margins .profile-status {
        border: 2px solid #fff;
        border-radius: 50%;
        display: inline-block;
        height: 13px;
        left: 11.4%;
        position: absolute;
        width: 13px;
    }

    td .image-popup-no-margins .online {
        background: #00c292;
    } 

    td .image-popup-no-margins .offline {
       background: #fec107;
    }

</style>


    <!-- Start Page Content -->

    <div class="row all_emp_table">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading">  All Empolyees
                
                
                 <?php if ($isAdmin): ?>
                    <a href="<?php echo base_url('admin/user/createEmployee') ?>" class="btn btn-info btn-sm pull-right">&nbsp;+ Add New Employee </a> &nbsp;

                 
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/user/createEmployee') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;+ Add New Employee</a>
                    <?php endif; ?>
                <?php endif ?>
                
                </div>
                
                <div class="panel-body table-responsive">
                
                 <?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
                <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
           <!--   <button onclick="getLocation()">Get Location</button>
                                                <p id="demo"></p> -->
                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                     <th>Photo</th>
                                    <th>Name</th>
                                   <th>Mobile No</th>
                                    <th>Salary</th> 
                                    <!-- <th>Country</th>-->
                                    <th>IFSC Code</th> 
                                    <th>Bank Details</th> 
                                    <!-- <th>Documents Uploaded</th> -->
                                    <th>Location</th>
                                    <th>Status</th>
                                    <!-- <th>Role</th> -->
                                    <!-- <th>Joining Date</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                           
                            
                            <tbody>
                                <?php  $scount = 0; ?>
                            <?php foreach ($users as $user):
                                    if($user['role']=='user' && $user['is_deleted'] != 1):
                                        $aad_val= explode(",",$user['aadhar_card']);
                                        $vot_val= explode(",",$user['voter_id']);
                                        $pass_val= explode(",",$user['bank_passbook']);
                                        //$pic_val= explode(",",$user['profile_pic']);
                                        $pic_val= $user['profile_pic'];
                                         $scount++;                              
                              
                                    ?>
                                
                                <tr>
                                    <td><?=$scount?></td>
                                    <td> 
                                    <a class='image-popup-no-margins' href='<?php echo $pic_val["0"]; ?>' title='Profile Picture'>
                                         <span class="profile-status offline pull-right <?php echo $user['chat_username'].'_offline'?>"></span>
                                            <!-- <span class="profile-status busy pull-right"></span> -->
                                            <span style="display: none;" class="profile-status online pull-right <?php echo $user['chat_username'].'_online'?>"></span>
                                            <img style="width:50px; height:50px; border-radius:50%;" src="<?php echo $pic_val; ?>" >
                                            <!-- <span class="profile-status away pull-right"></span> -->
                                           
                                        </a>
                                        </td>
                                        <td>
                                        <a href="<?php echo base_url('admin/user/user_view_data/'.$user['id']) ?>"><?php echo '&nbsp;&nbsp;'.$user['first_name'].' '.$user['last_name']; ?></a>
                                         </td>
                                          <td><?php echo $user['salary']; ?></td>
                                    <td><?php echo $user['mobile']; ?></td>
                                    <!-- <td><?php echo $user['address1'].', '.$user['address2'] .', '.$user['addr_state'].' - '.$user['pin_code'].', '.$user['country'] ?></td> -->
                                    <!-- <td><?php echo $user['country']; ?></td>-->
                                    <td><?php echo $user['ifsc_code']; ?></td> 
                                    <td><?php echo $user['account_number'];?></td> 
                                    <!-- <td>
                                        <a class='image-popup-no-margins' href='<?php echo $aad_val["0"]; ?>' title='Aadhar Card'>
                                            <img style="width:60px;" src='<?php echo $aad_val["1"]; ?>' >
                                        </a>
                                        <a class='image-popup-no-margins' href='<?php echo $vot_val["0"]; ?>' title='Voter Id'>
                                            <img style="width:60px;" src='<?php echo $vot_val["1"]; ?>' >
                                        </a>
                                        <a class='image-popup-no-margins' href='<?php echo $pass_val["0"]; ?>' title='Bank Passbook'>
                                            <img style="width:60px;" src='<?php echo $pass_val["1"]; ?>' >
                                        </a>
                                    </td>  -->
                                    <td>
                                        <?php 

                                            if(json_decode(file_get_contents('http://ip-api.com/json/'.$user['user_ip'])) && $user['user_ip']){
                                                $details = json_decode(file_get_contents('http://ip-api.com/json/'.$user['user_ip']));
                                                echo $details->city;
                                                // ?q=<?=$details->lat.','.$details->lon
                                                ?>
                                                <br>
                                
                                                <!-- <a class="popup-gmaps btn btn-info" onClick="initialize()"style="color: #fff;" href="https://maps.google.com/?q=<?=$details->loc?>">Open Google Map</a> -->

                                                <a class="popup-gmaps btn btn-info" onClick="initialize()"style="color: #fff;" href="https://maps.google.com/?>">Open Google Map</a>
                                           <?php  } else { ?>
                                                N/A
                                            <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($user['status'] == 0): ?>
                                            <div class="label label-table label-danger">Inactive</div>
                                        <?php else: ?>
                                            <div class="label label-table label-success">Active</div>
                                        <?php endif ?>
                                    </td>
                                    <!-- <td width="10%">
                                        <?php if ($user['role'] == 'admin'): ?>
                                            <div class="label label-table label-info"><i class="fa fa-user"></i> admin</div>
                                        <?php else: ?>
                                            <div class="label label-table label-success">Employee</div>
                                        <?php endif ?>
                                    </td> -->

                                    <!-- <td><?php echo my_date_show_time($user['created_at']); ?></td> -->
                                    <td class="text-nowrap icon_action">

                                        <?php if ( $isAdmin): ?>
                                        
                                        <a href="<?php echo base_url('admin/user/user_view_data/'.$user['id']) ?>"  data-toggle="tooltip" data-original-title="View"><button type="button" class="btn  btn-circle btn-xs"><i class="fa fa-eye"></i></button></a>
                                        <a href="<?php echo base_url('admin/user/update/'.$user['id']) ?>"  data-toggle="tooltip" data-original-title="Edit"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>
                                        
                                        
                                        <a href="<?php echo base_url('admin/user/delete/'.$user['id']) ?>" onclick="return confirm('Are you sure, you want to delete this employee time?');" data-toggle="tooltip" data-original-title="Delete"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash-o"></i></button></a>
 <a onclick="return confirm('Are you sure, you want to delete the login time?');" href="<?php echo base_url('admin/user/getLoginTimeFix/'.$user['id']) ?>" >
                                            <button type="button" class="btn btn-success btn-circle btn-xs"><i  style="font-size: 15px" class="fa fa-refresh"></i></button>
                                        </a>
                                        <a target = "_blank"  href="<?php echo base_url('admin/user/attendance/'.$user['id']) ?>" data-toggle="tooltip" data-original-title="Activate">
                                            <button type="button" class="btn btn-warning btn-circle btn-xs"><i class="fa fa-calendar"></i></button>
                                        </a>
<a href="<?php echo base_url('admin/user/assign_task/'.$user['id']) ?>" data-toggle="tooltip" data-original-title="Activate"><button type="button" class="">Task</button></a>
                                        <?php else: ?>

                                            <!-- check logged user role permissions -->

                                            <?php if(check_power(2)):?>

<a href="<?php echo base_url('admin/user/update/'.$user['id']) ?>"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>

                                            <?php endif; ?>
                                            
                                            <?php if(check_power(3)):?>
                                            
                                                
<a href="<?php echo base_url('admin/user/delete/'.$user['id']) ?>" onclick="return confirm('Are you sure, you want to delete this employee?');" data-toggle="tooltip" data-original-title="Delete"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>

                                            <?php endif; ?>

                                        <?php endif ?>

                                        
                                        
                                        <?php if ($user['status'] == 1): ?>
                                                                                    
<a href="<?php echo base_url('admin/user/deactive/'.$user['id']) ?>" data-toggle="tooltip" data-original-title="Deactive"><button type="button" class="btn btn-warning btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                                            
                                            
                                        <?php else: ?>

<a href="<?php echo base_url('admin/user/active/'.$user['id']) ?>" data-toggle="tooltip" data-original-title="Activate"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-check"></i></button></a>


                                        <?php endif ?>


                                    </td>
                                </tr>
                                <?php endif ?>
                            <?php endforeach ?>

                            </tbody>


                        </table>
                    </div>
                    
                    
            </div>
        </div>
    </div>

