<div>
<h2><?php o($_SESSION['username']); ?></h2>

<a href="?logout">Logout</a>

<h2>Submits</h2>
<?php $submissions = getUserSubmissions($_SESSION['id']); ?>
<table>
	<tr><th>No.</th><th>Problem</th><th>Query</th><th>Accepted</th><th>Execution time</th><th>Submitted at</th></tr>
	<?php foreach ($submissions as $i => $s) { ?>
	<tr>
		<th><?php o($i+1); ?></th>
		<td>Problem <?php o($s->problem_id); ?></td>
        <td><?php o($s->query); ?></td>
        <td><?php o($s->accepted); ?></td>
        <td><?php o($s->execution_time); ?></td>
        <td><?php o(date('Y-m-d H:i:s', $s->created_at)); ?></td>
	</tr>
	<?php } ?>
</table>
</div>
