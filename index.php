<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$calFeed = file_get_contents('https://www.google.com/calendar/feeds/6m1mp10rru9iq2i7rt035m5c9k%40group.calendar.google.com/public/full?alt=json&max-results=100');
$calFeed = json_decode($calFeed, true);
$entries = $calFeed['feed']['entry'];
?>
<?php
foreach ($entries as $entry) {

	$title = $entry['title']['$t'];

	$content = $entry['content']['$t'];

	$startTime = new DateTime($entry['gd$when'][0]['startTime']);
	$startTime = $startTime->format('F dS, h:ia');

	$endTime = new DateTime($entry['gd$when'][0]['endTime']);
	$endTime = $endTime->format('F dS, h:ia');

	$where = $entry['gd$where'][0]['valueString'];
?>
<pre><?php //print_r($entry); ?></pre>
<h1><?php echo $title;?></h1>
<h2><?php echo $startTime;?></h2>
<h3><?php echo $endTime;?></h3>
<p><b><?php echo $where;?></b></p>
<p><?php  echo $content;?></p>

<?php }?>