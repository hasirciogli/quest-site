$(document).ready(() => {

    $.ajax({
        url: getHost() + "/api/backend/quests",
        method: "POST",
        data: {
            "action": "list",
        },
        success: async(data, status) => {
            if (data.status) {
                data.data.forEach((item) => {
                    if (item.secret_mode) {
                        var itemx = $("<mainmenu-question-basement></mainmenu-question-basement>");

                        itemx.attr("qid", item.quest_id);

                        itemx.attr("base-header", item.header);
                        itemx.attr("base-content", kisalt(item.content, 30));

                        itemx.attr("is-secret", item.secret_mode ? 1 : 0);
                        itemx.attr("is-man", parseInt(item.user_gender));
                        itemx.attr("user-status", parseInt(item.user_status));
                        itemx.attr("base-image", (item.image_url == null ? "" : item.image_url));
                        itemx.attr("base-created-at", ((item.created_at == null || item.created_at == "") ? "" : item.created_at));
                        itemx.attr("base-read-min", item.content.length / 10);

                        $("#qlist-1").append(itemx);
                    }
                    else {
                        var itemx = $("<mainmenu-question-basement></mainmenu-question-basement>");

                        itemx.attr("qid", item.quest_id);
                        itemx.attr("uid", item.owner_id);

                        itemx.attr("base-header", item.header);
                        itemx.attr("base-content", kisalt(item.content, 30));

                        itemx.attr("is-secret", item.secret_mode ? 1 : 0);
                        itemx.attr("is-man", parseInt(item.user_gender));
                        itemx.attr("user-name", (item.user_name));
                        itemx.attr("user-surname", (item.user_surname));
                        itemx.attr("user-status", parseInt(item.user_status));

                        itemx.attr("base-image", (item.image_url == null ? "" : item.image_url));
                        itemx.attr("base-created-at", ((item.created_at == null || item.created_at == "") ? "" : item.created_at));
                        itemx.attr("base-read-min", item.content.length / 10);
                        itemx.attr("user-image", getLoaderGifLink());

                        /*$.ajax({
                            url: getHost("/api/backend/ppmanager?action=getpp&uid=" + item.owner_id),
                            success: (data) => {
                                setTimeout(() => {
                                    $(".qhome-image-" + item.owner_id).each(function (){
                                        $(this).attr("src", data);
                                    })
                                }, 800);
                            }
                        })*/

                        $("#qlist-1").append(itemx);
                    }
                })

                $("mainmenu-question-basement").each(function (){
                    if (!$(this).attr("uid"))
                        return;

                    var tqid = $(this).attr("qid");
                    var tuid = $(this).attr("uid");

                    var findvar = "#question-userpp-quid"+ tqid + "-uid" + tuid;

                    $.ajax({
                        url: getHost("/api/backend/ppmanager?action=getpp&uid=" + tuid),
                        success: (data) => {
                            setTimeout(() => {
                                //console.log("setted-" +findvar);
                                $(findvar).attr("src", data);
                            }, 800);
                        }
                    })
                });

            }
        },
        error: (v1, v2) => {
            console.log(v1);
            console.log(v2);
        }
    });
});