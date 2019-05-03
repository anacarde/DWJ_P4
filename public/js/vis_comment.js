function PostComment() {

    var self = this;

    this.form = document.getElementById("post_com_form");
    this.pseudo = document.getElementById("pseudo");
    this.comment = document.getElementById("comment");
    this.chpNb = document.getElementById("chapter_number").textContent.trim();
    this.span = null;

    this.callback = function(chpNb, response) {
        self.comment.value = "";

        if (Number(response) % 10 === 1) {
            var pagDiv = document.getElementById("com_pages");
            var button = document.createElement("button");
            button.classList.add("com_page_nb");
            button.textContent = String(Number(pagDiv.lastElementChild.textContent.trim()) + 1);
            button.addEventListener("click", Utils.ajaxGet.bind(this, "/" + self.chpNb + "/" + button.textContent, getComments.showCallback));
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
            sessionStorage.setItem("pseudo", this.pseudo.value);

            var formParams = "commentChapter=" + self.chpNb + "&author=" + self.pseudo.value + "&content=" + self.comment.value;

            Utils.ajaxPost("/post/" + self.chpNb , formParams, self.callback.bind(this, self.chpNb));
        })
    }
}

function GetComments() {

    var self = this;

    this.chpNb = document.getElementById("chapter_number").textContent.trim();

    this.signCallback = function(signButt) {

        if (!self.span) {
            self.span = document.createElement('span');
            self.span.classList.add('com_mark');
            self.span.innerHTML = ' &ensp; votre signalement a bien été pris en compte';
            signButt.after(self.span);

            setTimeout(function() {
                self.span.remove();
                self.span = null;
            }, 2000);
        }
    }

    this.showCallback = function(response) {

        var comments = JSON.parse(response);

        document.getElementById('com_lis_div').innerHTML = "";
        for (var comment in comments) {
            document.getElementById('com_lis_div').innerHTML += '<div id=\"com_hea_div\"> <h4>' + comments[comment]['author'] + '</h4> <em class="date"> ' + comments[comment]['date_added'] + '</em> <button data-id=\"' + comments[comment]['id'] + '\" class="com_sign"> signaler </button> </div> <p>'  + comments[comment]['content'] + '</p>';
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

var getComments = new GetComments();
getComments.init();

var postComment = new PostComment();
postComment.init();

