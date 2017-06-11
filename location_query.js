$(document).ready(function() {
    $("#now-box").change(
        function() {
            $("#time-selector").toggle();
            
            /*if ($(this).is(":checked")) {
                $("#time-selector").toggle();
            }*/
        }
    )
});

