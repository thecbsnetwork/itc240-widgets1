<?php 
include 'includes/config.php';
require 'includes/Pager.php'; #allows pagination
#SQL statement
$sql = "select * from inspiration";
#end config area
get_header();
    echo '<section class="page-section cta">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">
              <h2 class="section-heading mb-5">
                <span class="section-heading-upper">Inspiration</span>
                <span class="section-heading-lower">Has Several Forms</span>
              </h2>';

$prev = '<img src="images/arrow_prev.gif" border="0" />';
$next = '<img src="images/arrow_next.gif" border="0" />';

//we connect to the db here
$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));

#Create instance of new 'pager' class
$myPager = new Pager(2,'',$prev,$next,'');
$sql = $myPager->loadSQL($sql,$iConn); #load SQL, pass in existing connection, add offset
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));

if(mysqli_num_rows($result) > 0)
{#records exist - process
    echo $myPager->showNAV();//show pager if enough records
    if($myPager->showTotal()==1){$itemz = "inspiration";}else{$itemz = "inspirations";}//deal with plural
    echo '<h4 align="center">There are ' . $myPager->showTotal() . ' ' . $itemz . '.</h4><br />';
    while($row = mysqli_fetch_assoc($result))
    {
        echo '<h5>See the inspiration for:</h5><a href="inspiration_view.php?id=' . $row['picID'] . '"><blockquote>' . $row['quotation'] . '</blockquote></a><br /><br />';
    }  
    echo $myPager->showNAV();//show pager if enough records

}else{//inform there are no records
    echo '<h5>There is no inspiration.</h5>';
}

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

        echo '
            </div>
          </div>
        </div>
      </div>
    </section>';?>
<?php get_footer()?>