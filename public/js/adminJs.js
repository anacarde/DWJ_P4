function AdminEvents() {

    var self = this;

    this.body = document.querySelector("body");

    this.addChapterButton = document.getElementById('add_chapter_button');
    this.chaptersButton = document.getElementById('chapters_list_button');
    this.commentsButton = document.getElementById('comments_button');

    this.closeCross = document.getElementsByClassName('close_cross');
    this.chapNumb = document.getElementsByClassName('chap_numb');
    this.chapTitle = document.getElementsByClassName('chap_title');
    this.chapModif = document.getElementsByClassName('chap_modif');
    this.chapDelete = document.getElementsByClassName('chap_supp');

    this.commentAuthor = document.getElementsByClassName('comment_author');
    this.commentContent = document.getElementsByClassName('comment_content');
    this.commentModif = document.getElementsByClassName('com_modif');
    this.commentSupp = document.getElementsByClassName('com_sup');

    this.paramData = document.getElementById('param_data').getAttribute("data-param").trim();
    this.addChapterDiv = document.getElementById('add_chapter_div');
    this.addChapterForm = document.getElementById("add_chapter_form");
    this.chapterEditor  = document.getElementById("chapter_editor");
    this.commentFormDiv = document.getElementById('com_modif_back');
    this.commentForm = document.getElementById('com_modif_form');
    this.chaptersTable = document.getElementById('chapters_list_div');
    this.commentsTable = document.getElementById('comments_list_div');
    
    this.chapIdInp = document.getElementById('chap_id_input');
    this.chapNbInp = document.getElementById('chap_nb_input');
    this.chapTitInp = document.getElementById('chap_title_input');
    this.comSigInp = document.getElementById('com_sig_inp');
    this.comIdInp = document.getElementById('com_id_inp');
    this.comAuthInp = document.getElementById('com_auth_inp');
    this.comContArea = document.getElementById('com_cont_area');

    this.confMsg = document.getElementById('conf_msg');
    this.objInfo = document.getElementById('obj_info');
    this.actInfo = document.getElementById('act_info');

    this.addChapButtChecked = false; 
    this.chapButtChecked = false;
    this.comButtChecked = false;

    this.confirmPanel = function(obj, act) {
        this.objInfo.textContent = obj;
        this.actInfo.textContent = act;
        this.confMsg.classList.remove("hidden");

        setTimeout(function() {
            self.confMsg.classList.add("hidden");
        }, 2000)
    }

    this.setConfirmMsg = function() {

        var obj = "";
        var act = "";

        switch (this.paramData) {
            case 'chaAdd':
                obj = "Chapitre";
                act = "ajouté";
            break;
            case 'chaUpdate':
                obj = "Chapitre";
                act = "modifé";
                this.chaptersButton.classList.add("set_css");
                this.chaptersTable.classList.remove("hide");
                this.chapButtChecked = true;
            break;
            case 'chaDelete':
                obj = "Chapitre";
                act = "Supprimé";
                this.chaptersButton.classList.add("set_css");
                this.chaptersTable.classList.remove("hide");
                this.chapButtChecked = true;
            break;
            case 'comUpdate':
                obj = "Commentaire";
                act = "Modifié";
                this.commentsButton.classList.add("set_css");
                this.commentsTable.classList.remove("hide");
                this.comButtChecked = true;
            break;
            case 'comDelete':
                obj = "Commentaire";
                act = "Supprimé";
                this.commentsButton.classList.add("set_css");
                this.commentsTable.classList.remove("hide");
                this.comButtChecked = true;
            break;
        }
        
        this.confirmPanel(obj, act);
    }
 
    this.returnEditor = function(response) {
        tinymce.activeEditor.setContent(response);
    };

    this.addFormContent = function(chapId, chapNumb, chapTitle) {
        self.chapIdInp.value = chapId;
        self.chapNbInp.value = chapNumb;
        self.chapTitInp.value = chapTitle;
        self.addChapterButton.setAttribute("disabled", "");
        self.commentsButton.setAttribute("disabled", "");
        document.getElementById("content_label").textContent = "Modifiez le contenu de votre chapitre";
        document.getElementById("send_btn").value = "Modification de mon chapitre";
        self.addChapterForm.setAttribute("action", "/admin/chapter/update/" + chapId);
        self.addChapterDiv.classList.remove("hide");
        self.chaptersTable.classList.add("hide");
        self.addChapButtChecked = true;
        self.chapButtChecked = false;
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
        self.chapButtChecked = true; 
    };

    this.displayModifEditor = function(chapNumb, chapTitle) {
        // console.log(chapNumb);
        var chapId = chapNumb.getAttribute("data-id");
        // console.log(chapId);
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
        self.commentFormDiv.setAttribute("hidden", "");
    }


    this.commentModifArea = function(authorDiv, contentDiv) {
        var comId = authorDiv.getAttribute("data-id");
        self.commentForm.setAttribute("action", "/admin/comment/update/" + comId);
        Utils.ajaxGet('/admin/comment/select/' + comId, self.returnComData);
        self.commentFormDiv.removeAttribute("hidden");
    };

    this.closeAdminDivFn = function() {

        if(self.addChapButtChecked == true){
            self.addChapterDiv.classList.add("hide");
            self.addChapButtChecked = false;
            if (!self.addChapterButton.classList.contains("set_css")) {
                self.removeFormContent();
                return;
            }!
            self.addChapterButton.classList.remove("set_css");
            return;
        }
        if(self.chapButtChecked == true){
            self.chaptersButton.classList.remove("set_css");
            self.chaptersTable.classList.add("hide");
            self.chapButtChecked = false;
            return;
        }
        if(self.comButtChecked == true){
            if (!self.commentFormDiv.hasAttribute("hidden")) {
                self.removeCommentForm();
                return;
            }
            self.commentsButton.classList.remove("set_css");
            self.commentsTable.classList.add("hide");
            self.comButtChecked = false;
            return;
        }
    };

    this.displayEvents = function() {

        if (this.paramData != "") {
            // console.log(this.paramData);
            this.setConfirmMsg();
        }
        console.log(this.paramData);

        this.addChapterButton.addEventListener('click', function() {
            self.addChapterButton.classList.add("set_css");
            self.chaptersButton.classList.remove("set_css");
            self.commentsButton.classList.remove("set_css");
            self.addChapterDiv.classList.remove("hide");
            self.chaptersTable.classList.add("hide");
            self.commentsTable.classList.add("hide");
            self.addChapButtChecked = true; 
            self.chapButtChecked = false;
            self.comButtChecked = false;

        });

        this.chaptersButton.addEventListener('click', function() {
            self.addChapterButton.classList.remove("set_css");
            self.chaptersButton.classList.add("set_css");
            self.commentsButton.classList.remove("set_css");
            self.addChapterDiv.classList.add("hide");
            self.chaptersTable.classList.remove("hide");
            self.commentsTable.classList.add("hide");
            self.addChapButtChecked = false; 
            self.chapButtChecked = true;
            self.comButtChecked = false;
        });

        this.commentsButton.addEventListener('click', function() {
            self.addChapterButton.classList.remove("set_css");
            self.chaptersButton.classList.remove("set_css");
            self.commentsButton.classList.add("set_css");
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

var adminJs = new AdminEvents();

adminJs.init();
