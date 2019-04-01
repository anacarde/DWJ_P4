function AdminEvents() {

    var self = this;

    this.body = document.getElementById("admin_body");
    this.addChapterButton = document.getElementById('add_chapter_button');
    this.chaptersButton = document.getElementById('chapters_list_button');
    this.commentsButton = document.getElementById('comments_button');
    this.closeCross = document.getElementsByClassName('close_cross');

    this.addChapterDiv = document.getElementById('add_chapter_form');
    this.chaptersTable = document.getElementById('chapters_list_div');
    this.commentsTable = document.getElementById('comments_list_div');

    this.addChapButtChecked = false; 
    this.chapButtChecked = false;
    this.comButtChecked = false;

    this.closeAdminDivFn = function() {

        if(self.addChapButtChecked == true){
                self.addChapterButton.classList.remove("set_css");
                self.addChapterDiv.classList.add("hide");
                self.addChapButtChecked = false; 
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

        for (var i = 0 ; i < this.closeCross.length ; i++) {
            this.closeCross[i].addEventListener("click", this.closeAdminDivFn);
        }

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
