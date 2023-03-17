$(document).ready(() => {
    $("#delete-that-quest").click(() => {
        alertify.confirm("Silmek istediğinize emin misiniz?", () => {
            var qid = $("#delete-that-quest").attr("qid") ?? -1;
            if (qid == -1)
            {
                alertify.error("Başarısız, Belirsiz hata lütfen sayfayı yenileyiniz.");
                return;
            }
            $.ajax({
                url: getHost("/api/backend/quests"),
                method: "POST",
                data: {
                    "action": "remove",
                    "qid": qid
                },
                success: (data, status) => {
                    console.log(data);
                    if (data.status)
                    {
                        ffMakeAlert("success", "Başarılı!", data.data);

                        setTimeout(() => {
                            ffRouteOnSite("/");
                        }, 2000);
                    }
                    else{
                        ffMakeAlert("error", "Başarısız", data.data.err);
                    }
                },
                error: (v1, v2) => {
                    console.log(v1);
                    console.log(v2);
                    ffMakeAlert("error", "Başarısız", v1);
                    ffMakeAlert("error", "Başarısız", v2);
                    console.log("Javascript request error");
                }
            });
        }, () => {
            console.log("no");
        }).setHeader('#18915');
    });

    $("#edit-that-quest").click(() => {
        ffMakeAlert("", "header", "Bu özellik yakında eklenecektir.");
        return;
        alertify.prompt("This is a prompt dialog.", "mother f*cker",
            function(evt, value ){
                alertify.success('Ok: ' + value);
            },
            function(){
                alertify.error('Cancel');
            });
    });
});