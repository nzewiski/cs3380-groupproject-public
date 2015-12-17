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
<h1>Rules / Help</h1>

<h2>Basics</h2>
<p>The concept of Pick Champ is simple: pick the winners of each game each week.</p>
<p>and get the assigned number of points if you pick the correct team. 
<p>To enter, fill in the entry form by selecting the outcome of each game.</p>
<p>The player who accurately predicts the most correct winners each week gets a win.  If two players share the winning score for a week, the win is awarded to both players.</p>
<p>At the end of the football season the person with the highest cumulative score wins. The final tie breaker is determined by who has the better overall pick ratio (correct picks / total picks).</p>

<h2>Making and Changing Entries</h2>
<p>When filling in an entry form, you do not have to make a pick for each game.  This is helpful if there are early games scheduled for a given week (games played on a Thursday, Friday or Saturday). You may make your picks for these games beforehand and complete the rest later.</p>
<p>Games are automatically locked out on the entry form according to their scheduled date and time. Early games are locked at the start of the individual game. All remaining games (including the Monday Night Football game) are locked at the scheduled start time of the first Sunday game.</p>
<p>Note: all times displayed on the schedule are Eastern.</p>
<p>You may change your pick for any game up until the time that game is locked.</p>
<p>Entries must be completed on time. Once a game is locked, you may not change your pick for it. If you did not make a pick for a particular game, it is counted as a loss. If you submit a partial entry and either forget or are unable to complete it, the games you did not pick will count as losses.</p>
<p>If you have trouble accessing the site, logging in or completing your entry, please contact the Administrator for help.  If you are unable to make your picks before they are locked out, the Administrator may enter your picks after the fact if the picks are communicated to the Administrator ahead of time.</p>

<p>If you have any questions, please contact the <a href="mailto:<?php echo $adminUser->email; ?>">Administrator</a></p>

<?php
require('includes/footer.php');
?>