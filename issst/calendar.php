<?php
/*
Template Name: Google Calendar Template
*/

?>

<?php get_header(); ?>

	<div class="container">
		<div class="row">

			<main class="col-md-12">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

						<?php the_content('Read more...'); ?>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

			</main>
		</div>
	</div>
		
		<?php
		// error_reporting(E_ALL);
		// ini_set('display_errors', 1);

		$calFeed = file_get_contents('https://www.google.com/calendar/feeds/6m1mp10rru9iq2i7rt035m5c9k%40group.calendar.google.com/public/full?alt=json&max-results=100');
		$calFeed = json_decode($calFeed, true);
		$entries = $calFeed['feed']['entry'];
		$timecomparer = null;
		?>

	<section class="container">
		<div class="col-md-12">
			<table class="table table-striped" id="gCal">
				<?php
				foreach ($entries as $entry):

					$title = $entry['title']['$t'];

					$content = $entry['content']['$t'];

					$startTimeData = $entry['gd$when'][0]['startTime'];

					$startTime = new DateTime($entry['gd$when'][0]['startTime']);

					$startTime = $startTime->format('F dS, h:ia');

					$endTime = new DateTime($entry['gd$when'][0]['endTime']);
					$endTime = $endTime->format('h:ia');

					$where = $entry['gd$where'][0]['valueString'];


					if ($timecomparer == null) {
						echo "<tr><td style=\"width: 121px\">$startTime - $endTime</td>\n\t\t<td>";
					}
					else if ($timecomparer == $startTimeData) {
						echo "<td>";

					} else {
						echo "\t<tr><td style=\"width: 121px\">$startTime - $endTime</td>\n\t\t<td>";
					}


				?>
						
						<h4><?php echo $title;?></h4>
						<p><b><?php echo $where;?></b></p>
						<p><?php  echo $content;?></p>

				<?php  

					$timecomparer = $startTimeData;

					if ($timecomparer == $startTimeData) {
						echo"\t</td>";
					} else {
						echo"\t</td>\n\t</tr>\n";
					}

					endforeach;
				?>

			</table>
		</div>
	</section>
	<script>
		(function($){

			$trs = $('#gCal').find('tr');

			$trs.each(function(){

				$tds = $(this).find('td');

				$columnsInRow = $tds.length;

				switch ($columnsInRow) {
					case 2:
						$tds.eq(1).attr('colspan', 3).addClass('text-center');
					break;
					case 3:
						$tds.eq(1).addClass('success');
						$tds.eq(2).addClass('warning');
					break;
					case 4:
						$tds.attr('colspan', 1);
						$tds.eq(1).addClass('success');
						$tds.eq(2).addClass('warning');
						$tds.eq(3).addClass('info');
					break;
				}

			});


		})(jQuery);
	</script>

	<div class="container">
		<div class="row">
			<section class="col-md-12 commentlist">
				<?php comments_template( '/comments.php' ) ?>
			</section>
		</div>
	</div>

<?php get_footer(); ?>