<?php
  $page_title = 'Edit Customers';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $customer = find_by_id('customers',(int)$_GET['id']);
  
  if(!$customer){
    $session->msg("d","Missing Customer id.");
    redirect('customers.php'); 
  }
?>
<?php
  if(isset($_POST['update'])){

   $req_fields = array('name','address','salary');
   validate_fields($req_fields);
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['name']));
          $address = remove_junk($db->escape($_POST['address']));
         $salary = remove_junk($db->escape($_POST['salary']));

        $query  = "UPDATE customers SET ";
        $query .= "name='{$name}',address='{$address}',salary='{$salary}'";
        $query .= "WHERE ID='{$db->escape($customer['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Customer details has been updated! ");
          redirect('edit_customer.php?id='.(int)$customer['id'], false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to updated Customer details!');
          redirect('edit_customer.php?id='.(int)$customer['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('edit_customer.php?id='.(int)$customer['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Edit Customer</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="edit_customer.php?id=<?php echo (int)$customer['id'];?>" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Customer's Name</label>
              <input type="name" class="form-control" name="name" value="<?php echo remove_junk(ucwords($customer['name'])); ?>">
        </div>
        <div class="form-group">
              <label for="address" class="control-label">Address</label>
              <input type="name" class="form-control" name="address" value="<?php echo (int)$customer['address']; ?>">
        </div>
        <div class="form-group">
              <label for="salary" class="control-label">Salary</label>
              <input type="number" class="form-control" name="salary" value="<?php echo (int)$customer['salary']; ?>">
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info">Update</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>
