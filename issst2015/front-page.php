<?php get_header(); ?>

<section class="container">
  <div class="row">
    <div class="col-md-12">
      <img src="<?php echo get_stylesheet_directory_uri()."/img/issst-2015-header.png";?>" class="img-responsive header-img">
      <a href="https://www.regonline.com/Register/Checkin.aspx?EventID=1594278" target="_blank" class="register-now">
        Register Now
      </a>   
    </div>

    <aside class="cloudWrap invisible">
      <div ng-controller="CloudsController">
        <div ng-repeat="cloud in clouds">
          <div cloud-flying></div>        
        </div>
      </div> 
    </aside>
  </div>

</section>

<div class="homeBlue">
  <section class="container">

    <div class="row">
      <div class="col-md-12 text-center">
        <p class="h1">Get the Conference App</p>
        <p class="h4">Choose Your Platform</p>
        <a href="https://guidebook.com/g/ISSST2015/" class="guidebook-icon"><i class="fa fa-android"></i></a>
        <a href="https://guidebook.com/g/ISSST2015/" class="guidebook-icon"><i class="fa fa-apple"></i></a>
        <a href="https://guidebook.com/guide/36858/" class="guidebook-icon"><i class="fa fa-laptop"></i></a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">


        <!-- Our team listing -->
        <p class="h1 text-center">Our Team</p>
        <section class="conference-committee invisible" id="container">
          
          <?php
          
            $args = array (
              'post_type' => '2015-team',
              'post_status' => 'publish',
              'nopaging'=> true
            );
            
            $wp_query = new WP_Query($args);

            $j = 0;

            if ( $wp_query->have_posts() ):

              while ( $wp_query->have_posts() ) : $wp_query->the_post();
                $custom = get_post_custom($post->ID);
          ?>

                <article class="item item-<?php echo $j;?>">
                  <div>
                    <h1><?php the_title();?></h1>
                    <?php echo $custom["wpcf-org-title"][0];?>                
                  </div>
                  <?php the_post_thumbnail(array(160, 160));?>
                </article>

                <aside class="item item-<?php echo $j;?>">
                  <?php
                    $member_institution = $custom["wpcf-institution-logo"][0];
                    echo "<img src='$member_institution'/>";
                  ?>
                </aside>
          <?php
            $j++;
            endwhile;
          else:
            echo '<h2>No Team Members found/h2>';
          endif;
          ?>
          
        </section>
        <br>
      </div>
    </div>
    <div class="row">

      <!-- Windmills -->
    <style>
      .fan-holder {
          position: relative;
          display: inline-block;
      }

      .pole, .blades {
        width: 100%;
        height: auto;
      }

      .blades {
          position: absolute;
      }

      .spinny {
        -webkit-animation-name: spin;
        -webkit-animation-duration: 2000ms;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;
        -moz-animation-name: spin;
        -moz-animation-duration: 2000ms;
        -moz-animation-iteration-count: infinite;
        -moz-animation-timing-function: linear;
        -ms-animation-name: spin;
        -ms-animation-duration: 2000ms;
        -ms-animation-iteration-count: infinite;
        -ms-animation-timing-function: linear;
        
        animation-name: spin;
        animation-duration: 2000ms;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
      }

      @-ms-keyframes spin {
          from { -ms-transform: rotate(0deg); }
          to { -ms-transform: rotate(360deg); }
      }
      @-moz-keyframes spin {
          from { -moz-transform: rotate(0deg); }
          to { -moz-transform: rotate(360deg); }
      }
      @-webkit-keyframes spin {
          from { -webkit-transform: rotate(0deg); }
          to { -webkit-transform: rotate(360deg); }
      }
      @keyframes spin {
          from {
              transform:rotate(0deg);
          }
          to {
              transform:rotate(360deg);
          }
      }
      </style>
      <div ng-controller="fanController" class="col-md-7">
        <span ng-repeat="fan in fans">
          <span spinning-fan></span>
        </span>
      </div> 

      <!-- End Windmills -->
      <!-- Begin Twitter Feed -->
      <div class="col-md-5">
        <?php twitter_feed();?>      
      </div>
      <!-- End Twitter Feed -->
    </div>
  </section>
</div>

<style>
  html {
    margin-top: 0 !important;
  }
</style>
<?php get_footer(); ?>