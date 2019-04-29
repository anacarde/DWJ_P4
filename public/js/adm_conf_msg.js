function ConfMsg() {

    var self = this;

    this.confMsgCont = document.getElementById('conf_msg_cont');
    this.dataAction = document.getElementById('conf_msg_cont').getAttribute("data-action").trim();
    this.objInfo = document.getElementById('obj_info');
    this.actInfo = document.getElementById('act_info');

    this.confirmPanel = function(obj, act) {
        this.objInfo.textContent = obj;
        this.actInfo.textContent = act;
        this.confMsgCont.classList.remove("hide");

        setTimeout(function() {
            self.confMsgCont.classList.add("hide");
        }, 2000)
    }

    this.setConfirmMsg = function() {

        var obj = "";
        var act = "";
        switch (this.dataAction) {
            case 'chaAdd':
                obj = "Chapitre";
                act = "ajouté";
            break;
            case 'chaUpdate':
                obj = "Chapitre";
                act = "modifié";
                adminManager.chaptersTable.classList.remove("hide");
                adminManager.chapButtChecked = true;
            break;
            case 'chaDelete':
                obj = "Chapitre";
                act = "Supprimé";
                adminManager.chaptersTable.classList.remove("hide");
                adminManager.chapButtChecked = true;
            break;
            case 'comUpdate':
                obj = "Commentaire";
                act = "Modifié";
                adminManager.commentsTable.classList.remove("hide");
                adminManager.comButtChecked = true;
            break;
            case 'comDelete':
                obj = "Commentaire";
                act = "Supprimé";
                adminManager.commentsTable.classList.remove("hide");
                adminManager.comButtChecked = true;
            break;
        }

        this.confirmPanel(obj, act);
    }
}

var confMsg = new ConfMsg();
confMsg.setConfirmMsg();