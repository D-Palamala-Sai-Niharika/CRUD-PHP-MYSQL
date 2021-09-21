<?php

$server = 'localhost';
$username = 'root';
$password = '';
$db = 'job_crud_db';

$con = mysqli_connect($server,$username,$password,$db);

if($con){
  ?>
  <script>
    alert('connection successful😀');
  </script>
  <?php
}
else{
  ?>
  <script>
    alert('connection unsuccessful😟');
  </script>
  <?php
}

?>
