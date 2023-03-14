var htmlElement = $("html")[0];

if (localStorage.getItem("darkmode") == 1)
{
    if (!htmlElement.classList.contains("dark"))
        htmlElement.classList.add("dark");
}
else{
    if (htmlElement.classList.contains("dark"))
        htmlElement.classList.remove("dark");
}

$(document).ready(() => {
    if (!$("body")[0].classList.contains("duration-300"))
        $("body")[0].classList.add("duration-300");

    $("body *").each(function (index) {
        if (!$(this)[0].classList.contains("duration-300"))
            $(this)[0].classList.add("duration-300");

        if (!$(this)[0].classList.contains("transition-all"))
            $(this)[0].classList.add("transition-all");
    });

    $("#toggle-darkmode-w8f4r8w4qwe84qw9r4").click(() => {
        if (localStorage.getItem("darkmode") == 1)
        {
            localStorage.setItem("darkmode", 0);
            if (htmlElement.classList.contains("dark"))
                htmlElement.classList.remove("dark");
        }
        else
        {
            localStorage.setItem("darkmode", 1);
            if (!htmlElement.classList.contains("dark"))
                htmlElement.classList.add("dark");
        }
    })
});