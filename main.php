<h2>WELCOME TO Joken SQL Challenge</h2>
<section class="section">
    <h3 class="section-title">Information</h3>
    <ul>
        <?php if (time() < getStartTime()) { ?>
            <li>The contest will be started <?php o(date('Y-m-d H:i:s', getStartTime())); ?></li>
        <?php } else if (getEndTime() <= time()) { ?>
            <li>The contest is done.</li>
        <?php } else { ?>
            <li>The contest is running now.</li>
        <?php } ?>
    </ul>
</section>

<section class="section">
    <h3 class="section-title">Joken SQL Challenge</h3>
    Joken SQL Challengeへようこそ。これは、SQLのSELECTクエリをいかに早く、正確に構築できるかを競うコンテストです。
</section>
<section class="section">
    <h3 class="section-title">ルール</h3>
    <ul class="rule">
        <li>競技時間は～時までで、競技時間中にもっとも多く点数を得た人が優勝となります。</li>
        <li>各問題を解くと、問題に応じた点数を獲得することができます。</li>
        <li>同点の場合にはより早く解答を提出した人が上位となります。</li>
        <li>競技中の参加者同士での問題に関する意見交流は禁止します。</li>
    </ul>
</section>
<section class="section" id="problems">
    <h3 class="section-title">Problems</h3>
    <div class="table">
        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Point</th>
            </tr>
            <?php foreach (getProblems() as $i => $problem) { ?>
                <?php if (isset($_SESSION['id']) && isUserSolved($_SESSION["id"], $problem->id)): ?>
                    <tr class="AC">
                <?php else: ?>
                    <tr>
                <?php endif; ?>

                <td><?php o($i + 1); ?></td>
                <td><a href="?problem=<?php o($i + 1); ?>"><?php o($problem->name); ?></td>
                <td><?php o($problem->point); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</section>
