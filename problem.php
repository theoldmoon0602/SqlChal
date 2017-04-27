<?php
$problem = null;
try {
    $problem = getProblem($id);
    if (!$problem) {
        throw new Exception('B');
    }
} catch (Exception $e) {
    include_once('main.php');
    return;
}

?>

<section class="section">
    <h3 class="section-title"><?php o($problem->name); ?>
        <small>[<?php o($problem->point); ?>pts]</small>
    </h3>

    <?php if (isUserSolved($_SESSION["id"], $id)) {
        echo '<p>You already solved this problem.</p>';
    } ?>

</section>

<section class="section">
    <h3 class="section-title">ストーリー</h3>
    <?php echo nl2br($problem->story); ?>
</section>

<section class="section">
    <h3 class="section-title">指示</h3>
    <?php echo nl2br($problem->text); ?>
</section>

<section class="section">
    <h3 class="section-title">サンプル</h3>
    <div class="table">
        <table>
            <?php
            $result = execute_query($problem->sample);
            echo(format_to_table($result['rows'], 10));
            ?>
        </table>
    </div>
</section>

<section class="section">
    <h3 class="section-title">クエリ実行・提出</h3>
    <div class="query-editor">
        <p>SELECT</p>
        <textarea name="query" id="query"></textarea>
        <button id="submit">Submit Query</button>
    </div>
    <p>
        <label for="print-limit">最大表示件数</label><input type="number" id="print-limit" value="10"/><br>
        <small>limit句とは別に、描画処理を軽くするために、最大表示件数を制限します</small>
    </p>
</section>

<section class="section">
    <h3 class="section-title">実行結果</h3>
    <div id="submit-result">
        <p id="accepted"></p>
        <p>実行時間: <span id="time"></span>秒</p>
        <div class="table">
            <table id="result"></table>
        </div>
    </div>
</section>

<script>
    $(function () {
        var audioContext;
        var audioBuffer = fetch('gomen.mp3')
                .then(response => response.arrayBuffer())
                .then(buffer => {
                    return new Promise(resolve, reject) => {
                        audioContext = new AudioContext();
                        audioContext.decodeAudioData(buffer, resolve, reject);
                    }
                });


        $("#loader").hide();
        $("#submit").click(function () {
            var query = $("#query").val();
            var printLimit = $("#print-limit").val();

            $("#accepted").fadeOut();

            $.ajax({
                url: "submit.php",
                type: "post",
                dataType: "json",
                data: {
                    "query": query,
                    "print_limit": printLimit,
                    "id": <?php echo $id; ?>,
                    "csrf_token": "<?php echo csrf(); ?>"
                }
            }).then(function (json) {
                var error = json["error"];
                if (error.length > 0) {
                    alert(error);
                    if ("goto" in json) {
                        location.href = json["goto"];
                    }
                    return;
                }
                var result = json["result"];
                var accepted = json["accepted"];
                var time = json["time"];

                if (accepted) {
                    $("#accepted").removeClass('wa').addClass('ac').text('AC').fadeIn();

                    audioBuffer.then(buffer => {
                       var bufsrc = audioContext.createBufferSource();
                       bufsrc.buffer = buffer;
                       bufsrc.connect(audioContext.destination);
                       bufsrc.start(0);
                    });

                    alert("Congrats! You 'AC'ed this problem!");
                    location.href=".";
                }
                else {
                    $("#accepted").removeClass('ac').addClass('wa').text('WA').fadeIn();
                }
                $("#time").text(time).show();
                $("#result").html(result).slideDown('slow');
            });
        });
    });
</script>

