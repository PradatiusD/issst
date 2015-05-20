<?php

function get_start_timestamp($post_id) {
  $meta = get_post_meta($post_id);
  $start_timestamp = $meta['wpcf-event-start-time'][0];
  return $start_timestamp;
}

function split_posts_by_day_of_start_time($posts) {
  
  $program = array();

  for ($i=0; $i < count($posts); $i++) {
    $post = $posts[$i];

    $start_time = get_start_timestamp($post->ID);

    $day = strtotime("midnight", $start_time);
    $day_exists = array_key_exists($day, $program);

    if ($day_exists) {
      $program[$day][] = $post;
    } else {
      $program[$day] = array($post);
    }
  }

  return $program;
}

function format_time_into_human_readable_hour_time($timestamp) {
  $timestring = date('g:ia', $timestamp);
  $timestring = str_replace(':00', '', $timestring);
  return $timestring;
}


function remove_redundant_am_pm ($timestring) {
  preg_match_all('(am|pm)', $timestring, $matches);
  if ($matches[0][0] == $matches[0][1]) {
    $timestring =  preg_replace('(am|pm)', '', $timestring, 1);
  }
  return $timestring;
}


function display_event_of_day($day) {

  ob_start();
    foreach ($day as $event) {

      $event_id = $event->ID;
      $meta = get_post_meta($event_id);

      $start_timestamp = $meta['wpcf-event-start-time'][0];
      $start_time = format_time_into_human_readable_hour_time($start_timestamp);

      $end_timestamp = $meta['wpcf-event-end-time'][0];
      $end_time = format_time_into_human_readable_hour_time($end_timestamp);


      $time = remove_redundant_am_pm($start_time . "–" . $end_time);

      $title = get_the_title($event_id);
      $authors = $event->post_content;
      $location = $meta['wpcf-event-location'][0];

      $track_name = wp_get_post_terms($event_id, 'event-track');
      $track_name = $track_name[0]->name;

      $paper_link = $meta['wpcf-paper-pdf-link'][0];

      $post_terms = wp_get_post_terms( $event_id, 'topic');
      $taxonomy = $post_terms[0]->name;
      $icon = $post_terms[0]->description;

      ?>

      <tr class="track-<?php echo $track_name;?>">
        <td data-start-time="<?php echo $start_timestamp;?>" data-end-time="<?php echo $end_timestamp;?>">
          <?php echo $time;?>
          <aside class="hidden">
            <div class="text-center">
              <i class="fa fa-<?php echo $icon;?>"></i>
            </div>
            <p class="h3" style="margin-top: 0.5em;"><?php echo $taxonomy;?></p>
            <p class="h5">Track <?php echo $track_name;?></p>
          </aside>
        </td>
        <td>
          <a class="h4" style="color: rgba(255, 255, 255, 0.8);" href="<?php echo $paper_link;?>" target="_blank">
          <?php echo $title;?>
          </a>
          <br>
          <small style="color:rgba(255, 255, 255, 0.61);"><?php echo $authors;?></small>
        </td>
        <td><?php echo $location;?></td>
      </tr>
      <?php
    }
  ?>
  <?php
  echo ob_get_clean();
}


function program_calendar() {

  $args = array(
    'post_type' => 'program',
    'meta_key'  => 'wpcf-event-start-time',
    'orderby'   => 'meta_value_num',
    'order'     => 'ASC',
    'posts_per_page' => -1
  );

  $program_query = new WP_Query($args);
  $posts = $program_query->posts;

  $program = split_posts_by_day_of_start_time($posts);

  ob_start();
  ?>

  <!-- Begin Custom Events Calendar -->

  <p class="h1 text-center">ISSST 2015 Program</p>

  <?php foreach ($program as $day =>$value): ?>
    <p class="h2 text-center"><?php echo date('l F j', $day);?></p>

    <table class="table issst-2015-program">
      <col style="width:15%">
      <col style="width:75%">
      <col style="width:15%">
      <thead>
        <th>Time</th>
        <th>Talk Title</th>
        <th>Location</th>        
      </thead>

      <tbody>
        <?php display_event_of_day($program[$day]);?>      
      </tbody>
    </table>
  <?php endforeach; ?>

  <!-- End Custom Events Calendar -->

  <?php
  echo ob_get_clean();
  wp_enqueue_script('calendar-formatter',  get_stylesheet_directory_uri()."/js/calendar-formatter.js", array('jquery'), '1.0.0', $true);
}