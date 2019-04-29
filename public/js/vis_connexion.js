function AdminConnexion() {

    var self = this;
    var passInpLab = document.getElementById("pass_inp_lab");

    this.switchLab = false;

    this.closeForm = function() {
        document.getElementById("pass_form_back").classList.add("hide");
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
        document.getElementById("connex_div").addEventListener('click', function() {
            document.getElementById("pass_form_back").classList.remove("hide");
        })
    }

    this.resetLabelOnFocus = function() {
        document.getElementById('pass_inp').addEventListener("focus", function() {
            if (self.switchLab) {
                passInpLab.textContent = "Tapez votre mot de passe administrateur :";
                self.switchLab = false;
            }
        })
    }

    this.adminRedirection = function(response) {
        passInpLab.textContent = response;
        self.switchLab = true;
        if (response.includes("Connexion")) {
            window.location = "/admin";
        }
    }

    this.connexionQuery = function(param) {
        Utils.ajaxPost('/adminConnexion', param, self.adminRedirection);
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

var adminConnexion = new AdminConnexion();
adminConnexion.init();
