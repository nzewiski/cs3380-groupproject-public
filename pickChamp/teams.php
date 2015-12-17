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
require_once('includes/header.php');
?>

<h1>Teams</h1>
<p>Click on a team below to see their schedule.</p>
<table>
	<tr valign="top">
		<td>
<?php
$sql = "select t.*, d.conference, d.division ".
	"from " . DB_PREFIX . "teams t ".
	"inner join " . DB_PREFIX . "divisions d on t.divisionid = d.divisionid ".
	"order by d.divisionid";
$query = $mysqli->query($sql);
$conference = '';
$division = '';
while ($row = $query->fetch_assoc()) {
	if ($row['conference'] !== $conference) {
		if ($conference !== '') {
			echo '</td><td>' . "\n";
		}
		echo '<h2><img src="images/logos/' . strtolower($row['conference']) . '_logo.gif" />' . $row['conference'] . '</h2>' . "\n";
	}
	if ($row['division'] !== $division) {
		echo '<h3>' . $row['division'] . '</h3>' . "\n";
	}
	//echo '<img src="images/helmets_small/' . $row['teamID'] . 'R.gif" /> ';
	echo '<a href="schedules.php?team=' . $row['teamID'] . '">' . $row['city'] . ' ' . $row['team'] . '</a><br />' . "\n";
	$conference = $row['conference'];
	$division = $row['division'];
}
$query->free;
?>
		</td>
	</tr>
</table>
<?php
include('includes/footer.php');
