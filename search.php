<?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = '';
  $db_db = 'biblioteca-laciba';

  $mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );
	
  if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
  }

  echo 'Success: A proper connection to MySQL was made.';
  echo '<br>';
  echo 'Host information: '.$mysqli->host_info;
  echo '<br>';
  echo 'Protocol version: '.$mysqli->protocol_version;



$sql = "SELECT * FROM libros";

$result = $mysqli->query($sql);

$mysqli->close();

include 'connect_test_db.php';
$searchErr = '';
$book_details='';
if(isset($_POST['save']))
{
    if(!empty($_POST['search']))
    {
        $search = $_POST['search'];
        $stmt = $con->prepare("select * from libros where titol like '%$search%' or autoria like '%$search%' or ISBN like '%$search%'");
        $stmt->execute();
        $book_details = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($book_details);
        
    }
    else
    {
        $searchErr = "Please enter the information";
    }
    
}
?>    

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>Album example · Bootstrap v5.2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .item-list {
        list-style:none;
      }
    </style>

    
  </head>
  <body>


    <h3 class= "text-center"><u>Search Result</u></h3><br/>
  
        <tbody>
                <?php
                 if(!$book_details)
                 {
                    echo '<tr>No data found</tr>';
                 }
                 else{
                    foreach($book_details as $key=>$value)
                    {
                        ?>
                        <div class="px-4 py-5 my-5 text-center">
                        <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                        <h1 class="display-5 fw-bold"><?php echo $value['titol'];?></h1>
                        <div class="col-lg-6 mx-auto">
                        <ul class="lead mb-4 item-list">
                            <li><?php echo $value['autoria'];?></li>
                            <li><?php echo $value['ISBN'];?></li>
                            <li><?php echo $value['descriptors'];?></li>
                        </ul>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
    
                        <?php
                    }
                     
                 }
                ?>
             
         </tbody>
      </table>
    </div>
<script src="jquery-3.2.1.min.js"></script>
<script src="bootstrap.min.js"></script>