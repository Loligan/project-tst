function getSearchParameters() {
    var prmstr = window.location.search.substr(1);
    return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray(prmstr) {
    var params = {};
    var prmarr = prmstr.split("&&");
    for (var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}


function setCheckParamsByLoad() {
    var params = getSearchParameters();
    var checkboxesElements = document.getElementsByClassName("param");

    for (i = 0; i < checkboxesElements.length; i++) {
        var paramCheckbox = checkboxesElements[i].getAttribute("filterdata");
        for (var key in params) {
            var param = key + "=" + params[key];
            if (param === paramCheckbox) {
                checkboxesElements[i].checked = true;
                break;
            }
        }
    }
}

function addParams(url, parameter) {
    url += (url.split('?')[1] ? '&&' : '?') + parameter;
    return url;
}



document.getElementById("filter").onclick = function () {
    var url = window.location.href.split('?')[0];
    var checkboxesElements = document.getElementsByClassName("param");
    for (i = 0; i < checkboxesElements.length; i++) {
        if (checkboxesElements[i].checked == true) {
            var value = checkboxesElements[i].getAttribute("filterdata");
            console.log(value);
            url = addParams(url, value);
        }
    }
//        console.log(url);
    window.location.href = url;
};


setCheckParamsByLoad();
$('.ui.checkbox')
    .checkbox()
;