<?php

include 'connection.php';

$idf = $_GET['idv'];

$deletequery = "DELETE FROM jobregistration WHERE id={$idf}";
$dquery = mysqli_query($con,$deletequery);

if($dquery) {
  ?>
  <script>
    alert('Deleted Successfully');
  </script>
  <?php
}
else {
  ?>
  <script>
    alert('Unable to Delete!');
  </script>
  <?php
}

header('location:display.php');

?>
