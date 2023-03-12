<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HELLO</title>
      <!-- Font-icon css-->
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   </head>
   <body>
      <a href="<?php echo base_url("admin/logout")?>">Log out</a>
      <h1>Data of Upload</h1>
      <table  class="table">
         <thead>
            <tr>
               <td>ID</td>
               <td>First Name</td>
               <td>Last Name </td>
               <td>Email</td>
               <td>Courses</td>
               <td>Image</td>
               <td>Information</td>
               <td>Action</td>
               <td>Delete</td>
            </tr>
         </thead>
         <tbody>
            <?php 
               $today=date('Y-m-d');
               $i=1;
               
               foreach($user_list as $list)
               {
                  
               ?>
            <tr>
               <td><?php echo $i;?></td>
               <td><?php echo $list->f_name;?></td>
               <td><?php echo $list->l_name;?></td>
               <td><?php echo $list->email;?></td>
               <td><?php echo $list->courses;?></td>
               <td><img src="<?php echo base_url('uploads/'.$list->image);?>" width="100px"/> </td>
               <td><?php echo $list->information;?></td>
               <td align="center">
                  <i style="cursor:pointer;" onclick="DoEdit('<?php echo $list->id;?>','<?php echo $list->f_name;?>','<?php echo $list->l_name;?>','<?php echo $list->email;?>','<?php echo $list->courses;?>','<?php echo $list->information;?>')" class="fa fa-edit"></i>
               </td>
               <td><a onclick="delete_user(<?php echo $list->id;?>)" class=""> <i class="fa fa-trash" aria-hidden="true"></i> </a> </td>
            </tr>
            <?php $i++; } ?>
         </tbody>
      </table>
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-sm" role="document">
            <form method="post">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <input type="hidden" name="service_id" id="service_id" />
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First Name</label>
                        <textarea class="form-control" id="f_name" name="f_name" required></textarea>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="l_name" name="l_name" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">courses</label>
                        <select  class="form-control" name="courses" id="courses">
                           <option value=""> Select Learning Program</option>
                           <option value="1st"> 1st</option>
                           <option value="2st"> 2nd </option>
                           <option value="3st"> 3rd </option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">information</label>
                        <input type="text" class="form-control" id="information" name="information" required>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <input type="submit" name="Update" value="Update" class="btn btn-primary">
                  </div>
               </div>
            </form>
         </div>
      </div>
      <script>
         function DoEdit(id,f_name,l_name,email,courses,information){
             $('#service_id').val(id);
              $('#f_name').val(f_name);
              $('#l_name').val(l_name);
              $('#email').val(email);
              $('#courses').val(courses);
               $('#information').val(information);
             $('#EditModal').modal('show');
         }
         
         
         
         function delete_user(id)
         {
         if (confirm('Are you sure you want to delete this User?')) 
         {
         $.ajax({
           url: "<?php echo base_url('Admin/delete_user'); ?>",
           type: "POST",   
           data:  {id:id},
           success: function(data)
           {   
             var obj= JSON.parse(data);
             var success=obj.success;
             var message=obj.message; 
             if(success=='1')
             {
               
               window.location="<?php echo base_url()?>Admin/dashboard";
             }
             else
             {
               
               window.location="<?=base_url()?>Admin/dashboard";
             }
           }
         }); 
         }
         }
         
      </script>
   </body>
</html>