var body = document.getElementById("admin_body");

var addChapterButton = document.getElementById('add_chapter_button');
var chaptersButton = document.getElementById('chapters_list_button');
var commentsButton = document.getElementById('comments_button');

var addChapterDiv = document.getElementById('add_chapter_form');
var chaptersTable = document.getElementById('chapters_table');
var commentsTable = document.getElementById('comments_table');

var addChapButtChecked = false; 
var chapButtChecked = false;
var comButtChecked = false;

addChapterButton.addEventListener('click', function() {
    addChapterButton.classList.add("set_css");
    chaptersButton.classList.remove("set_css");
    commentsButton.classList.remove("set_css");
    addChapterDiv.classList.remove("hide");
    chaptersTable.classList.add("hide");
    commentsTable.classList.add("hide");
    addChapButtChecked = true; 
    chapButtChecked = false;
    comButtChecked = false;

});

chaptersButton.addEventListener('click', function() {
    addChapterButton.classList.remove("set_css");
    chaptersButton.classList.add("set_css");
    commentsButton.classList.remove("set_css");
    addChapterDiv.classList.add("hide");
    chaptersTable.classList.remove("hide");
    commentsTable.classList.add("hide");
    addChapButtChecked = false; 
    chapButtChecked = true;
    comButtChecked = false;
});

commentsButton.addEventListener('click', function() {
    addChapterButton.classList.remove("set_css");
    chaptersButton.classList.remove("set_css");
    commentsButton.classList.add("set_css");
    addChapterDiv.classList.add("hide");
    chaptersTable.classList.add("hide");
    commentsTable.classList.remove("hide");
    addChapButtChecked = false; 
    chapButtChecked = false;
    comButtChecked = true;
});

window.addEventListener('keydown', function(e){
    if(e.keyCode == 27) {
        if(addChapButtChecked == true){
            addChapterButton.classList.remove("set_css");
            addChapterDiv.classList.add("hide");
            addChapButtChecked = false; 
            return;
        }
        if(chapButtChecked == true){
            chaptersButton.classList.remove("set_css");
            chaptersTable.classList.add("hide");
            chapButtChecked = false;
            return;
        }
        if(comButtChecked == true){
            commentsButton.classList.remove("set_css");
            commentsTable.classList.add("hide");
            comButtChecked = false;
            return;
        }
    }

});