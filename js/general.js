 $(document).ready(function() {
    shouldUpdate(); 
})
 
function shouldUpdate() {
    
    var UPDATE_NUM_DAYS_RESET = 14;
    $.get("util.php", function(data, status) {
        var daysOld = data;
        if (daysOld >= UPDATE_NUM_DAYS_RESET) {
            promptUpdate(daysOld);
        }  
    })   
}

function promptUpdate(daysOld) {
    
    $("#days-old").text(daysOld);
    $("#myModal").modal("show");
    
}