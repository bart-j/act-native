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
            
            if (data.result.startsWith("Er heeft geen") || data.result.startsWith("01| ")) {
            	$("#alertbox").removeClass("alert-success");
            	$("#alertbox").addClass("alert-danger");
            } else {
            	$("#alertbox").removeClass("alert-danger");
            	$("#alertbox").addClass("alert-success");
            }
        });
    });
});