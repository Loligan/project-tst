
function getStringParams(json) {
    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.replace(new RegExp(search, 'g'), replacement);
    };
    json = json.replaceAll("&quot;",'"');
    // json = "{"+json+"}";
    json = JSON.parse(json);

    var result = "";
    Object.keys(json).forEach(function (key) {
        result +=key+': '+json[key]+",  ";
    });
    result = result.substring(0,result.length-3);
    return result;
};
