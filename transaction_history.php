<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Basic Banking System</title>
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&display=swap" rel="stylesheet">
    <!-- BOOTSTRAP & JAVASCRIPT -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body  style="background-image: url('images/trans-history_img.jpg'); background-repeat: no-repeat;">
    <?php
      include("navbar.php");
      include("database.php");
    ?>

    <h1 class="top-header head1"> Transaction History </h1>
    <div class="user_transaction_history">
      <table class="table table-bordered" style="width:60%; background-color:#FFFCDC;" align="center" cellpadding="4" cellspacing="4" width="50%">
        <thead class="table-dark">
          <tr>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Amount Transfered</th>
            <th>Balance</th>
          </tr>
        </thead>

        <tbody>
          <?php

            $rs=mysqli_query($con,"select *from transaction");
            if(mysqli_num_rows($rs)>0)
            {
              while($row=mysqli_fetch_assoc($rs))
              {
                $Sender = $row['sender'];
                $Receiver = $row['receiver'];
                $Amount = $row['amount_transfered'];
                $Balance = $row['balance'];

                echo '<tr>';
                  echo '<td>'.$Sender.'</td>';
                  echo '<td>'.$Receiver.'</td>';
                  echo '<td>'.$Amount.'</td>';
                  echo '<td>'.$Balance.'</td>';
                echo '</tr>';
              }
            }
          ?>
        </tbody>
      </table>
    </div>

  </body>
</html>
