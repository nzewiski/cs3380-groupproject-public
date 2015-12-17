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
require('includes/classes/team.php');

$team = $_GET['team'];
if (empty($team)) {
	$week = $_GET['week'];

	//get current week
	$currentWeek = getCurrentWeek();
	if (empty($week)) $week = $currentWeek;
}

include('includes/header.php');
?>
<h1>Schedules</h1>
<p>Select a Team:
<select name="team" onchange="javascript:location.href='schedules.php?team=' + this.value;">
	<option value=""></option>
<?php
$sql = "select * from " . DB_PREFIX . "teams order by city, team";
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
	while ($row = $query->fetch_assoc()) {
		echo '	<option value="' . $row['teamID'] . '"' . ((!empty($team) && $team == $row['teamID']) ? ' selected="selected"' : '') . '>' . $row['city'] . ' ' . $row['team'] . '</option>' . "\n";
	}
}
$query->free;
?>
</select> <b>OR</b> Week:
<select name="week" onchange="javascript:location.href='schedules.php?week=' + this.value;">
	<option value="all"<?php echo (($week == 'all') ? ' selected="selected"' : ''); ?>>All</option>
<?php
$sql = "select distinct weekNum from " . DB_PREFIX . "schedule order by weekNum;";
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
	while ($row = $query->fetch_assoc()) {
		echo '	<option value="' . $row['weekNum'] . '"' . ((!empty($week) && $week == $row['weekNum']) ? ' selected="selected"' : '') . '>' . $row['weekNum'] . '</option>' . "\n";
	}
}
$query->free;
?>
</select></p>
<?php
if (!empty($team)) {
	$teamDetails = new team($team);
	echo '<h2><img src="images/logos/' . $team . '.gif" height="60" /> ' . $teamDetails->teamName . ' Schedule</h2>';
}

$sql = "select s.*, ht.city, ht.team, ht.displayName, vt.city, vt.team, vt.displayName from " . DB_PREFIX . "schedule s ";
$sql .= "inner join " . DB_PREFIX . "teams ht on s.homeID = ht.teamID ";
$sql .= "inner join " . DB_PREFIX . "teams vt on s.visitorID = vt.teamID ";
if (!empty($team)) {
	//filter team
	$where .= " where homeID = '" . $team ."' or visitorID = '" . $team . "'";
} else if (!empty($week)) {
	//filter week
	if ($week !== 'all') {
		$where .= " where weekNum = " . $week;
	}
}
$sql .= $where . " order by gameTimeEastern";
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
	echo '<table cellpadding="4" cellspacing="0" class="table1">' . "\n";
	echo '	<tr><th>Home</th><th>Visitor</th><th align="left">Game</th><th>Time / Result</th></tr>' . "\n";
	$i = 0;
	$prevWeek = 0;
	while ($row = $query->fetch_assoc()) {
		if ($prevWeek !== $row['weekNum'] && empty($team)) {
			echo '	<tr class="subheader"><td colspan="4">Week ' . $row['weekNum'] . '</td></tr>' . "\n";
		}
		$homeTeam = new team($row['homeID']);
		$visitorTeam = new team($row['visitorID']);
		$rowclass = (($i % 2 == 0) ? ' class="altrow"' : '');
		echo '	<tr' . $rowclass . '>' . "\n";
		echo '		<td><img src="images/helmets_small/' . $homeTeam->teamID . 'R.gif" /></td>' . "\n";
		echo '		<td><img src="images/helmets_small/' . $visitorTeam->teamID . 'L.gif" /></td>' . "\n";
		echo '		<td>' . $visitorTeam->teamName . ' @ ' . $homeTeam->teamName . '</td>' . "\n";
		if (is_numeric($row['homeScore']) && is_numeric($row['visitorScore'])) {
			//if score is entered, show result
			echo '		<td></td>' . "\n";
		} else {
			//show time
			echo '		<td>' . date('D n/j g:i a', strtotime($row['gameTimeEastern'])) . ' ET</td>' . "\n";
		}
		echo '	</tr>' . "\n";
		$prevWeek = $row['weekNum'];
		$i++;
	}
	echo '</table>' . "\n";
}
$query->free;

include('includes/footer.php');
