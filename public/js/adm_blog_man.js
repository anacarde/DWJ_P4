function AdminManager() {

    var self = this;

    this.body = document.querySelector("body");

    this.addChapterButton = document.getElementById('chap_add');
    this.chaptersButton = document.getElementById('chap_modif');
    this.commentsButton = document.getElementById('com_modif');

    this.closeCross = document.getElementsByClassName('close_p');
    this.chapNumb = document.getElementsByClassName('chap_numb');
    this.chapTitle = document.getElementsByClassName('chap_title');
    this.chapModif = document.getElementsByClassName('chap_modif');
    this.chapDelete = document.getElementsByClassName('chap_supp');

    this.commentAuthor = document.getElementsByClassName('comment_author');
    this.commentContent = document.getElementsByClassName('comment_content');
    this.commentModif = document.getElementsByClassName('com_modif');
    this.commentSupp = document.getElementsByClassName('com_supp');

    this.addChapterDiv = document.getElementById('add_chapter_div');
    this.addChapterForm = document.getElementById("add_chapter_form");
    this.chapterEditor  = document.getElementById("chap_edit");
    this.commentFormDiv = document.getElementById('com_modif_back');
    this.commentForm = document.getElementById('com_modif_form');
    this.chaptersTable = document.getElementById('chap_list_div');
    this.commentsTable = document.getElementById('com_list_div');
    
    this.chapIdInp = document.getElementById('chap_id_input');
    this.chapNbInp = document.getElementById('chap_nb_input');
    this.chapTitInp = document.getElementById('chap_title_input');
    this.comSigInp = document.getElementById('com_sig_inp');
    this.comIdInp = document.getElementById('com_id_inp');
    this.comAuthInp = document.getElementById('com_auth_inp');
    this.comContArea = document.getElementById('com_cont_area');

    this.addChapButtChecked = false; 
    this.chapButtChecked = false;
    this.comButtChecked = false;
 
    this.returnEditor = function(response) {
        tinymce.activeEditor.setContent(response);
    };

    this.addFormContent = function(chapId, chapNumb, chapTitle) {
        self.chapIdInp.value = chapId;
        self.chapNbInp.value = chapNumb;
        self.chapTitInp.value = chapTitle;
        self.addChapterButton.setAttribute("disabled", "");
        self.commentsButton.setAttribute("disabled", "");
        document.getElementById("content_label").textContent = "Modifiez le contenu de votre chapitre :";
        document.getElementById("send_btn").value = "Modification de mon chapitre";
        self.addChapterForm.setAttribute("action", "/admin/chapter/update/" + chapId);
        self.addChapterDiv.classList.remove("hide");
        self.chaptersTable.classList.add("hide");
        self.addChapButtChecked = true;
    };

    this.removeFormContent = function() {
        self.chapIdInp.value = "";
        self.chapNbInp.value = "";
        self.chapTitInp.value = "";
        tinymce.activeEditor.setContent("");
        document.getElementById("content_label").textContent = "Entrez le contenu de votre chapitre";
        document.getElementById("send_btn").value = "Envoi de mon chapitre";
        self.addChapterForm.setAttribute("action", "/admin/chapter/add");
        self.addChapterButton.removeAttribute("disabled");
        self.commentsButton.removeAttribute("disabled");
        self.chaptersTable.classList.remove("hide");
        self.addChapButtChecked = false;
    };

    this.displayModifEditor = function(chapNumb, chapTitle) {
        var chapId = chapNumb.getAttribute("data-id");
        var chapNumb = chapNumb.textContent.trim();
        Utils.ajaxGet('/admin/chapter/select/' + chapId, self.returnEditor);
        self.addFormContent(chapId, chapNumb, chapTitle);
    };

    this.returnComData = function(response) {
        var comData = JSON.parse(response);
        self.comSigInp.value = comData.signaled;
        self.comIdInp.value = comData.id;
        self.comAuthInp.value = comData.author;
        self.comContArea.textContent = comData.content;
    }

    this.removeCommentForm = function() {
        self.comSigInp.value = "";
        self.comIdInp.value = "";
        self.comAuthInp.value = "";
        self.comContArea.textContent = "";
        self.commentFormDiv.classList.add("hide");
    }


    this.commentModifArea = function(authorDiv, contentDiv) {
        var comId = authorDiv.getAttribute("data-id");
        self.commentForm.setAttribute("action", "/admin/comment/update/" + comId);
        Utils.ajaxGet('/admin/comment/select/' + comId, self.returnComData);
        self.commentFormDiv.classList.remove("hide");
    };

    this.closeAdminDivFn = function() {

        if(self.addChapButtChecked == true){
            self.addChapterDiv.classList.add("hide");
            self.addChapButtChecked = false;
            return;
        }
        if(self.chapButtChecked == true){
            self.chaptersTable.classList.add("hide");
            self.chapButtChecked = false;
            return;
        }
        if(self.comButtChecked == true){
            if (!self.commentFormDiv.classList.contains("hide")) {
                self.removeCommentForm();
                return;
            }
            self.commentsTable.classList.add("hide");
            self.comButtChecked = false;
            return;
        }
    };

    this.displayEvents = function() {

        this.addChapterButton.addEventListener('click', function() {
            self.addChapterDiv.classList.remove("hide");
            self.chaptersTable.classList.add("hide");
            self.commentsTable.classList.add("hide");
            self.addChapButtChecked = true; 
            self.chapButtChecked = false;
            self.comButtChecked = false;

        });

        this.chaptersButton.addEventListener('click', function() {
            self.addChapterDiv.classList.add("hide");
            self.chaptersTable.classList.remove("hide");
            self.commentsTable.classList.add("hide");
            self.addChapButtChecked = false; 
            self.chapButtChecked = true;
            self.comButtChecked = false;
        });

        this.commentsButton.addEventListener('click', function() {
            self.addChapterDiv.classList.add("hide");
            self.chaptersTable.classList.add("hide");
            self.commentsTable.classList.remove("hide");
            self.addChapButtChecked = false; 
            self.chapButtChecked = false;
            self.comButtChecked = true;
        });

        for (var i = 0 ; i < this.chapModif.length ; i++) {
            this.chapModif[i].addEventListener("click", this.displayModifEditor.bind(this, this.chapNumb[i], this.chapTitle[i].textContent.trim()))
        };

        for (var i = 0 ; i < this.closeCross.length ; i++) {
            this.closeCross[i].addEventListener("click", this.closeAdminDivFn);
        };

        for (var i = 0 ; i < this.commentModif.length ; i++) {
            this.commentModif[i].addEventListener("click", this.commentModifArea.bind(this, this.commentAuthor[i], this.commentContent[i]));
        }

        window.addEventListener('keydown', function(e){
            if(e.keyCode == 27) {
                self.closeAdminDivFn();
            }
        });
    };

    this.init = function() {
        this.displayEvents();
    };
}

var adminManager = new AdminManager();

adminManager.init();
