<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $d_customer = find_by_id('customers',(int)$_GET['id']);
  if(!$d_customer){
    $session->msg("d","Missing customer id.");
    redirect('customers.php');
  }
?>
<?php
  $delete_id = delete_by_id('customers',(int)$d_customer['id']);
  if($delete_id){
      $session->msg("s","customer deleted.");
      redirect('customers.php');
  } else {
      $session->msg("d","customer deletion failed.");
      redirect('customers.php');
  }
?>
