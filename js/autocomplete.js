$(document).ready(function () {
    var dataList = document.getElementById('modules');
    var input = document.getElementById('ajax');
    var text = input.value;
    var jsonOptions = "";
    var currentText = text;

    var params = "text=";
    
    $("#ajax").on('input', function() {
    });
    var request = new XMLHttpRequest();

    request.onreadystatechange = function (response) {
        if (request.readyState === 4) {
            if (request.status === 200) {
                // Parse the JSON
                console.log(request.responseText);
                if (request.responseText === "") {
                    alert("Blank");
                }

                console.log("RESPONSE TEXT = " + request.responseText);
                jsonOptions = JSON.parse(request.responseText);

                dataList.innerHTML = "";

                jsonOptions.forEach(function (item) {
                    var option = document.createElement('option');
                    option.value = item;
                    dataList.appendChild(option);
                });

                input.placeholder = "e.g. WTW 114";
            } else {
                input.placeholder = "Couldn't load datalist options :(";
            }
        }
    };

    request.open('POST', 'autocomplete.php', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(params);

    //});

    $("#add-module").click(function () {
        var newModule = document.getElementById('ajax').value;
        var text = document.getElementById('module-string').value;

        console.log("new module: " + newModule);
        console.log("text: " + text);


        if (text === "" || text === null || text === undefined) {
            text = newModule;
        } else {
            text += "," + newModule;
        }
        document.getElementById('module-string').value = text;
        document.getElementById('ajax').value = "";

    });

});
