function scrollBack() {

    var chapterDiv = document.getElementById('chapter_reading');
    var chapterTop = document.getElementById("chapter_top");

    chapterTop.addEventListener("click", function(){
        chapterDiv.scrollTo ({
            top: 0,
            behavior: "smooth"
        })
    });
}

function PostComment() {

    var self = this;

    this.form = document.getElementById("post_com_form");

    this.ajaxPost = function(url, params, callback) {
        console.log(params);
        console.log(url);
        var req = new XMLHttpRequest();
        req.open("POST", url);
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

        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        req.send(params);
    }

    this.callback = function(chpNb, response) {
        // console.log('salut');
        // console.log(response);
        if (Number(response) % 10 === 1) {
            var button = document.createElement("button");
            button.classList.add("com_page_nb");
            button.textContent = String(Number(document.getElementById("comments_pages").lastElementChild.textContent.trim()) + 1);
            button.addEventListener("click", getComments.ajaxGet.bind(this, "/" + chpNb + "/" + button.textContent, getComments.callback));
            document.getElementById("comments_pages").appendChild(button);
        }
        getComments.ajaxGet("/" + chpNb + "/1", getComments.callback);
    }

    this.init = function() {

        this.form.addEventListener("submit", function(e) {
            e.preventDefault();

            var pseudo = document.getElementById("pseudo").value;
            var comment = document.getElementById("comment").value;
            var chpNb = document.getElementById("chapter_number").textContent.trim();
            var formParams = "commentChapter=" + chpNb + "&author=" + pseudo + "&content=" + comment;

            self.ajaxPost("/post/" + chpNb , formParams, self.callback.bind(this, chpNb));
        })
    }
}

function GetComments() {

    var self = this;

    this.chpNb = document.getElementById("chapter_number").textContent.trim();

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

    this.callback = function(response) {

        var comments = JSON.parse(response);

        document.getElementById('comments').innerHTML = "";
        for (var comment in comments) {
            document.getElementById('comments').innerHTML += '<h4>' + comments[comment]['author'] + '<em class="date"> ' + comments[comment]['date_added'] + '</em> </h4> <p>'  + comments[comment]['content'] + '</p>';
        }
    }

    this.initCommentPageEvents = function() {

        var cmPgLinks = document.getElementsByClassName("com_page_nb");

        for (var i = 0 ; i < cmPgLinks.length ; i++) {

            var url = "/" + this.chpNb + "/" + cmPgLinks[i].textContent.trim();

            cmPgLinks[i].addEventListener("click", self.ajaxGet.bind(this, url, self.callback));
        }
    }

    this.init = function() {

        this.initCommentPageEvents();

        var initUrl = "/" + this.chpNb + "/1";

        this.ajaxGet(initUrl, this.callback);
    }
};

scrollBack();

var getComments = new GetComments();

getComments.init();

var postComment = new PostComment();

postComment.init();


console.log(getComputedStyle(document.getElementById('chapter_reading')).overflowY);