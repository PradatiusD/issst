<head>
	<link rel="stylesheet" href="issst/style.css">
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/datejs/build/date.js"></script>
</head>
<body>
	
	<?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);

	$calFeed = file_get_contents('https://www.google.com/calendar/feeds/6m1mp10rru9iq2i7rt035m5c9k%40group.calendar.google.com/public/full?alt=json&max-results=100');
	$calFeed = json_decode($calFeed, true);
	$entries = $calFeed['feed']['entry'];
	$timecomparer = null;

	function compare_time($a, $b) { 
	    if($a['gd$when'][0]['startTime'] == $b['gd$when'][0]['startTime']) {
	        return 0 ;
	    } 
	  return ($a['gd$when'][0]['startTime'] < $b['gd$when'][0]['startTime']) ? -1 : 1;
	} 

	usort($entries, 'compare_time');
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

				$startTimeDay = $startTime->format('l, F dS');

				$startTime = $startTime->format('h:ia');

				$endTime = new DateTime($entry['gd$when'][0]['endTime']);
				$endTime = $endTime->format('h:ia');

				$where = $entry['gd$where'][0]['valueString'];


				if ($timecomparer == null) {

					echo "<tr data-time=\"$startTimeData\" data-day=\"$startTimeDay\"><td class=\"text-center\">$startTime to $endTime</td>\n\t\t<td>";

				}
				else if ($timecomparer == $startTimeData) {
					echo "<td>";

				} else {
					echo "\t<tr data-time=\"$startTimeData\" data-day=\"$startTimeDay\"><td class=\"text-center\">$startTime to $endTime</td>\n\t\t<td>";
				}


			?>
					
					<h4><?php   echo $title;?></h4>
					<p><b><?php echo $where;?></b></p>
					<p><?php    echo $content;?></p>

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

		function fixLongTable ($selector) {

			console.log($selector);
			var htm = "";
			for (var i = 0; i < $selector.length; i++) {
				var innerData =  $selector[i].innerHTML;
				htm += "<div class=\"table-stacked-div bg-"+$selector[i].className+"\">" + innerData +"</div>";
			};

			htm = "<td colspan=\"4\">" + htm + "</td>";

			console.log(htm);
			$tds.eq(0).after(htm);
			$selector.remove();
		}

		// // This component adds css classes depending on the format

		$trs = $('#gCal').find('tr');

		$trs.each(function(){

			$tds = $(this).find('td');

			$columnsInRow = $tds.length;

			switch ($columnsInRow) {
				case 2:
					$tds.eq(1).attr('colspan', 5).addClass('text-center');
				break;
				case 3:
					$tds.eq(1).attr('colspan', 2);
					$tds.eq(2).attr('colspan', 1);
				break;
				case 4:
					$tds.attr('colspan', 1);
					$tds.eq(1).addClass('success');
					$tds.eq(2).addClass('warning');
					$tds.eq(3).addClass('info');
				break;
				case 5:
					$tds.attr('colspan', 1);
					$tds.eq(1).addClass('success');
					$tds.eq(2).addClass('warning');
					$tds.eq(3).addClass('info');
					$tds.eq(4).addClass('danger');
					fixLongTable($tds.not(':first'));
				break;
				case 6:

					$tds.eq(1).addClass('success');
					$tds.eq(2).addClass('warning');
					$tds.eq(3).addClass('info');
					$tds.eq(4).addClass('danger');
					fixLongTable($tds.not(':first'));
				break;
			}

		});

		// // This sorts them into chronological order

		// var $sortedTrs = $trs.sort(function (a, b) {

		// 	var contentA = $(a).attr('data-time');
		// 	var contentB = $(b).attr('data-time');
		// 	return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
		// });

		// $trs.remove();
		// $sortedTrs.appendTo('table');

		var tempDate = null;

		$trs.each(function(){

			var date = new Date($(this).attr('data-time'))

			date = date.getOrdinalNumber();

			if (tempDate === null || tempDate !== date) {
				var dayString = $(this).attr('data-day');
				$(this).before('<tr><td colspan="4"><h2>'+dayString+'</td></tr>');
				console.log(date);
			};

			tempDate = date;

		});



	})(jQuery);
</script>

</body>
