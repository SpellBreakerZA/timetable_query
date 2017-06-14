$(document).ready(function() {
    
    $("#time-inputs").toggle();
    $("#time").change(hideTimeSelectors);
    $("#now-box").change(hideTimeSpecificSelectors);
});

function hideTimeSelectors() {
    $("#time-inputs").toggle();
}

function hideTimeSpecificSelectors() {
    $("#time-specific-inputs").toggle();
}