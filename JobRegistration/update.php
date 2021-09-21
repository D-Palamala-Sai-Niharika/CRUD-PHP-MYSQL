<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update</title>
    <?php include 'links.php'; ?>
  </head>
  <body>
    <section class="job-app-form">
      <div class="registration-form container p-5 rounded">
        <div class="row">
          <div class="col-md-3 register-left p-4 text-center">
            <h3>Hola, <img src="https://media.giphy.com/media/hvRJCLFzcasrR4ia7z/giphy.gif" width="30px">We're Hiring Web Developers!</h3>
            <img src="images/image.png" class="image m-4 rounded" alt="web-img" />
            <p class="m-3">
              Please fill all the details carefully.
            </p>
            <a href="display.php" class="check-form p-2">Check Form</a>
          </div>
          <div class="col-md-9 register-right p-5 ps-3">
            <h2 class="text-center mb-5">Apply for Web Developer Post</h2>
            <div class="app-form">
              <form action="" method="POST">
                <div class="row">
                  <?php

                  include 'connection.php';

                  $idf = $_GET['id'];

                  $showquery = "SELECT * FROM jobregistration WHERE id={$idf}";
                  $query = mysqli_query($con,$showquery);
                  $arrdata = mysqli_fetch_array($query);

                  if(isset($_POST['submit'])){

                    $idupdate = $_GET['id'];

                    $name=$_POST['name'];
                    $degree=$_POST['degree'];
                    $mobile=$_POST['mobile'];
                    $email=$_POST['email'];
                    $refer=$_POST['refer'];
                    $jobpost=$_POST['jobpost'];

                    //$insertquery = "INSERT INTO jobregistration (name,degree,mobile,email,refer,jobpost) VALUES ('$name','$degree','$mobile','$email','$refer','$jobpost')";
                    $updatequery = " UPDATE jobregistration SET name='$name' , degree='$degree' , mobile='$mobile' , email='$email' , refer='$refer' , jobpost='$jobpost' WHERE id=$idupdate";
                    $res = mysqli_query($con,$updatequery);

                    if($res){
                      ?>
                      <script>
                        alert("Data Updated Succsessfully😀!");
                      </script>
                      <?php
                    }
                    else{
                      ?>
                      <script>
                        alert("Data Not Updated Properly😌!");
                      </script>
                      <?php
                    }
                  }

                  ?>
                  <div class="col-md-6">
                    <input class="input-info m-3 p-2" type="text" name="name" placeholder="Enter your Name *" value="<?php echo $arrdata['name'] ?>" />
                    <input class="input-info m-3 p-2" type="text" name="mobile" placeholder="Mobile number *" value="<?php echo $arrdata['mobile'] ?>" />
                    <input class="input-info m-3 p-2" type="text" name="refer" placeholder="Any references *" value="<?php echo $arrdata['refer'] ?>" />
                  </div>
                  <div class="col-md-6">
                    <input class="input-info m-3 p-2" type="text" name="degree" placeholder="Enter your Qualification *" value="<?php echo $arrdata['degree'] ?>" />
                    <input class="input-info m-3 p-2" type="email" name="email" placeholder="Enter correct Email-id *" value="<?php echo $arrdata['email'] ?>" />
                    <input class="input-info m-3 p-2" type="text" name="jobpost" placeholder="Web Developer" value="<?php echo $arrdata['jobpost'] ?>" readonly/>
                    <input class="m-3 p-2 submit-form-btn" type="submit" name="submit" value="Update" />
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
