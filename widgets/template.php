<?php include 'includes/config.php'?>
<?php get_header()?>
<section class="page-section about-heading">
      <div class="container">
        <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="images/<?=$ctaImage?>" alt="">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <span class="section-heading-upper"><?=$ctaHeading1?></span>
                  <span class="section-heading-lower"><?=$ctaHeading2?></span>
                </h2>
                <p><?=$ctaText?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<?php get_footer()?>