<?php
//customer_view.php - shows details of a single customer
?>
<?php include 'includes/config.php';?>
<?php

//process querystring here
if(isset($_GET['id']))
{//process data
    //cast the data to an integer, for security purposes
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:inspiration.php');
}

$sql = "select * from inspiration where picID = $id";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        $quotation = stripslashes($row['quotation']);
        $citation = stripslashes($row['citation']);
        $Feedback = '';//no feedback necessary
    }    

}else{//inform there are no records
    $Feedback = '<p>This inspiration does not exist!</p>';
}

?>
<?php get_header()?>
<?php
echo '<section class="page-section cta">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">
              <h2 class="section-heading mb-5">
                <span class="section-heading-upper">Inspiration</span>
                <span class="section-heading-lower">Has Several Forms</span>
              </h2>';    
    
if($Feedback == '')
{//data exists, show it

    echo '<div>';
    echo '<img src="uploads/goats-kittens/goatkitten-' . $id . '.jpg" /><br />';
    echo '<blockquote>' . $quotation . '</blockquote>';
    echo '<cite>' . $citation . '</cite><br />';
    echo '</div><br />'; 
    
}else{//warn user no data
    echo $Feedback;
}    

echo '<h2><a href="inspiration.php">Go Back</a></h2>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);
    echo '
            </div>
          </div>
        </div>
      </div>
    </section>';
?>
<?php get_footer()?>