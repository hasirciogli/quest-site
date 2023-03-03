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
                    toastr["success"]("Tabi efendim", "Beğeni Eklendi");

                    $("#make-like-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-like-button-for-quest")[0].classList.add("hidden");
                    $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? $("#make-unlike-button-for-quest")[0].classList.remove("hidden") : "";
                }
                else{
                    if (data.data.err == "need-login")
                    {
                        window.location.href = getHostToLike("/auth");
                    }
                }
                console.log(data);
            },
            error: (v1, v2) => {
                console.log("Javascript istek hatası");
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
                    toastr["success"]("Tabi efendim", "Beğeni Silindi");

                    $("#make-unlike-button-for-quest")[0].classList.contains("hidden") ? "" : $("#make-unlike-button-for-quest")[0].classList.add("hidden");
                    $("#make-like-button-for-quest")[0].classList.contains("hidden") ? $("#make-like-button-for-quest")[0].classList.remove("hidden") : "";
                }
                console.log(data);
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
                    console.log(data);
                }
            },
            error: (v1, v2) => {
                console.log("Javascript istek hatası");
            }
        });
    }, 3500);
});