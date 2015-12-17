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

$weekStats = array();
$playerTotals = array();
$possibleScoreTotal = 0;
calculateStats();

include('includes/header.php');
?>
<h1>Standings</h1>
<h2>Weekly Stats</h2>
<div class="table-responsive">
<table class="table table-striped">
	<tr><th align="left">Week</th><th align="left">Winner(s)</th><th>Score</th></tr>
<?php
if (isset($weekStats)) {
	$i = 0;
	foreach($weekStats as $week => $stats) {
		$winners = '';
		if (is_array($stats[winners])) {
			foreach($stats[winners] as $winner => $winnerID) {
				$tmpUser = $login->get_user_by_id($winnerID);
				switch (USER_NAMES_DISPLAY) {
					case 1:
						$winners .= ((strlen($winners) > 0) ? ', ' : '') . trim($tmpUser->firstname . ' ' . $tmpUser->lastname);
						break;
					case 2:
						$winners .= ((strlen($winners) > 0) ? ', ' : '') . $tmpUser->username;
						break;
					default: //3
						$winners .= ((strlen($winners) > 0) ? ', ' : '') . '<abbr title="' . trim($tmpUser->firstname . ' ' . $tmpUser->lastname) . '">' . $tmpUser->username . '</abbr>';
						break;
				}
			}
		}
		$rowclass = (($i % 2 == 0) ? ' class="altrow"' : '');
		echo '	<tr' . $rowclass . '><td>' . $week . '</td><td>' . $winners . '</td><td align="center">' . $stats[highestScore] . '/' . $stats[possibleScore] . '</td></tr>';
		$i++;
	}
} else {
	echo '	<tr><td colspan="3">No weeks have been completed yet.</td></tr>' . "\n";
}
?>
</table>
</div>

<h2>User Stats</h2>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<b>By Name</b><br />
		<div class="table-responsive">
			<table class="table table-striped">
				<tr><th align="left">Player</th><th align="left">Wins</th><th>Pick Ratio</th></tr>
			<?php
			if (isset($playerTotals)) {
				//arsort($playerTotals);
				$i = 0;
				foreach($playerTotals as $playerID => $stats) {
					$rowclass = (($i % 2 == 0) ? ' class="altrow"' : '');
					$pickRatio = $stats[score] . '/' . $possibleScoreTotal;
					$pickPercentage = number_format((($stats[score] / $possibleScoreTotal) * 100), 2) . '%';
					switch (USER_NAMES_DISPLAY) {
						case 1:
							echo '	<tr' . $rowclass . '><td class="tiny">' . $stats[name] . '</td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
						case 2:
							echo '	<tr' . $rowclass . '><td class="tiny">' . $stats[username] . '</td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
						default: //3
							echo '	<tr' . $rowclass . '><td class="tiny"><abbr title="' . $stats[name] . '">' . $stats[username] . '<abbr></td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
					}
					$i++;
				}
			} else {
				echo '	<tr><td colspan="3">No weeks have been completed yet.</td></tr>' . "\n";
			}
			?>
			</table>
		</div>
	</div>
	<div class="col-md-4 col-xs-12">
		<b>By Wins</b><br />
		<div class="table-responsive">
			<table class="table table-striped">
				<tr><th align="left">Player</th><th align="left">Wins</th><th>Pick Ratio</th></tr>
			<?php
			if (isset($playerTotals)) {
				arsort($playerTotals);
				$i = 0;
				foreach($playerTotals as $playerID => $stats) {
					$rowclass = (($i % 2 == 0) ? ' class="altrow"' : '');
					$pickRatio = $stats[score] . '/' . $possibleScoreTotal;
					$pickPercentage = number_format((($stats[score] / $possibleScoreTotal) * 100), 2) . '%';
					switch (USER_NAMES_DISPLAY) {
						case 1:
							echo '	<tr' . $rowclass . '><td class="tiny">' . $stats[name] . '</td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
						case 2:
							echo '	<tr' . $rowclass . '><td class="tiny">' . $stats[username] . '</td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
						default: //3
							echo '	<tr' . $rowclass . '><td class="tiny"><abbr title="' . $stats[name] . '">' . $stats[username] . '</abbr></td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
					}
					$i++;
				}
			} else {
				echo '	<tr><td colspan="3">No weeks have been completed yet.</td></tr>' . "\n";
			}
			?>
			</table>
		</div>
	</div>
	<div class="col-md-4 col-xs-12">
		<b>By Pick Ratio</b><br />
		<div class="table-responsive">
			<table class="table table-striped">
				<tr><th align="left">Player</th><th align="left">Wins</th><th>Pick Ratio</th></tr>
			<?php
			if (isset($playerTotals)) {
				$playerTotals = sort2d($playerTotals, 'score', 'desc');
				$i = 0;
				foreach($playerTotals as $playerID => $stats) {
					$rowclass = (($i % 2 == 0) ? ' class="altrow"' : '');
					$pickRatio = $stats[score] . '/' . $possibleScoreTotal;
					$pickPercentage = number_format((($stats[score] / $possibleScoreTotal) * 100), 2) . '%';
					switch (USER_NAMES_DISPLAY) {
						case 1:
							echo '	<tr' . $rowclass . '><td class="tiny">' . $stats[name] . '</td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
						case 2:
							echo '	<tr' . $rowclass . '><td class="tiny">' . $stats[username] . '</td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
						default: //3
							echo '	<tr' . $rowclass . '><td class="tiny"><abbr title="' . $stats[name] . '">' . $stats[username] . '</abbr></td><td class="tiny" align="center">' . $stats[wins] . '</td><td class="tiny" align="center">' . $pickRatio . ' (' . $pickPercentage . ')</td></tr>';
							break;
					}
					$i++;
				}
			} else {
				echo '	<tr><td colspan="3">No weeks have been completed yet.</td></tr>' . "\n";
			}
			?>
			</table>
		</div>
	</div>
</div>

<?php
include('includes/comments.php');

include('includes/footer.php');
?>