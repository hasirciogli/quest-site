function getHost(add = "") {
    var cstr = window.location.toString();
    return (cstr.substring(0, 5) == "https" ? "https" : "http") + "://" + window.location.hostname + add;
}
function kisalt(str, len) {
    if (str.length > len) {
        return str.substr(0, len) + "...";
    }

    return str;
}