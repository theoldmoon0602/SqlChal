<section class="section">
    <h3 class="section-title">Scoreboard</h3>
    <div class="table">
        <table>
            <tr>
                <th>Rank</th>
                <th>User</th>
                <?php $problems = getProblems(); ?>
                <?php foreach ($problems as $problem) { ?>
                    <th><a href="?problem=<?php echo $problem->id; ?>">
                            <span><?php echo $problem->id; ?></span>
                            <span class="problem-score">[<?php o($problem->point); ?> pts]</span>
                        </a>
                    </th>
                <?php } ?>
                <th>Score</th>
            </tr>
            <?php $scoreboard = getScoreBoard(); ?>
            <?php foreach ($scoreboard as $rank => $userSubmission) { ?>
                <?php if ($rank == 0): ?>
                    <tr class="first-prize">
                <?php else: ?>
                    <tr>
                <?php endif; ?>
                    <td><?php o($rank + 1); ?></td>
                    <td><?php o($userSubmission->username); ?></td>
                    <?php foreach ($userSubmission->results as $result) { ?>
                        <?php if ($result) { ?>
                            <td class="ac">AC</td>
                        <?php } else { ?>
                            <td class="wa">WA</td>
                        <?php } ?>
                    <?php } ?>
                    <td><?php o($userSubmission->score); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</section>