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
require_once('includes/application_top.php');
require('includes/classes/team.php');

$activeTab = 'home';

include('includes/header.php');

if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	}

if ($user->isAdmin == 'T') {
?>
	<img src="images/art_holst_nfl.jpg" width="192" height="295" alt="ref" style="float: right; padding-left: 10px;" />
	<h1>Welcome, Admin!</h1>
	
<?php

;} else {
	if ($weekExpired) {
		//current week is expired, show message
		echo '	<div class="bg-warning">The current week is locked.  <a href="results.php">Check the Results &gt;&gt;</a></div>' . "\n";
	} else {
		//if all picks not submitted yet for current week
		$picks = getUserPicks($currentWeek, $user->userID);
		$gameTotal = getGameTotal($currentWeek);
		if (sizeof($picks) < $gameTotal) {
			echo '	<div class="bg-warning">You have NOT yet made all of your picks for week ' . $currentWeek . '.  <a href="entry_form.php">Make Your Picks &gt;&gt;</a></div>' . "\n";
		}
	}
	//include('includes/column_right.php');
?>
	<div class="row">
		<div class="col-md-4 col-xs-12 col-right">
<?php
include('includes/column_right.php');
?>
		</div>
		<div id="content" class="col-md-8 col-xs-12">
			<h3>Your Picks At A Glance:</h3>
	<?php
	$lastCompletedWeek = getLastCompletedWeek();

	$sql = "select s.weekNum, count(s.gameID) as gamesTotal,";
	$sql .= " min(s.gameTimeEastern) as firstGameTime,";
	$sql .= " (select gameTimeEastern from " . DB_PREFIX . "schedule where weekNum = s.weekNum and DATE_FORMAT(gameTimeEastern, '%W') = 'Sunday' order by gameTimeEastern limit 1) as cutoffTime,";
	$sql .= " (DATE_ADD(NOW(), INTERVAL " . SERVER_TIMEZONE_OFFSET . " HOUR) > (select gameTimeEastern from " . DB_PREFIX . "schedule where weekNum = s.weekNum and DATE_FORMAT(gameTimeEastern, '%W') = 'Sunday' order by gameTimeEastern limit 1)) as expired ";
	$sql .= "from " . DB_PREFIX . "schedule s ";
	$sql .= "group by s.weekNum ";
	$sql .= "order by s.weekNum;";
	$query = $mysqli->query($sql);
	$i = 0;
	$rowclass = '';
	while ($row = $query->fetch_assoc()) {
		//$rowclass = (($i % 2 == 0) ? ' class="altrow"' : '');
		echo '		<div class="row-week">' . "\n";
		echo '			<p><b>Week ' . $row['weekNum'] . '</b><br />' . "\n";
		echo '			First game: ' . date('n/j g:i a', strtotime($row['firstGameTime'])) . '<br />' . "\n";
		echo '			Cutoff: ' . date('n/j g:i a', strtotime($row['cutoffTime'])) . '</p>' . "\n";
		//echo '		</tr>'."\n";
		if ($row['expired']) {
			//if week is expired, show score (if scores are entered)
			if ($lastCompletedWeek >= (int)$row['weekNum']) {
				//scores entered, show score
				$weekTotal = getGameTotal($row['weekNum']);
				//get player score
				$userScore = getUserScore($row['weekNum'], $user->userID);
				echo '			<div class="bg-info"><b>Score: ' . $userScore . '/' . $weekTotal . ' (' . number_format(($userScore / $weekTotal) * 100, 2) . '%)</b><br /><a href="results.php?week='.$row['weekNum'].'">See Results &raquo;</a></div>' . "\n";
			} else {
				//scores not entered, show ???
				echo '			<div class="bg-info">Week is closed,</b> but scores have not yet been entered.<br /><a href="results.php?week='.$row['weekNum'].'">See Results &raquo;</a></div>' . "\n";
			}
		} else {
			//week is not expired yet, check to see if all picks have been entered
			$picks = getUserPicks($row['weekNum'], $user->userID);
			if (sizeof($picks) < (int)$row['gamesTotal']) {
				//not all picks were entered
				$tmpStyle = '';
				if ((int)$currentWeek == (int)$row['weekNum']) {
					//only show in red if this is the current week
					$tmpStyle = ' style="color: red;"';
				}
				echo '			<div class="bg-warning"'.$tmpStyle.'><b>Missing ' . ((int)$row['gamesTotal'] - sizeof($picks)) . ' / ' . $row['gamesTotal'] . ' picks.</b><br /><a href="entry_form.php?week=' . $row['weekNum'] . '">Enter now &raquo;</a></div>' . "\n";
			} else {
				//all picks were entered
				echo '			<div class="bg-info" style="color: green;"><b>All picks entered.</b><br /><a href="entry_form.php?week=' . $row['weekNum'] . '">Change your picks &raquo;</a></div>' . "\n";
			}
		}
		echo '		</div>'."\n";
		$i++;
	}
	$query->free;
	?>
		</div><!-- end col -->
	</div><!-- end entry-form -->
<?php
	include('includes/comments.php');
}

