<?php
  $page_title = 'Add Customer';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
?>
<?php
  if(isset($_POST['add_customer'])){

   $req_fields = array('name','address','salary' );
   validate_fields($req_fields);

   if(empty($errors)){
           $name   = remove_junk($db->escape($_POST['name']));
       $address   = remove_junk($db->escape($_POST['address']));
      // $address   = remove_junk($db->escape($_POST['salary']));
       $salary = (int)$db->escape($_POST['salary']);
       
        $query = "INSERT INTO customers (";
        $query .="name,address,salary";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$address}', '{$salary}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Customer details has been creted! ");
          redirect('add_customer.php', false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to add customer!');
          redirect('add_customer.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_customer.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Customer</span>
       </strong>
       <div class="pull-right">
            <a href="customers.php" class="btn btn-primary">Cancel</a>
          </div>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_customer.php">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" class="form-control" name ="salary"  placeholder="Salary">
            </div>
           
            <div class="form-group clearfix">
              <button type="submit" name="add_customer" class="btn btn-primary">Add Customer</button>
            </div>
            
        </form>
        
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
