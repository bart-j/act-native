$(document).ready(function() {
    $("#example").submit(function(e) {
        e.preventDefault();

        $("#result").text("");
        $("#submit").hide();
        $("#spinner").show();

        $.post("/decide", $(this).serialize(), function(data) {
            $("#result").html(data.result);

            $("#submit").show();
            $("#spinner").hide();
        });
    });
});