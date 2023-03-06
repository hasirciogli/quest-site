function qaddFuncsChangeMoverText(textt){
    $("#qadd-mover-text").html(textt);
}

function qaddFuncsMoveMoverBasement(target){
    qaddMover__.target_ider = target;
}

function qaddFuncsShowMover(){
    qaddMover__.isShown = true;

    $("#qadd-mover-base").css("opacity", "0%");

    if ($("#qadd-mover-base")[0].classList.contains("hidden"))
        $("#qadd-mover-base")[0].classList.remove("hidden");

    $("#qadd-mover-base").animate({"opacity": "100%"}, {duration: 555, queue: false});
}
function qaddFuncsHideMover(){
    qaddMover__.isShown = false;

    $("#qadd-mover-base").css("opacity", "100%");



    $("#qadd-mover-base").animate({"opacity": "0%"}, {duration: 555});

    setTimeout(() => {
        if (!$("#qadd-mover-base")[0].classList.contains("hidden"))
            $("#qadd-mover-base")[0].classList.add("hidden");
    },666);

}
function qaddFuncsChangeMoverText(color, ttext){


    $("#qadd-mover-text").html(`<span class='${color}'>${ttext}</span>`);

}
const qaddMover__ = {
    isShown: false,
    target_ider: "",
    x: 0,
    y: 0,
}

$(document).ready(() => {
    setInterval(() => {
        var z1 = $("#qadd-mover-base")[0].getBoundingClientRect();
        var x=0, y=0;

        if (qaddMover__.target_ider != "")
        {
            var zrect = $(qaddMover__.target_ider)[0].getBoundingClientRect();
            x = zrect.x;
            y = zrect.y - z1.height;
        }

        $("#qadd-mover-base").animate({"left": x + "px", "top": y + "px"}, {duration: 200});
    }, 200);
    $("#qadd-header").keyup(function () {
        var tval = $(this).val();

        if (tval.length < 20){
            qaddFuncsChangeMoverText("text-red-600", "Minimum 20 karakter: -" + (20 - tval.length));
        }
        else{
            qaddFuncsChangeMoverText("text-green-500", "Tamam toplam " + tval.length + " karakter oldu &#128515;");
        }
    });

    $("#qadd-content").keyup(function () {
        var tval = $(this).val();

        if (tval.length < 50){
            qaddFuncsChangeMoverText("text-red-600", "Minimum 50 karakter: -" + (50 - tval.length));
        }
        else{
            qaddFuncsChangeMoverText("text-green-500", "Tamam toplam " + tval.length + " karakter oldu &#128515;");
        }
    });

    $("#qadd-imagelink").keyup(function () {
        var tval = $(this).val();

        if (tval.length > 0)
            qaddFuncsChangeMoverText("text-green-500", "Tamam toplam " + tval.length + " karakter oldu &#128515; Nasıl olsa bu bir link :)");
        else
            qaddFuncsChangeMoverText("text-black", "Eğer resim bulamadıysan boş geçebilirsin :)");
    });

    $("#qadd-category").keyup(function () {
        var tval = $(this).val();

        if (tval.length > 0)
            qaddFuncsChangeMoverText("text-green-500", tval.length + " karakter yazdın, Sana bir 🧁 borcum olsun");
        else
            qaddFuncsChangeMoverText("text-black", "Girmesende olur, Ama sen bilirsin.");
    });

    $("#qadd-header").focus(() => {
        if (!qaddMover__.isShown)
            qaddFuncsShowMover();
        qaddFuncsChangeMoverText("text-black", "Lütfen bir değer giriniz.");

        qaddFuncsMoveMoverBasement("#qadd-header");
    });

    $("#qadd-content").focus(() => {
        if (!qaddMover__.isShown)
            qaddFuncsShowMover();
        qaddFuncsChangeMoverText("text-black", "Lütfen bir değer giriniz.");

        qaddFuncsMoveMoverBasement("#qadd-content");
    });

    $("#qadd-imagelink").focus(() => {
        if (!qaddMover__.isShown)
            qaddFuncsShowMover();
        qaddFuncsChangeMoverText("text-black", "Eğer resim bulamadıysan boş geçebilirsin :)");


        qaddFuncsMoveMoverBasement("#qadd-imagelink");
    });

    $("#qadd-category").focus(() => {
        if (!qaddMover__.isShown)
            qaddFuncsShowMover();
        qaddFuncsChangeMoverText("text-black", "Girmesende olur, Ama sen bilirsin.");

        qaddFuncsMoveMoverBasement("#qadd-category");
    });




    /*$("#qadd-header").focusout(() => {
        if (qaddMover__.isShown)
            qaddFuncsHideMover();
    });

    $("#qadd-content").focusout(() => {
        if (qaddMover__.isShown)
            qaddFuncsHideMover();
    });

    $("#qadd-imagelink").focusout(() => {
        if (qaddMover__.isShown)
            qaddFuncsHideMover();
    });

    $("#qadd-category").focusout(() => {
        if (qaddMover__.isShown)
            qaddFuncsHideMover();
    });*/
    var qaddBtnDisabledCheck = false;
    $("#ask-a-new-question").click(() => {
        if (qaddBtnDisabledCheck)
            dispatchEvent();

        qaddBtnDisabledCheck = true;



        function ccheck(vvar)
        {
            if (vvar && vvar != "")
                return vvar;
            else
                return false;
        }
        function ffmklrt(a, h, c) {
            qaddBtnDisabledCheck = false;
            ffMakeAlert(a, h, c);
            dispatchEvent();
        }

        var q_header = ccheck($("#qadd-header").val()) ? $("#qadd-header").val() : ffmklrt("error", "Başlık hatası!", "Başlık boş olamaz...");
        var q_content = ccheck($("#qadd-content").val()) ? $("#qadd-content").val() : ffmklrt("error", "İçerik hatası!", "İçerik boş olamaz...");
        var q_category = ccheck($("#qadd-category").val()) ? $("#qadd-category").val() : "-";
        var q_secretm = ($("#qadd-anonymousmode")[0].checked == false || $("#qadd-anonymousmode")[0].checked == true) ? $("#qadd-anonymousmode")[0].checked : ffmklrt("error", "Gizlilik hatası!", "Gizlilik boş olamaz...");
        var q_imageurl = ccheck($("#qadd-imagelink").val()) ? $("#qadd-imagelink").val() : "-";

        $.ajax({
            url: getHost("/api/backend/quests"),
            method: "POST",
            data: {
                "action": "add",
                "header": q_header,
                "content": q_content,
                "category": q_category,
                "secret_mode": q_secretm ? 1 : 0,
                "image_url": q_imageurl,
            },
            success: (data, status) => {
                console.log(data);
                if (data.status)
                {
                    $("#ask-a-new-question")[0].classList.add("hidden");
                    $("#cancel-a-new-question")[0].classList.add("hidden");

                    ffMakeAlert("success", "Başarılı!", "Yazın başarıyla yalaşıldı");
                    qaddBtnDisabledCheck = false;

                    setTimeout(() => {
                        ffRouteOnSite("/");
                    }, 2000);
                }
                else{
                    ffMakeAlert("success", "Başarılı!", "Belirlenemeyen hata");
                    qaddBtnDisabledCheck = false;
                }
            },
            error: (v1, v2) => {
                qaddBtnDisabledCheck = false;
                console.log("Javascript request error");
            }
        });
    });

    $("#cancel-a-new-question").click(() => {

    });
});