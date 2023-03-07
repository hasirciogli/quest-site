$(document).ready(() => {

    $.ajax({
        url: getHost() + "/api/backend/quests",
        method: "POST",
        data: {
            "action": "list",
        },
        success: (data, status) => {
            console.log(data);

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

                        $("#qlist-1").append(itemx);
                    }
                })
            }
        },
        error: (v1, v2) => {
            console.log(v1);
            console.log(v2);
        }
    });
});