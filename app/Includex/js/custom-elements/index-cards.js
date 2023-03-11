class HaberText extends HTMLElement {
    connectedCallback() {
        this.questionId = (parseInt(this.getAttribute("qid")));
        this.isUserSecret = (parseInt(this.getAttribute("is-secret")));
        this.questionUserStatus = (parseInt(this.getAttribute("user-status")));
        this.isUserMan = (parseInt(this.getAttribute("is-man")));
        this.questionBaseImage = this.getAttribute("base-image") == "" || !this.getAttribute("base-image") ? getHost("/storage/image/site-images/noimage-2.png") : this.getAttribute("base-image");
        this.questionUserImage = this.isUserSecret ? (this.isUserMan ? getHost("/storage/image/site-images/user-man.png") : getHost("/storage/image/site-images/user-woman.png")) : (this.isUserMan ? getHost("/storage/image/site-images/user-man.png") : getHost("/storage/image/site-images/user-woman.png"));
        this.questionBaseHeader = this.getAttribute("base-header") ?? "undefined";
        this.questionBaseContent = this.getAttribute("base-content") ?? "undefined";
        this.questionBaseSharedDate =  this.getAttribute("base-created-at") ?? "we dont know";
        this.questionBaseTotalReadMinute =  this.getAttribute("base-read-min") ?? "we dont know";

        if (this.questionBaseTotalReadMinute < 1)
            this.questionBaseTotalReadMinute = "1 saniye"
        else if (this.questionBaseTotalReadMinute > 60)
        {
            this.questionBaseTotalReadMinute = this.questionBaseTotalReadMinute / 60;
            this.questionBaseTotalReadMinute += " Dakika";
        }
        else if (this.questionBaseTotalReadMinute > (60 * 60))
        {
            this.questionBaseTotalReadMinute = this.questionBaseTotalReadMinute / (60 * 60);
            this.questionBaseTotalReadMinute += " Saat";
        }
        else{
            this.questionBaseTotalReadMinute = Math.floor(this.questionBaseTotalReadMinute);
            this.questionBaseTotalReadMinute += " Saniye"
        }


        this.questionUserBadge = `
                    <img
                        title="${this.questionUserStatus == 0 ? "YASAKLANMIŞ Hesap!" : this.questionUserStatus == 2 ? "Doğrulanmış Hesap!" : this.questionUserStatus == 3 ? "Özel Hesap" : this.questionUserStatus == 10 ? "Yönetici Hesabı" : "Yeni Üye"}"
                        src="${this.questionUserStatus == 0 ? getHost("/storage/image/site-images/block.png") : this.questionUserStatus == 2 ? getHost("/storage/image/site-images/verify1.png") : this.questionUserStatus == 3 ? getHost("/storage/image/site-images/approved-red.png") : this.questionUserStatus == 10 ? getHost("/storage/image/site-images/shield1.png") : getHost("/storage/image/site-images/clover.png")}"
                        class="h-5 ml-1"
                    />
                `;

        this.questionUserName = this.getAttribute("user-name");
        this.questionUserUserName = this.getAttribute("user-surname");
        this.questionUser = this.isUserSecret ? "Gizli üye" : this.questionUserName + " " + this.questionUserUserName;
        this.innerHTML = `

                <div class="w-full">
                <a href="/quest/${this.questionId}" class="relative block overflow-hidden rounded-lg border dark:bg-dc-100 dark:border-1 border-gray-200 shadow-md dark:shadow-none dark:border-dhover-400">

                <img
                        alt="${this.questionBaseImage}"
                        src="${this.questionBaseImage}"
                        loading='lazy'
                        class="h-56 w-full object-cover mb-5 dark:border-b dark:border-b-dhover-300 ${this.questionBaseImage == "" || !this.questionBaseImage ? "" : ""}"
                        onerror="this.onerror=null; this.src='/storage/image/site-images/noimage-2.png'"
                />

                <div class="p-4 sm:p-6 lg:p-8">
                    <!--<span class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600" ></span>-->

                    <div class="sm:flex sm:justify-between sm:gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 sm:text-lg dark:text-white">
                                ${this.questionBaseHeader}
                            </h3>

                            <div class="flex flex-row items-center mt-1">
                                <p class="text-xs font-medium text-gray-600 dark:text-white ${this.questionUserStatus == 0 ? "line-through decoration-black" : ""}">&#x2022; ${this.questionUser}</p>
                                ${this.questionUserBadge}
                            </div>

                        </div>

                        <div class="hidden sm:block sm:shrink-0">
                            <img
                                    loading='lazy'
                                    src="${this.questionUserImage}"
                                    title="${this.isUserSecret ? "Gizli üye :)" : this.questionUserName }"
                                    class="h-16 w-16 rounded-lg object-cover shadow-sm"
                            />
                        </div>
                    </div>

                    <div class="mt-5">
                        <p class="max-w-[40ch] text-sm text-gray-500 dark:text-white">
                           ${this.questionBaseContent}
                        </p>
                    </div>

                    <dl class="mt-10 flex gap-4 sm:gap-6">
                        <div class="flex flex-col-reverse">
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-100 mt-1">Paylaşıldı</dt>
                            <dd class="text-xs text-gray-500 dark:text-white mt-1">${this.questionBaseSharedDate}</dd>
                        </div>

                        <div class="flex flex-col-reverse">
                            <dt class="text-sm font-medium text-gray-600 dark:text-gray-100 mt-1">Okuma Süresi</dt>
                            <dd class="text-xs text-gray-500 dark:text-white">${this.questionBaseTotalReadMinute}</dd>
                        </div>
                    </dl>
                </div>

            </a>
        </div>

                `;
        this.style.color = "red";
    }
}

customElements.define('mainmenu-question-basement', HaberText);