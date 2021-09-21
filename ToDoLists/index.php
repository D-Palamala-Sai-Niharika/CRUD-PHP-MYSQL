<?php

$insert = false;
$update = false;
$delete = false;

/*---------------------Connect---------------------------*/

$server = 'localhost';
$username = 'root';
$password = '';
$db = 'iNotes';

$con = mysqli_connect($server,$username,$password,$db);

if(!$con){
  echo die("Not connected to database properly".mysqli_connect_error());
}

/*---------------------Insert----------------------------*/

if(isset($_POST['addnote'])){

  $title = $_POST['title'];
  $description = $_POST['description'];

  $insertquery = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
  $iquery = mysqli_query($con,$insertquery);

  if($iquery){
    $insert = true;
  }
  else{
    echo "Could not insert successfully due to the error ".mysqli_error($con);
  }

}

/*---------------------Update---------------------------*/

if(isset($_POST['updatenote'])){

  $snof = $_POST['note_snou'];
  $title = $_POST['title'];
  $description =$_POST['description'];

  $updatequery = "UPDATE `notes` SET `title`='$title',`description`='$description' WHERE `sno`={$snof}";
  $uquery = mysqli_query($con,$updatequery);

  if($uquery){
    $update = true;
  }
  else{
    echo "Could not Update successfully due to the error ".mysqli_error($con);
  }

}

/*---------------------Delete---------------------------*/

if(isset($_POST['deletenote'])){

  $fsno = $_POST['note_snod'];

  $deletequery = "DELETE FROM `notes` WHERE `sno`={$fsno}";
  $dquery = mysqli_query($con,$deletequery);

  if($dquery){
    $delete = true;
  }
  else{
    echo "Could not Delete the note due to the error ".mysqli_error($con);
  }

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>iNotes | Notes taking made easy</title>
    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--favicon-->
    <link rel="shortcut icon" href="favicon.ico">
    <!--Data tables cdn css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
  </head>
  <body>

    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">iNotes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Contact</a>
            </li>
          </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
       </div>
      </div>
    </nav>
    <!--end of navbar-->

    <!--success or failure notification-->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
    </svg>
    <?php

    if($insert){
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <strong>Your note has been successfully inserted</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
    }

    if($update){
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <strong>Your note has been successfully Updated</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
    }

    if($delete){
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <strong>Your note has been successfully Deleted</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
    }

    ?>

    <!--end of success or failure notification-->

    <!--Add notes form-->
    <div class="container my-4">
      <h2>Add a Note</h2>
      <form action="index.php" method="POST">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="title" name="title" value="">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Note Description</label>
          <textarea class="form-control" id="description" name="description" value="" rows="3"></textarea>
        </div>
        <button type="submit" name="addnote" class="btn btn-primary">Add Note</button>
      </form>
    </div>
    <!--End of Add notes form-->

    <!--display table-->
    <div class="container my-4">
      <table id="table_id" class="table">
        <thead>
          <tr>
            <th scope="col">S.NO</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
       </thead>
       <tbody>
         <?php
         /*---------------------Display---------------------------*/

         $selectquery = "SELECT * FROM `notes`";
         $squery = mysqli_query($con,$selectquery);

         $nums = mysqli_num_rows($squery);

         $sno = 0;

         if($nums>0){
           while($res = mysqli_fetch_assoc($squery)){
             ?>
             <tr>
               <th scope="row"><?php echo ++$sno ?></th>
               <td><?php echo $res['title'] ?></td>
               <td><?php echo $res['description'] ?></td>
               <td>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update_modal<?php echo $res['sno']?>">Edit</button>
                  <!--Edit Modal + update-->
                    <div class="modal fade"  id="update_modal<?php echo $res['sno']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" >
                            <form action="index.php" method="POST">
                              <input type="hidden" name="note_snou" value="<?php echo $res['sno']?>"/>
                              <div class="mb-3">
                                <label for="title" class="form-label">Note Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $res['title'] ?>">
                              </div>
                             <div class="mb-3">
                                <label for="description" class="form-label">Note Description</label>
                                <textarea class="form-control mb-3" id="description" name="description"rows="3"><?php echo $res['description'] ?></textarea>
                                <button type="submit" name="updatenote" class="btn btn-primary">Save Changes</button>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <!--End of Edit Modal + update-->
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete_modal<?php echo $res['sno']?>">Delete</button>
                 <!--Delete Modal-->
                    <div class="modal fade" id="delete_modal<?php echo $res['sno']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                           Are you sure You want to delete the note?
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <form method="POST" action="index.php">
                             <input type="hidden" name="note_snod" value="<?php echo $res['sno']?>"/>
                             <button type="submit" name="deletenote" class="btn btn-primary">Confirm</button></button>
                           </form>
                         </div>
                       </div>
                     </div>
                   </div>
                 <!--End of Delete Modal-->
               </td>
             </tr>
             <?php
           }
         }
         ?>
       </tbody>
      </table>
    </div>
    <!--end of display table-->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  <!--Data tables cdn Jquery-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#table_id').DataTable();
   });
  </script>

  </body>
</html>
