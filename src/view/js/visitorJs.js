var chapterDiv = document.getElementById('chapter_reading');
var chapterTop = document.getElementById("chapter_top");
chapterTop.addEventListener("click", function(){
    chapterDiv.scrollTo ({
        top: 0,
        behavior: "smooth"
    })
});

console.log("coco");

function GetComments() {

    // console.log('lala');

    var self = this;

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
        console.log(response);
        document.getElementById('comments_container').innerHTML = response;  
    }

    this.init = function() {
        this.ajaxGet("/1/1", this.callback);
    }
};

var comments = new GetComments();

comments.init();
