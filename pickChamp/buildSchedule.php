<!--
Copyright (c) <2015> < Alain Chen, James Barksdale, Khalen Fredieu, Colin Stevens, Nick Zewiski>


Permission is hereby granted, free of charge, to any person obtaining a copy of this software and 
associated documentation files (the "Software"), to deal in the Software without restriction, 
including without limitation the rights to use, copy, modify, merge, publish, distribute, 
sublicense, and/or sell copies of the Software, and to permit persons to whom 
the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies 
or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR 
PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->

<?php
require('includes/application_top.php');
error_reporting(E_ALL);
$weeks = 17;
$teamCodes = array(
	'JAC' => 'JAX'
);
$schedule = array();

for ($week = 1; $week <= $weeks; $week++) {
	$url = "http://www.nfl.com/ajax/scorestrip?season=".SEASON_YEAR."&seasonType=REG&week=".$week;
	if ($xmlData = @file_get_contents($url)) {
		$xml = simplexml_load_string($xmlData);
		$json = json_encode($xml);
		$games = json_decode($json, true);
	} else {
		die('Error getting schedule from nfl.com.');
	}

	//build scores array, to group teams and scores together in games
	foreach ($games['gms']['g'] as $gameArray) {
		$game = $gameArray['@attributes'];

		//get game time (eastern)
		$eid = $game['eid']; //date
		$t = $game['t']; //time
		$date = DateTime::createFromFormat('Ymds g:i a', $eid.' '.$t.' pm');
		$gameTimeEastern = $date->format('Y-m-d H:i:00');

		//get team codes
		$away_team = $game['v'];
		$home_team = $game['h'];
		foreach ($teamCodes as $espnCode => $nflpCode) {
			if ($away_team == $espnCode) $away_team = $nflpCode;
			if ($home_team == $espnCode) $home_team = $nflpCode;
		}

		$schedule[] = array(
			'weekNum' => $week,
			'gameTimeEastern' => $gameTimeEastern,
			'homeID' => $home_team,
			'visitorID' => $away_team
		);
	}
}

//output to excel
$output = '<table>'."\n".
	'<tr><td>weekNum</td><td>gameTimeEastern</td><td>homeID</td><td>visitorID</td></tr>'."\n";
for ($i = 0; $i < sizeof($schedule); $i++) {
	$output .= '<tr><td>'.$schedule[$i]['weekNum'].'</td><td>'.$schedule[$i]['gameTimeEastern'].'</td><td>'.$schedule[$i]['homeID'].'</td><td>'.$schedule[$i]['visitorID'].'</td></tr>'."\n";
}
$output .= '</table>';

// fix for IE catching or PHP bug issue
header("Pragma: public");
header("Expires: 0"); // set expiration time
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// browser must download file from server instead of cache

header('Content-Type: application/vnd.ms-excel;');
//header("Content-type: application/x-msexcel");
//header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=nfl_schedule_".SEASON_YEAR.".xls");

echo $output;
//echo '<pre>';
//print_r($schedule);
//echo '</pre>';
exit;
