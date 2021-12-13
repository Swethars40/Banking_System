<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Basic Banking System</title>
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/408abd3df2.js" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP & JAVASCRIPT -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">
  </head>

  <body style="background-image: url('images/user_img.jpg'); background-repeat: no-repeat;">
    <?php
      include("navbar.php");
      include("database.php");
    ?>
    <h1 class="top-header">User  Details</h1>
    <center>
      <div class="user_transaction_history">
        <table class="table table-bordered" style="background-color:white; width:60%;" align="center"  cellpadding="6" cellspacing="4" width="50%">
          <thead class="table-dark" align="center">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Balance</th>
              <th>Transfer Money</th>
            </tr>
          </thead class="table-light">
          <tbody align="center">
            <?php
              $rs=mysqli_query($con,"select *from user_details");
              if(mysqli_num_rows($rs)>0)
              {
                while($row=mysqli_fetch_assoc($rs))
                {
                  $Name = $row['name'];
                  $Email = $row['email'];
                  $Balance = $row['balance'];

                  echo '<tr>';
                    echo '<td>'.$Name.'</td>';
                    echo '<td>'.$Email.'</td>';
                    echo '<td>'.$Balance.'</td>';
                    echo "<td> <a href='transfer_money.php?id=$Name'> <button class='btn' style='background-color:#16A596; color:white; font-weight:bold;'>Transact <i class='fas fa-comment-dollar'></i></button> </a></td>";
                  echo '</tr>';
                }
              }
              ?>
          </tbody>
        </table>
      </div>
    </center>
  </body>
</html>
