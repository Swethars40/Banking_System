<?php
include("database.php");

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['receiver'];
    $t_amount = $_POST['amount'];


    $query = mysqli_query($con,"SELECT * from user_details where name='$from'");
    if(mysqli_num_rows($query)>0)
    {
      while($sql1=mysqli_fetch_array($query))
      {
        $sender = $sql1['name'];
        $s_bal = $sql1['balance'];
      } // returns array or output of user from which the amount is to be transferred.
    }

    $query = mysqli_query($con,"SELECT * from user_details where name='$to'");
    if(mysqli_num_rows($query)>0)
    {
      while($sql2=mysqli_fetch_array($query))
      {
        $receiver = $sql2['name'];
        $r_bal = $sql2['balance'];
      }
    }


  //balance checking
    // constraint to check input of negative value by user
    if (($t_amount)<0)
   {
      echo '<script type="text/javascript">';
      echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
      echo '</script>';
    }

    // constraint to check insufficient balance.
    else if($t_amount > $s_bal)
    {
      echo '<script type="text/javascript">';
      echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
      echo '</script>';
    }


    // constraint to check zero values
    else if($t_amount == 0)
    {
      echo "<script type='text/javascript'>";
      echo "alert('Oops! Zero value cannot be transferred')";
      echo "</script>";
    }


    else
    {
      // deducting amount from sender's account
        $s_newbalance = $s_bal - $t_amount;
        $sql = "UPDATE user_details set balance='$s_newbalance' where name='$from'";
        mysqli_query($con,$sql);


      // adding amount to reciever's account
        $r_newbalance = $r_bal + $t_amount;
        $sql = "UPDATE user_details set balance='$r_newbalance' where name='$to'";
        mysqli_query($con,$sql);


        $sql = "INSERT INTO transaction(`sender`, `receiver`, `amount_transfered`, `balance`) VALUES ('$sender','$receiver','$t_amount','$s_newbalance')";
        $query=mysqli_query($con,$sql);

        if($query)
        {
          echo "<script> alert('Transaction Successful');
                  window.location='transaction_history.php';
                </script>";

        }

        $newbalance= 0;
        $amount =0;
    }

  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
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
  <body style="background-image: url('images/money_transfer_img.jpg'); background-repeat: no-repeat;">
    <?php
      include("navbar.php");
      include("database.php");
    ?>

    <h1 class="top-header">Enter the Details to Transfer Money</h1>


    <div class="">
      <center>
        <table class="table table-bordered" style="background-color:#FFFCDC; width: 70%;"
            align="center"  cellpadding="6" cellspacing="4" width="50%">
          <thead class="table-dark" align="center">
            <tr>
              <th>Sender</th>
              <th>Email ID</th>
              <th>Balance</th>
            </tr>
          </thead>

          <tbody align="center">
            <?php
              $id1 = $_GET['id'];

              $rs=mysqli_query($con, "select * from user_details where name='$id1'");
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
                  echo '</tr>';
                }
              }
            ?>
          </tbody>
        </table>
      </center>
    </div>

    <br>

    <div class="">
      <form method="post" class="form1">
        <label style="font-size:30px;font-weight:bold;color:#9A0680;padding-left:170px;float:left">Transfer To:</label>
        <br><br>
        <center>
          <select style="width:70%;" name="receiver" class="form-control" required>
            <option style="background-color:purple" value="" disabled selected>Choose</option>
            <?php
              include 'database.php';
              $sid = $_GET['id'];
                $sql = "SELECT * FROM user_details where name!='$sid'";
                $result=mysqli_query($con,$sql);

                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['name'];?>" >

                  <?php echo $rows['name'] ;?> (Balance:
                  <?php echo $rows['balance'] ;?> )

                </option>
              <?php
                  }
              ?>
          </select>
      </center>

        <br>
        <label style="font-size:30px;font-weight:bolder;color:#9A0680;padding-left:170px;float:left;">Amount:</label>
          <br><br>
          <center>
            <input style="width:70%;" type="number" class="form-control" name="amount" placeholder="required">
          <br>
            <button id="btn_submit" class="btn btn-success btn-lg" type="submit" name="submit" value="submit">Transfer</button>
          </center>
      </form>
    </div>
  </body>
</html>
