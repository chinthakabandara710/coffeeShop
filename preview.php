<?php $customer = $_GET['cus'] ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Lover</title>
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/60aa556cea.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/60aa556cea.css" crossorigin="anonymous">
    <script language="javascript">
        function Clickheretoprint() {
            var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
            disp_setting += "scrollbars=yes,width=800, height=400, left=100, top=25";
            var content_vlue = document.getElementById("content").innerHTML;

            var docprint = window.open("", "", disp_setting);
            docprint.document.open();
            docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');
            docprint.document.write(content_vlue);
            docprint.document.close();
            docprint.focus();
        }
    </script>
</head>
<?php
function createRandomPassword()
{
    $chars = "003232303232023232023456789";
    srand((float)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;
    }
    return $pass;
}
$finalcode = 'N-' . createRandomPassword();
?>

<body>

    <div class="container-fluid">
        <div class="responce">
            <h1>Thank you !</h1>
            <div class='alert alert-success' alert-dismissible fade show role='alert'>
                <p>Your order has been placed !</p>
            </div>
        </div>

        <a href="./cart.php?invoice=<?php echo $finalcode ?>&name=<?php echo $customer ?>"><button class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back to Menu</button></a>



        <div class="content" id="content">
            <div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
                <div style="width: 100%; height: 190px;">
                    <div style="width: 900px; float: left;">
                        <center>
                            <div style="font:bold 28px 'Calibri';"> SALES RECEIPT</div> <br> <br>
                            Coffee Lover<br>

                            No:888, katugasthota road, Kandy <br> <br>
                        </center>
                        <div>

                        </div>
                    </div>
                    <div style="width: 136px; float: left; height: 70px;">
                        <table cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">

                            <tr>
                                <td>OR No. :</td>
                                <td><?php echo $_GET['invoice'] ?></td>
                            </tr>
                            <tr>
                                <td>Date :</td>
                                <td><?php echo  date("Y/m/d");    ?></td>
                            </tr>
                        </table>

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div style="width: 100%; margin-top:-70px;">

                    <table border="1" cellpadding="4" class="table table-bordered" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">

                        <thead>
                            <tr>
                                <th> Product Name </th>
                                <th align="center"> Price </th>
                                <th align="center"> Qty </th>
                                <th align="center"> Amount </th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php

                            $id = $_GET['invoice'];

                            /* Database config */
                            $db_host        = 'localhost';
                            $db_user        = 'root';
                            $db_pass        = '';
                            $db_database    = 'coffeeshop';

                            /* End config */

                            $db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_database, $db_user, $db_pass);
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
                            $result->bindParam(':userid', $id);
                            $result->execute();
                            $total = 0;
                            $invoiceNum;
                            for ($i = 1; $row = $result->fetch(); $i++) {
                                $total = $total + $row['amount'];
                                $invoiceNum = $row['invoice'];



                            ?>
                                <tr class="record">
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td align="right"><?php echo $row['price']; ?></td>
                                    <td align="right"><?php echo $row['qty']; ?></td>
                                    <td align="right"><?php echo $row['amount']; ?></td>

                                </tr>
                            <?php
                            }





                            ?>
                            <tr>
                                <td colspan="3"> Total Amount: </td>

                                <td align="right"><?php echo   $total; ?></td>
                            </tr>
                        </tbody>



                    </table>

                </div>
            </div>



        </div>
        <div class="pull-right" style=" margin-right:250px; float:right;">
            <a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success btn-large"><i class="fa-solid fa-print"></i> Print the bill</button></a>
        </div>
    </div>
    <div style=" height:50px;" class="m-5"></div>



</body>

</html>