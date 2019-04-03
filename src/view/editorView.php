<button class="close_cross"> X </button>
<form id="add_chapter_form" action="/add" method="post">
    <div id="chap_nb_div">
        <label for="nb_input" class="form_label"> Numéro du chapitre : 
            <input type="text" id="nb_input" name="ChapterNumber" />
        </label> 
        <label for="title_input" class="form_label"> Titre du chapitre : 
            <input type="text" id="title_input" name="Title" />
        </label> 
    </div>
    <label for="chapter_editor" id="content_label" class="form_label"> Entrez le contenu de votre chapitre </label>
    <textarea id="chapter_editor" name="Content"></textarea>
    <input type="submit" id="send_btn" value="Envoi de mon chapitre" />
</form>