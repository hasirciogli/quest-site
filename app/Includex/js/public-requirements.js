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

function ffMakeAlert(type, header, content)
{
    switch (type)
    {
        case "error":
            alertify.error(content);
            break;
        case "success":
            alertify.success(content);
            break;
        case "info":
            alertify.warning(content);
            break;
        default:
            alertify.message(content);
            break;
    }
    //toastr[type](content, header);
}

function ffRouteOnSite(link)
{
    window.location.replace(getHost(link));
}

function ffRouteOtherSite(link)
{
    window.location.replace(link);
}



const convertBase64 = (file) => {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = () => {
            resolve(fileReader.result);
        };

        fileReader.onerror = (error) => {
            reject(error);
        };
    });
};


/*
setInterval(() => {
    const style = 'background-color: darkblue; color: white; font-style: italic; border: 5px solid hotpink; font-size: 2em;'
    const style2 = 'visibility:hidden;';
    console.log("%cDİKKAT ET ŞUAN DOLANDIRILIYOR OLABİLİRSİN! - %c" + Math.random(), style, style2);
    console.log("%cMaybe You are scamming right now! - %c" + Math.random(), style, style2);
}, 300);
 */