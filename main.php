<div>
	<h2>WELCOME TO Joken SQL Challenge</h2>
<div class="information">
<h3>Information</h3>
<ul>
	<?php if (time() < getStartTime()) { ?>
	<li>The contest will be started <?php o(date('Y-m-d H:i:s', getStartTime())); ?></li>
	<?php } else if(getEndTime() <= time()) { ?>
	<li>The contest is done.</li>
	<?php } else { ?>
	<li>The contest is running now.</li>
	<?php } ?>
</ul>
</div>

<div class="problem">
    <h3>Joken SQL Challenge</h3>
    <p class="story">
        奈良高専情報処理研究会―― Joken ―― の部長（会長？）である kyumina くんは、今年の高専プログラミングコンテストを盛り上げ、
        情報処理研究会をより発展させる方策として、高専プロコン専用のSNS、 KosenProconTwitter を作ることにしました。
        しかし、高専生といえばツイッターの鬼、高専カンファレンスが開催されるたびに、 #kosenconf タグはトレンド入りするほどです。
        KosenProconTwitter が高専生のツイートに耐えうるのか不安になった kyumina くんは、ダミーのデータを使って、データベースのテストをすることにしました。
        しかし、データベースに明るくない kyumina くんは、 Joken でも屈指のデータベースおじさんであるあなたに、助力を求めてきたのでした……。
    </p>

    <ul class="rule">
        <li>Joken SQL Challenge では いくつかの問題が出題されます。各問題の要件を満たすようなSELECTクエリを提出することでACとなり、点数を得られます。</li>
        <li>各問題には配点が設定されており、問題にACすることで問題に設定された文の点数を得ることができます（正解した状態をAC、そうでない状態をWAと呼ぶ）</li>
        <li>スコアが高いほうが順位が高く、より早く提出したほうが順位が高くなります。</li>
    </ul>



</div>
    <div id="problems">
        <h3>Problems</h3>
        <ul>
            <?php foreach (getProblems() as $i => $problem) { ?>
                    <li><a href="?problem=<?php o($i+1);?>" <?php if (isUserSolved($_SESSION["id"], $problem->id)) {echo('class="AC-button"'); }?> ><?php o($problem->name); ?> [<?php o($problem->point); ?> pts]</a></li>
            <?php } ?>
        </ul>
    </div>
