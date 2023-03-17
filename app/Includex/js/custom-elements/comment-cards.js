class QuestCommentText extends HTMLElement {
    connectedCallback() {
        this.commentId = (parseInt(this.getAttribute("c-id") ?? -1));
        this.userId = (parseInt(this.getAttribute("c-uid") ?? -1));
        this.isUserSecret = (parseInt(this.getAttribute("c-is-secret") ?? 0)) == 1;
        this.isUserOwned = (this.getAttribute("c-is-own") ?? false) == 1 ? true : false;
        this.commentUserStatus = (parseInt(this.getAttribute("c-user-status") ?? 0));
        this.isUserMan = (parseInt(this.getAttribute("c-is-man") ?? 0)) == 1;
        this.commentUserImage = this.isUserSecret ? (this.isUserMan ? getHost("/storage/image/site-images/user-man.png") : getHost("/storage/image/site-images/user-woman.png")) : (this.getAttribute("c-user-image"));
        this.onErrorUserImage = this.isUserMan ? getHost("/storage/image/site-images/user-man.png") : getHost("/storage/image/site-images/user-woman.png");
        this.commentContent = this.getAttribute("c-content") ?? "undefined";
        this.commentSharedDate = this.getAttribute("c-created-at") ?? "not calculated";
        this.isCommentLikedByMe = parseInt(this.getAttribute("c-liked-by-me") ?? 0) == 1;
        this.commentViewCount = parseInt(this.getAttribute("c-view-count") ?? 0);

        this.commentUserBadge = `
                    <img
                        title="${this.commentUserStatus == 0 ? "YASAKLANMIŞ Hesap!" : this.commentUserStatus == 2 ? "Doğrulanmış Hesap!" : this.commentUserStatus == 3 ? "Özel Hesap" : this.commentUserStatus == 10 ? "Yönetici Hesabı" : "Yeni Üye"}"
                        src="${this.commentUserStatus == 0 ? getHost("/storage/image/site-images/block.png") : this.commentUserStatus == 2 ? getHost("/storage/image/site-images/verify1.png") : this.commentUserStatus == 3 ? getHost("/storage/image/site-images/approved-red.png") : this.commentUserStatus == 10 ? getHost("/storage/image/site-images/shield1.png") : getHost("/storage/image/site-images/clover.png")}"
                        class="h-4 mx-1"
                    />
                `;


        this.questionUserName = this.getAttribute("c-user-name") ?? "undefined";
        this.questionUser = this.isUserSecret ? "Gizli üye" : this.questionUserName;
        this.likesCount = (parseInt(this.getAttribute("c-likes-count") ?? 0));

        this.questionUserName += this.commentUserBadge;

        this.innerHTML = `

                        <div class="mt-4 mb-2 flex w-full min-h-[30px] sm:min-h-[40px] rounded overflow-hidden border dark:border-dhover-400 dark:shadow-dhover-500 shadow duration-300 transition-all">
                            <div class="hidden sm:flex justify-center duration-300 transition-all">
                                <img
                                        class="m-2 w-[60px] ${this.isUserSecret ? "" : ("qlinkbase-image-" + this.userId)} h-[60px] rounded-full duration-300 transition-all"
                                        src="${this.isUserSecret ? this.commentUserImage : getLoaderGifLink()}"
                                        alt=""
                                        onerror="this.onerror=null; this.src='${this.onErrorUserImage}'"
                                >
                            </div>
                            <div class="border-l dark:border-dhover-300 dark:shadow-dhover-500 flex flex-col w-full h-full duration-300 transition-all dark:text-white">
        
                                <span class="text-xs sm:text-xs fffonts-golostext text-black border-b dark:border-dhover-300 px-2 py-2 dark:text-white flex flex-row">${this.isUserSecret ? 'Gizli kullanıcımız' : '<a href="hover:text-green-500" class="flex flex-row">' + this.questionUserName + '</a>'} dedi ki</span>
        
                                <div class="text-xs sm:text-base w-full min-h-[30px] sm:min-h-[40px] mt-2 px-2 p-1 duration-300 transition-all">
                                    <p class="text-xs">
                                        ${this.commentContent}
                                    </p>
                                </div>
        
                                <div class="text-sm sm:text-base flex w-full justify-between text-xs mt-3 duration-300 transition-all   p-2">
                                    <div class="text-xs">
                                        <span class="comment-view-number">${new Intl.NumberFormat("de-DE").format(this.commentViewCount)}</span> View
                                    </div>
                                    ${
                                    this.isUserOwned ?
                                        (' <div class="flex flex-row text-xs"> <span class="text-xs text-white hover:underline hover:cursor-pointer mr-2 edit-that-comment" cid="'+this.commentId+'">düzenle</span><span class="text-xs text-red-600 hover:underline hover:cursor-pointer delete-that-comment"  cid="'+this.commentId+'">sil</span> </div>')
                                        :
                                        ("")
                                    }
                                    
                                    <!--<div class="flex flex-row">
                                          <div class="mr-2 text-xs comment-likes-count">${this.likesCount} Likes</div>
                                    </div>-->
                                </div>
        
                            </div>
                        </div>

                `;

        this.style.color = "";
    }
}

customElements.define('quest-comment', QuestCommentText);