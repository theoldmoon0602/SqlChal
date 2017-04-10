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
        <li>各問題について、正しい出力を得られた提出のなかで、実行速度が速いものを上位をとして順位が与えられます。ただし、実行時間が同じの場合にはより早く提出されたものを上位とします</li>
        <li>順位によって各ユーザに点数が与えられます。コンテストへの参加人数をn人として、r位の提出を行ったユーザには n-r+1 点が与えられます。</li>
        <li>同じ問題に複数回提出し、ACした場合には、より新しい提出が採用されます</li>
        <li>各問題でユーザに与えられた点数を合計した点数により、ユーザごとの順位が決定されます。コンテスト終了時にもっとも順位の高いユーザが優勝となります</li>
    </ul>



</div>
    <div id="problems">
        <h3>Problems</h3>
        <ul>
            <?php for($i = 0; $i < getProblemCount(); $i++): ?>
                <li><a href="?problem=<?php o($i);?>">Problem <?php o($i); ?></a></li>
            <?php endfor; ?>
        </ul>
    </div>
