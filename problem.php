<?php
function load_problem_text($id) {
    return file_get_contents(__dir__."/problems/problem_$id.txt");
}
function load_problem_query($id) {
    return file_get_contents(__dir__."/problems/sample_$id.txt");
}


$text = load_problem_text($id);
$query = load_problem_query($id);

?>

<?php if ($id > 0): ?>
    <a href="?problem=<?php echo $id-1; ?>"> &lt; Previous</a>
<?php endif; ?>
<?php if ($id+1 < getProblemCount()): ?>
    <a href="?problem=<?php echo $id+1; ?>"> Next &gt;</a>
<?php endif; ?>



<div class="story">
    <?php echo nl2br($text) ?>
</div>
<h3>Sample</h3>
<table class="sample">
    <?php
    $result = execute_query($query);
    echo (format_to_table($result['rows']));
    ?>
</table>

<h3>Create Query and Submit</h3>
<div id="submit-form">
    <p>SELECT</p>
    <textarea id="query" rows="30" cols="70">
    </textarea>
    <p><button id="submit">Submit</button></p>
    <p>
        <label for="print-limit">最大表示件数</label><input type="number" id="print-limit" value="10" /><br>
        <small>limit句とは別に、描画処理を軽くするために、最大表示件数を制限します</small>
    </p>
</div>

<div id="loader"></div>

<div id="submit-result">
    <p id="accepted"></p>
    <p>execution time: <span id="time"></span>s</p>
    <table id="result"></table>
</div>

<script>
    $(function () {
        $("#loader").hide();
        $("#submit").click(function () {
            var query = $("#query").val();
            var printLimit = $("#print-limit").val();

            $("#loader").slideDown();
//       $("#submit-result > *").fadeOut();

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
                $("#loader").slideUp();
                var error = json["error"];
                if (error.length > 0) {
                    var e = $("<li></li>");
                    e.text(error);
                    $("#errors").append(e);
                    return;
                }
                var result = json["result"];
                var accepted = json["accepted"];
                var time = json["time"];

                if (accepted) {
                    $("#accepted").removeClass('wa').addClass('ac').text('AC').fadeIn();
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

