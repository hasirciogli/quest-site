class QuestCommentText extends HTMLElement {
    connectedCallback() {
        this.commentId = (parseInt(this.getAttribute("c-id") ?? -1));
        this.isUserSecret = (parseInt(this.getAttribute("c-is-secret") ?? 0)) == 1;
        this.commentUserStatus = (parseInt(this.getAttribute("user-status") ?? 0));
        this.isUserMan = (parseInt(this.getAttribute("c-is-man") ?? 0)) == 1;
        this.commentUserImage = this.isUserSecret ? (this.isUserMan ? getHost("/storage/image/site-images/user-man.png") : getHost("/storage/image/site-images/user-woman.png")) : (this.isUserMan ? getHost("/storage/image/site-images/user-man.png") : getHost("/storage/image/site-images/user-woman.png"));
        this.commentContent = this.getAttribute("c-content") ?? "undefined";
        this.commentSharedDate = this.getAttribute("c-created-at") ?? "not calculated";
        this.isCommentLikedByMe = parseInt(this.getAttribute("c-liked-by-me") ?? 0) == 1;
        this.commentViewCount = parseInt(this.getAttribute("c-view-count") ?? 0);

        this.commentUserBadge = `
                    <img
                        title="${this.questionUserStatus == 0 ? "YASAKLANMIŞ Hesap!" : this.questionUserStatus == 2 ? "Doğrulanmış Hesap!" : this.questionUserStatus == 3 ? "Özel Hesap" : this.questionUserStatus == 10 ? "Yönetici Hesabı" : "Yeni Üye"}"
                        src="${this.questionUserStatus == 0 ? getHost("/storage/image/site-images/block.png") : this.questionUserStatus == 2 ? getHost("/storage/image/site-images/verify1.png") : this.questionUserStatus == 3 ? getHost("/storage/image/site-images/approved-red.png") : this.questionUserStatus == 10 ? getHost("/storage/image/site-images/shield1.png") : getHost("/storage/image/site-images/clover.png")}"
                        class="h-5 ml-1"
                    />
                `;

        this.questionUserName = this.getAttribute("c-user-name") ?? "undefined";
        this.questionUserUserName = this.getAttribute("c-user-surname") ?? "undefined";
        this.questionUser = this.isUserSecret ? "Gizli üye" : this.questionUserName + " " + this.questionUserUserName;

        this.innerHTML = `

                        <div class="mt-4 mb-2 flex w-full min-h-[30px] sm:min-h-[40px] rounded overflow-hidden border dark:border-dhover-400 dark:shadow-dhover-500 shadow duration-300 transition-all">
                            <div class="hidden sm:flex justify-center duration-300 transition-all">
                                <img
                                        class="m-2 w-[60px] h-[60px] duration-300 transition-all"
                                        src="${this.commentUserImage}"
                                        alt=""
                                        onerror="this.onerror=null; this.src='<?php echo $nLink;?>'"
                                >
                            </div>
                            <div class="border-l dark:border-dhover-300 dark:shadow-dhover-500 flex flex-col w-full h-full duration-300 transition-all dark:text-white">
        
                                <span class="text-xs sm:text-xs fffonts-golostext text-black border-b dark:border-dhover-300 px-2 py-2 dark:text-white">${this.isUserSecret ? 'Gizli kullanıcımız' : '<a href="hover:text-green-500" class="">' + this.questionUserName + '</a>'} dedi ki</span>
        
                                <div class="text-xs sm:text-base w-full min-h-[30px] sm:min-h-[40px] mt-2 px-2 p-1 duration-300 transition-all">
                                    <p class="text-xs">
                                        l pqwleqwlple pqlwpel qpwl pqlweplqpwelp qwl pl pqwlep qwlpl pql pqwlepwql pwqle pqwl pqwlep lqwpl pqwl leqwpel wq
                                    </p>
                                </div>
        
                                <div class="text-sm sm:text-base flex w-full justify-between text-xs mt-3 duration-300 transition-all   p-2">
                                    <div class="text-xs">
                                        <span class="comment-view-number">${new Intl.NumberFormat("de-DE").format(this.commentViewCount)}</span> View
                                    </div>
                                    <div class="flex flex-row">
                                          <div class="mr-2 text-xs comment-likes-count">22558 Likes</div>                          
                                          ${this.isCommentLikedByMe ? '<img src="/storage/image/site-images/hearth-yellow.png" class="comment-make-unlike w-4 h-4 hover:cursor-pointer" comment-id="${this.commentId}">' : '<img src="/storage/image/site-images/hearth-blank.png" class="comment-make-like w-4 h-4 hover:cursor-pointer" comment-id="${this.commentId}">'}
                                    </div>
                                </div>
        
                            </div>
                        </div>

                `;

        this.style.color = "";
    }
}

customElements.define('quest-comment', QuestCommentText);