var chapterDiv = document.getElementById('chapter_reading');
var chapterTop = document.getElementById("chapter_top");
chapterTop.addEventListener("click", function(){
    chapterDiv.scrollTo ({
        top: 0,
        behavior: "smooth"
    })
});

function GetComments() {

    // console.log('lala');

    var self = this;

    var chpNb = document.getElementById("chapter_number").textContent;

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
        document.getElementById('comments').innerHTML = response;
        // console.log(response);
    }

    this.callbackInit = function(response) {
        document.getElementById('comments').innerHTML = response;

        var cmPgLinks = document.getElementsByClassName("com_page_nb");

        for (var i = 0 ; i < cmPgLinks.length ; i++) {

            var url = "/" + chpNb + "/" + cmPgLinks[i].textContent.trim();

            cmPgLinks[i].addEventListener("click", self.ajaxGet.bind(this, url, self.callback));
        }
    }

    this.init = function() {
        var initUrl = "/" + chpNb + "/1";
        // console.log(initUrl);
        this.ajaxGet(initUrl, this.callbackInit);
    }
};

var comments = new GetComments();

comments.init();
