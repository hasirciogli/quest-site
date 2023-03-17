$(document).ready(() => {
    $(document).on('click', '.delete-that-comment', function () {
        const ths = $(this);
        alertify.confirm("Silmek istediğinize emin misiniz?", () => {
            var cid = ths.attr("cid") ?? -1;
            if (cid == -1)
            {
                alertify.error("Başarısız, Belirsiz hata lütfen sayfayı yenileyiniz.");
                return;
            }
            $.ajax({
                url: getHost("/api/backend/comments"),
                method: "POST",
                data: {
                    "action": "remove",
                    "cid": cid
                },
                success: (data, status) => {
                    console.log(data);
                    if (data.status)
                    {
                        ffMakeAlert("success", "Başarılı!", data.data);

                        $('quest-comment[c-id="'+cid+'"]')[0].remove();
                    }
                    else{
                        ffMakeAlert("error", "Başarısız", data.data.err);
                    }
                },
                error: (v1, v2) => {
                    console.log(v1);
                    console.log(v2);
                    ffMakeAlert("error", "Başarısız", v1);
                    ffMakeAlert("error", "Başarısız", v2);console.log("Javascript request error");
                }
            });
        }, () => {
            console.log("no");
        }).setHeader('#18915').set({transitionOff:true}).show();
    });

    $(document).on('click', '.edit-that-comment', function () {

        const ths = $(this);

        alertify.confirm("Silmek istediğinize emin misiniz?", () => {
            var cid = ths.attr("cid") ?? -1;
            if (cid == -1)
            {
                alertify.error("Başarısız, Belirsiz hata lütfen sayfayı yenileyiniz.");
                return;
            }
            $.ajax({
                url: getHost("/api/backend/comments"),
                method: "POST",
                data: {
                    "action": "remove",
                    "cid": cid
                },
                success: (data, status) => {
                    console.log(data);
                    if (data.status)
                    {
                        ffMakeAlert("success", "Başarılı!", data.data);

                        $('quest-comment[c-id="'+cid+'"]')[0].remove();
                    }
                    else{
                        ffMakeAlert("error", "Başarısız", data.data.err);
                    }
                },
                error: (v1, v2) => {
                    console.log(v1);
                    console.log(v2);
                    ffMakeAlert("error", "Başarısız", v1);
                    ffMakeAlert("error", "Başarısız", v2);console.log("Javascript request error");
                }
            });
        }, () => {
            console.log("no");
        }).setHeader('#18915').set({transitionOff:true}).show();
    });
});