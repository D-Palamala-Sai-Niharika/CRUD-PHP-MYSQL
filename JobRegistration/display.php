<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Select | Display</title>
    <?php include 'links.php'; ?>
    <link rel="stylesheet" href="css/display.css">
  </head>
  <body>
    <section class="display-form">
      <h4 class="text-center m-4">List of Candidates Applied for Web Developer Post</h4>
      <div class="container rounded bg-center pt-3 pb-3 ps-0 pe-0">
        <div class="table-responsive rounded table-decoration table-bordered">
          <table class="table text-center">
            <thead>
              <tr>
                <th class="p-3">ID</th>
                <th class="p-3">NAME</th>
                <th class="p-3">DEGREE</th>
                <th class="p-3">MOBILE</th>
                <th class="p-3">EMAIL</th>
                <th class="p-3">REFER</th>
                <th class="p-3">POST</th>
                <th colspan="2" scope="col" class="p-3">OPERATIONS</th>
              </tr>
            </thead>
            <tbody>

              <?php

              include 'connection.php';

              $selectquery = "SELECT * FROM jobregistration";
              $mainquery = mysqli_query($con,$selectquery);
              $num = mysqli_num_rows($mainquery);

              while($res = mysqli_fetch_array($mainquery)){
                ?>

                <tr>
                  <td class="p-3"><?php echo $res['id'] ?></td>
                  <td class="p-3"><?php echo $res['name'] ?></td>
                  <td class="p-3"><?php echo $res['degree'] ?></td>
                  <td class="p-3"><?php echo $res['mobile'] ?></td>
                  <td class="p-3"><span class="email-style"><?php echo $res['email'] ?></span></td>
                  <td class="p-3"><?php echo $res['refer'] ?></td>
                  <td class="p-3"><?php echo $res['jobpost'] ?></td>
                  <td class="p-3"><a href="update.php?id=<?php echo $res['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="UPDATE"><i class="fas fa-edit edit-icon"></i></a></td>
                  <td class="p-3"><a href="delete.php?idv=<?php echo $res['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="DELETE"><i class="fas fa-trash-alt trash-icon"></i></a></td>
                </tr>

                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    </script>
  </body>
</html>
