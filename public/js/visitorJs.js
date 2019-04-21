

function OtherFeatures() {

    this.scrollBack = function() {

        var chapterDiv = document.getElementById('chapter_reading');
        var chapterTop = document.getElementById("chapter_top");

        chapterTop.addEventListener("click", function() {
            chapterDiv.scrollTo ({
                top: 0,
                behavior: "smooth"
            })
        });

        if (chapterDiv.clientHeight < chapterDiv.scrollHeight) {
            chapterTop.removeAttribute("hidden");
        }
    }

    this.init = function() {
        this.scrollBack();
    }

}

function PostComment() {

    var self = this;

    this.form = document.getElementById("post_com_form");
    this.pseudo = document.getElementById("pseudo");
    this.comment = document.getElementById("comment");
    this.chpNb = document.getElementById("chapter_number").textContent.trim();

    this.callback = function(chpNb, response) {
        self.comment.value = "";

        if (Number(response) % 10 === 1) {
            var pagDiv = document.getElementById("comments_pages");
            var button = document.createElement("button");
            button.classList.add("com_page_nb");
            button.textContent = String(Number(pagDiv.lastElementChild.textContent.trim()) + 1);
            button.addEventListener("click", Utils.ajaxGet.bind(this, "/" + self.chpNb + "/" + button.textContent, getComments.callback));
            pagDiv.appendChild(button);
        }

        Utils.ajaxGet("/" + self.chpNb + "/1", getComments.showCallback);
    }

    this.init = function() {

        if (sessionStorage.getItem("pseudo")) {
            this.pseudo.value = sessionStorage.getItem("pseudo");
        }

        this.form.addEventListener("submit", function(e) {
            e.preventDefault();
            sessionStorage.setItem("pseudo", pseudo);

            var formParams = "commentChapter=" + self.chpNb + "&author=" + self.pseudo.value + "&content=" + self.comment.value;

            Utils.ajaxPost("/post/" + self.chpNb , formParams, self.callback.bind(this, self.chpNb));
        })
    }
}

function GetComments() {

    var self = this;

    this.chpNb = document.getElementById("chapter_number").textContent.trim();

    this.signCallback = function(signButt) {

        var span = document.createElement('span');
        span.classList.add('com_mark');
        span.textContent = 'votre signalement a bien été pris en compte';
        signButt.after(span);

        setTimeout(function() {
            span.remove();
        }, 2000);
    }

    this.showCallback = function(response) {

        var comments = JSON.parse(response);

        document.getElementById('comments').innerHTML = "";
        for (var comment in comments) {
            document.getElementById('comments').innerHTML += '<div id=\"com_hea_div\"> <h4>' + comments[comment]['author'] + '</h4> <em class="date"> ' + comments[comment]['date_added'] + '</em> <button data-id=\"' + comments[comment]['id'] + '\" class="com_sign"> signaler </button> </div> <p>'  + comments[comment]['content'] + '</p>';
        }

        var signButt = document.getElementsByClassName('com_sign');

        for (var i = 0 ; i < signButt.length ; i++) {

            var comId = signButt[i].getAttribute("data-id");
            var url = "/signal/" + String(signButt[i].getAttribute("data-id").trim());

            signButt[i].addEventListener("click", Utils.ajaxGet.bind(this, url, self.signCallback.bind(this, signButt[i])));
        }    
    }

    this.initCommentPageEvents = function() {

        var cmPgLinks = document.getElementsByClassName("com_page_nb");

        for (var i = 0 ; i < cmPgLinks.length ; i++) {

            var url = "/" + this.chpNb + "/" + cmPgLinks[i].textContent.trim();

            cmPgLinks[i].addEventListener("click", Utils.ajaxGet.bind(this, url, self.showCallback));
        }
    }

    this.init = function() {

        this.initCommentPageEvents();

        var initUrl = "/" + this.chpNb + "/1";

        Utils.ajaxGet(initUrl, this.showCallback);
    }
};

function AdminConnexion() {

    var self = this;
    var passInpLab = document.getElementById("pass_inp_lab");

    this.switchLab = false;

    this.closeForm = function() {

        document.getElementById("pass_form_back").setAttribute("hidden","");
    }

    this.closeFormEvts = function() {
        document.getElementById("close_cross").addEventListener('click', this.closeForm);

        window.addEventListener('keydown', function(e){
            if(e.keyCode == 27) {
                self.closeForm();
            }
        })
    }

    this.openForm = function() {

        document.getElementById("admin_access").addEventListener('click', function() {
            document.getElementById("pass_form_back").removeAttribute("hidden","");
        })
    }

    this.resetLabelOnFocus = function() {
        document.getElementById('pass_inp').addEventListener("focus", function() {
            // console.log('la');
            if (self.switchLab) {
                // console.log('ici');
                passInpLab.textContent = "Tapez votre mot de passe administrateur :";
                self.switchLab = false;
            }
        })
    }

    this.callback = function(response) {
        passInpLab.textContent = response;
        self.switchLab = true;
        if (response.includes("Connexion")) {
            window.location = "/admin";
        }
    }

    this.connexionQuery = function(param) {
        Utils.ajaxPost('/adminConnexion', param, self.callback);
    }

    this.connexionQueryEvt = function() {
        document.getElementById("pass_ask_form").addEventListener("submit", function(e) {
            e.preventDefault();
            var passInp = document.getElementById("pass_inp").value.trim();
            if (passInp == "") {
                passInpLab.textContent = "Le champ est vide !";
                self.switchLab = true;
                return;   
            }
            var param = 'passInp=' + passInp;
            self.connexionQuery(param);
        })
    }

    this.init = function() {
        this.closeFormEvts();
        this.openForm();
        this.resetLabelOnFocus();
        this.connexionQueryEvt();
    }
};

var features = new OtherFeatures();
features.init();

var getComments = new GetComments();
getComments.init();

var postComment = new PostComment();
postComment.init();

var adminConnexion = new AdminConnexion();
adminConnexion.init();
