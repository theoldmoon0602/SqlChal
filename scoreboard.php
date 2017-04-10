

<div>
<h2>Scoreboard</h2>
<?php
	$scoreboard = getScoreBoard();
?>
<table class="scoreboard">
	<tr><th>Rank</th><th>Username</th><th>Points</th></tr>
	<?php foreach ($scoreboard as $rank => $user) { ?>
	<tr>
	<th><?php o($rank+1); ?></th>
	<td><?php o($user->username); ?></td>
	<td><?php o($user->point); ?></td>
	</tr>
	<?php } ?>
</table>
</div>
<div>
<h2>Scores</h2>
<?php for($problem_id = 0; $problem_id < getProblemCount(); $problem_id++) { ?>
<div>
	<h3 class="score-selector">Problem <?php o($problem_id); ?></h3>
	<table class="scores" id="<?php o($problem_id); ?>">
	<tr><th>Rank</th><th>Username</th><th>Execution Time</th><th>Point</th></tr>
	<?php $ranking = getRankingAbout($problem_id); ?>
	<?php foreach ($ranking as $rank => $submit_info) { ?>
	<tr>
		<th><?php o($rank+1); ?></th>
		<th><?php o($submit_info->author_name); ?></th>
		<td><?php o($submit_info->execution_time); ?></td>
		<td><?php o($submit_info->point); ?>pt</td>
	</tr>
	<?php } ?>
	</table>
</div>
<?php } ?>
</div>
<script>
$('.score-selector').click(function() {
	var id = $(this).data('id');
	$("#"+id).slideToggle();
});
</script>
