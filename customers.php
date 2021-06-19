<?php
  $page_title = 'All sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$customers = find_all_customer();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>All Customers</span>
          </strong>
          <div class="pull-right">
            <a href="add_customer.php" class="btn btn-primary">Add customer</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 15px;">#</th>
                <th> Customer's Name </th>
                <th class="text-center" style="width: 50%;"> Address</th>
                <th class="text-center" style="width: 15%;"> Salary </th>
                
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($customers as $customer):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($customer['name']); ?></td>
               <td><?php echo remove_junk($customer['address']); ?></td>
               <td class="text-center"><?php echo (int)$customer['salary']; ?></td>
               
               
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_customer.php?id=<?php echo (int)$customer['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_customer.php?id=<?php echo (int)$customer['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
