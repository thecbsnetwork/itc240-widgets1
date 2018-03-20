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

    echo '<section class="page-section about-heading">
      <div class="container">
        <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="uploads/inspiration' . $id . '.jpg" alt="">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <blockquote>' . $quotation . '</blockquote>';
    echo '<cite>' . $citation . '</cite></h2>';
    echo '</div>
            </div>
          </div>
        </div>
      </div>
    </section>'; 
    
    if(startSession() &&
    isset($_SESSION["AdminID"]))
    {#only admins can see 'peek a boo' link:
        echo '<br /><h4 align="center"><a href="' . $config->virtual_path . '/upload_form.php?' . $_SERVER['QUERY_STRING'];
        echo '&thumbWidth=200';
        echo '">UPLOAD IMAGE</a></h4>';
    
        /*
        # if you wish to overwrite any of these options on the view page, 
        # you may uncomment this area, and provide different parameters:						
        echo '<div align="center"><a href="' . VIRTUAL_PATH . 'upload_form.php?' . $_SERVER['QUERY_STRING']; 
        echo '&imagePrefix=customer';
        echo '&uploadFolder=upload/';
        echo '&extension=.jpg';
        echo '&createThumb=TRUE';
        echo '&thumbWidth=50';
        echo '&thumbSuffix=_thumb';
        echo '&sizeBytes=100000';
        echo '">UPLOAD IMAGE</a></div>';
        */	
    }
    if(isset($_GET['msg']))
    {#msg on querystring implies we're back from uploading new image
        $msgSeconds = (int)$_GET['msg'];
        $currSeconds = time();
        if(($msgSeconds + 2)> $currSeconds)
        {//link only visible once, due to time comparison of qstring data to current timestamp
            echo '<p align="center"><script type="text/javascript">';
            echo 'document.write("<from><input type=button value=\'IMAGE UPLOADED! CLICK TO REFRESH PAGE\' onClick=history.go()></form>")</scr';
            echo 'ipt></p>';
        }
    }
    
    echo '</p>';    
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