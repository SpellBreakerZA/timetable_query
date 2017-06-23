$(document).ready(function() {
    if($("#time").is(":checked")) {
        $("#time-inputs").show();
        if($("#now-box").is(":checked")) {
            $("#time-specific-inputs").hide();
        } else {
            $("#time-specific-inputs").show();
        }
    } else {
        $("#time-inputs").hide();
    }
    $("#time").change(hideTimeSelectors);
    $("#now-box").change(hideTimeSpecificSelectors);
});

function hideTimeSelectors(event) {
    if($(this).is(":checked")) {
        $("#time-inputs").show();
    } else {
        $("#time-inputs").hide();
    }
}

function hideTimeSpecificSelectors(event) {
    if($(this).is(":checked")) {
        $("#time-specific-inputs").hide();
    } else {
        $("#time-specific-inputs").show();
    }
}