$(document).ready(() => {
    function getHostToLike(add = "") {
        var cstr = window.location.toString();
        return (cstr.substring(0, 5) == "https" ? "https" : "http") + "://" + window.location.hostname + add;
    }

    $("#make-like-button-for-quest").click(() => {
        $.ajax({
            url: getHostToLike() + "/api/backend/quests",
            method: "POST",
            data: {
                "action": "like",
                "liketo": $("#make-like-button-for-quest").attr("base-quest-id"),
            },
            success: (data, status) => {
                if (data.status)
                {
                    ffMakeAlert("success", "Fırıncı bu işe onay verdi", "Beğendin!");

                    $("#make-like-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-like-button-for-quest")[0].classList.add("hidden");
                    $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? $("#make-unlike-button-for-quest")[0].classList.remove("hidden") : "";
                }
                else{
                    if(data.data.err == "Zaten beğenmişsin."){
                        $("#make-like-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-like-button-for-quest")[0].classList.add("hidden");
                        $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? $("#make-unlike-button-for-quest")[0].classList.remove("hidden") : "";

                        ffMakeAlert("error", "Sanırım yanlışlık olmuş!", "Çünki halihazırda beğenmiş durumdasın.");
                    }

                    ffMakeAlert("info", "Ufacık bir sıkıntı", data.data.err);
                }
                console.log(data);
            },
            error: (v1, v2) => {
                ffMakeAlert("error", "Ufacık bir sıkıntı", "Javascript request error  #39898975");
            }
        });
    });

    $("#make-unlike-button-for-quest").click(() => {
        $.ajax({
            url: getHostToLike() + "/api/backend/quests",
            method: "POST",
            data: {
                "action": "unlike",
                "unliketo": $("#make-like-button-for-quest").attr("base-quest-id"),
            },
            success: (data, status) => {
                if (data.status)
                {
                    ffMakeAlert("success", "Çaycı kabul etti", "Beğeni kaldırıldı");

                    $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-unlike-button-for-quest")[0].classList.add("hidden");
                    $("#make-like-button-for-quest")[0].classList.contains("hidden") ? $("#make-like-button-for-quest")[0].classList.remove("hidden") : "";
                }
                else if (data.data.err == 'Beğenmemişsin ki')
                {
                    $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-unlike-button-for-quest")[0].classList.add("hidden");
                    $("#make-like-button-for-quest")[0].classList.contains("hidden") ? $("#make-like-button-for-quest")[0].classList.remove("hidden") : "";

                    ffMakeAlert("error", "Çaycı Zam Yaptı", data.data.err);
                }
            },
            error: (v1, v2) => {
                console.log("Javascript istek hatası");
            }
        });
    });

    setInterval(() => {

        $.ajax({
            url: getHostToLike() + "/api/backend/quests",
            method: "POST",
            data: {
                "action": "likec",
                "question-id": $("#make-like-button-for-quest").attr("base-quest-id"),
            },
            success: (data, status) => {
                if (data.status)
                {
                    $("#quest-likes-count").html(data.data + " Likes");
                }
                else{
                    console.log("Javascript server internal error");
                }
            },
            error: (v1, v2) => {
                console.log("Javascript request error");
            }
        });
    }, 3500);
});