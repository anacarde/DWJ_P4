function AdminEvents() {

    var self = this;

    this.body = document.getElementById("admin_body");

    this.addChapterButton = document.getElementById('add_chapter_button');
    this.chaptersButton = document.getElementById('chapters_list_button');
    this.commentsButton = document.getElementById('comments_button');

    this.closeCross = document.getElementsByClassName('close_cross');
    this.chapId = document.getElementsByClassName('chap_id');
    this.chapNumb = document.getElementsByClassName('chap_numb');
    this.chapTitle = document.getElementsByClassName('chap_title');
    this.chapModif = document.getElementsByClassName('chap_modif');
    this.chapDelete = document.getElementsByClassName('chap_supp');

    this.addChapterDiv = document.getElementById('add_chapter_div');
    this.addChapterForm = document.getElementById("add_chapter_form");
    this.chapterEditor  = document.getElementById("chapter_editor");
    this.chaptersTable = document.getElementById('chapters_list_div');
    this.commentsTable = document.getElementById('comments_list_div');
    this.idInput = document.getElementById('id_input');
    this.nbInput = document.getElementById('nb_input');
    this.titleInput = document.getElementById('title_input');

    this.addChapButtChecked = false; 
    this.chapButtChecked = false;
    this.comButtChecked = false;

    this.ajaxGet = function(url, callback) {
        var req = new XMLHttpRequest();
        req.open("GET", url);
        req.addEventListener("load", function() {
            if (req.status >= 200 && req.status < 400) {
               callback(req.responseText);
            } else {
               console.error(req.status + " " + req.statusText + " " + url);
            }
        });
        req.addEventListener("error", function() {
            console.error("Erreur réseau avec l'URL " + url);
        });
        req.send(null);
    }

    this.returnEditor = function(response) {
        tinymce.activeEditor.setContent(response);
    }

    this.addFormContent = function(chapId, chapNumb, chapTitle) {
        self.idInput.value = chapId;
        self.nbInput.value = chapNumb;
        self.titleInput.value = chapTitle;
        self.addChapterButton.setAttribute("disabled", "");
        self.commentsButton.setAttribute("disabled", "");
        document.getElementById("content_label").textContent = "Modifiez le contenu de votre chapitre";
        document.getElementById("send_btn").value = "Modification de mon chapitre";
        self.addChapterForm.setAttribute("action", "/update/" + chapId);
        self.addChapterDiv.classList.remove("hide");
        self.chaptersTable.classList.add("hide");
        self.addChapButtChecked = true;
        self.chapButtChecked = false;
    }

    this.removeFormContent = function() {
        self.idInput.value = "";
        self.nbInput.value = "";
        self.titleInput.value = "";
        tinymce.activeEditor.setContent("");
        document.getElementById("content_label").textContent = "Entrez le contenu de votre chapitre";
        document.getElementById("send_btn").value = "Envoi de mon chapitre";
        self.addChapterForm.setAttribute("action", "/add");
        self.addChapterButton.removeAttribute("disabled");
        self.commentsButton.removeAttribute("disabled");
        self.chaptersTable.classList.remove("hide");
        self.chapButtChecked = true; 
    }

    this.displayModifEditor = function(chapId, chapNumb, chapTitle) {
        self.ajaxGet('/admin/form/' + chapId, self.returnEditor);
        this.addFormContent(chapId, chapNumb, chapTitle);
    }

    this.closeAdminDivFn = function() {

        if(self.addChapButtChecked == true){
            self.addChapterDiv.classList.add("hide");
            self.addChapButtChecked = false;
            if (!self.addChapterButton.classList.contains("set_css")) {
                self.removeFormContent();
            } else {
                self.addChapterButton.classList.remove("set_css");
            }
            return;
        }
        if(self.chapButtChecked == true){
            self.chaptersButton.classList.remove("set_css");
            self.chaptersTable.classList.add("hide");
            self.chapButtChecked = false;
            return;
        }
        if(self.comButtChecked == true){
            self.commentsButton.classList.remove("set_css");
            self.commentsTable.classList.add("hide");
            self.comButtChecked = false;
            return;
        }
    }

    this.displayEvents = function() {

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
            this.chapModif[i].addEventListener("click", this.displayModifEditor.bind(this, this.chapId[i].textContent.trim(), this.chapNumb[i].textContent.trim(), this.chapTitle[i].textContent.trim()))
        };

        for (var i = 0 ; i < this.closeCross.length ; i++) {
            this.closeCross[i].addEventListener("click", this.closeAdminDivFn);
        };

        window.addEventListener('keydown', function(e){
            if(e.keyCode == 27) {
                self.closeAdminDivFn();
            }
        });
    }

    this.init = function() {
        this.displayEvents();
    }
}

var adminJs = new AdminEvents();

adminJs.init();
