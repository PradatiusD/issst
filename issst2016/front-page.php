<?php

function homepage_header (){
  ?>
  <section class="conference-header">
    <div class="arizona-state">
      <article>
        <h1>ISSST 2016</h1>
        <h3>17-19 May in Phoenix, AZ</h3>
        <address>
          <strong>Rennaisance Hotel</strong><br>
          50 E Adams St, Phoenix, AZ 85004
        </address>
      </article>        
    </div>
  </section>
  <?php
}

function call_for_papers () {
  ?>
  <section class="call-for-papers">
    <div class="container">

      <div class="row">
        <aside class="col-md-3">
          <i class="ion-earth"></i>
        </aside>
        <article class="col-md-9" style="font-size:1.3em;">
          <p class="h1">Call for Contributions</p>
          <p class="lead"> Please submit abstracts for presentations, posters, papers, panels and workshops describing research, applications, tools, and case studies.</p>
          <p>Students are especially encouraged to attend and to participate in student paper and poster competitions with monetary awards, judged by leading academics and researchers.</p>
          <p class="h3">Submit Abstract</p>
          <p>Abstracts should be about <strong>500 words</strong> and will be reviewed relative to 3 criteria:</p>
          <ol>
            <li>Originality.</li>
            <li>Relevance.</li>
            <li>Results.</li>
          </ol>

          <p class="text-center" style="margin-bottom:3em;">
            <a class="btn btn-primary btn-lg" href="mailto:ISSSTNetwork@gmail.com" target="_blank">
              Contact ISSSTNetwork@gmail.com
            </a>
          </p>
        </article>
      </div>
    </div>
  </section>

  <?php
}







add_action('genesis_before_loop','homepage_header');
add_action('genesis_before_loop','call_for_papers');



remove_action( 'genesis_loop', 'genesis_do_loop');
add_filter('genesis_pre_get_option_site_layout','__genesis_return_full_width_content');


genesis();

?>