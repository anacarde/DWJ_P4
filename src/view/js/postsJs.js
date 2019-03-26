var chapterDiv = document.getElementById('chapter_reading');
var chapterTop = document.getElementById("chapter_top");
chapterTop.addEventListener("click", function(){
    chapterDiv.scrollTo ({
        top: 0,
        behavior: "smooth"
    })
});