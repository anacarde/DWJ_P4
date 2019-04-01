<!DOCTYPE html>
<html>
<head>
    <title> Le blog de Jean Forteroche - espace administrateur </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/css/adminStyle.css" />
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=wmpba1qv3ow0lxpqb3udwiw8kxn9h8lqarl3tyx33nzo16xb"></script> 
    <script>
      tinymce.init({
        selector: '#chapter_editor',
        height: 800,
        language: 'fr_FR',
        language_url: '/js/tinymceLang_fr.js',
        body_id: 'chapter_editor'
      });
  </script>
</head>
<body id="admin_body">
    <h1 id="admin_welcome"> Blog de Jean Forteroche, espace administrateur </h1>
    <div id="onglets_admin">
        <button id="add_chapter_button" class="button_admin"> Ajouter un nouveau chapitre </button>
        <button id="chapters_list_button" class="button_admin"> Gérer mes chapitres </button>
        <button id="comments_button" class="button_admin"> Gérer mes commentaires </button>
    </div>
    <form id="add_chapter_form" class="admin_div hide"  action="/add" method="post">
        <button class="close_cross"> X </button>
        <div id="chap_nb_div">
            <label for="nb_input" class="form_label"> Numéro du chapitre : 
                <input type="text" id="nb_input" name="ChapterNumber" />
            </label> 
            <label for="title_input" class="form_label"> Titre du chapitre : 
                <input type="text" id="title_input" name="Title" />
            </label> 
        </div>
        <label for="chapter_editor" id="content_label" class="form_label"> Entrez le contenu de votre chapitre  </label>
        <textarea id="chapter_editor" name="Content"></textarea>
        <input type="submit" id="send_btn" value="Envoi de mon chapitre" />
    </form>
    <div id="chapters_list_div" class="admin_div hide">
        <button class="close_cross"> X </button>
        <br/>
        <table id="chapters_table" class="table_admin">
            <tr>
                <th> Chapitre n° </th>
                <th> Titre </th>
                <th> Date d'ajout </th>
                <th> Dernière modification </th>
                <th colspan="2"> Action </th>
            </tr>
            <?php
            foreach($this->chaptersList as $key => $chapter)                
            {
            ?>
            <tr>
                <td> <?= $chapter->getChapterNumber() ?> </td>
                <td> <?= $chapter->getTitle() ?> </td>
                <td> <?= $chapter->getDateAdd() ?> </td>
                <td> <?= $chapter->getDateModif() ?> </td>
                <td class="action modif"> <button> Modifier </button> </td>
                <td class="action supp"> <button> Supprimer </button> </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
<!--<form id="modif_chapter_form" class="hide" action="/update" method="post">
        <div id="chap_nb_div">
            <label for="nb_input" class="form_label"> Numéro du chapitre : 
                <input type="text" id="nb_input" name="ChapterNumber" />
            </label> 
            <label for="title_input" class="form_label"> Titre du chapitre : 
                <input type="text" id="title_input" name="Title" />
            </label> 
        </div>
        <label for="chapter_editor" id="content_label" class="form_label"> Contenu  </label>
        <textarea id="chapter_editor" name="Content"></textarea>
        <input type="submit" id="send_btn" value="Envoi de mon chapitre" />
    </form> -->
    <div id="comments_list_div" class="admin_div hide">
        <button class="close_cross"> X </button>
        <br/>
        <table id="comments_table" class="table_admin">
            <tr>
                <th> Commentaires au chapitre n° </th>
                <th> Date </th>
                <th> Auteur </th>
                <th> Contenu </th>
                <th colspan="2"> Action </th>
            </tr>
            <?php
            foreach($this->commentsList as $key => $comment)
            {
            ?>
            <tr>
                <td> <?= $comment->getCommentChapter(); ?> </td>
                <td> <?= $comment->getDateAdd(); ?>  </td>
                <td> <?= $comment->getAuthor(); ?>  </td>
                <td> <?= $comment->getContent(); ?>  </td>
                <td class="action modif"> <button> Modifier </button></td>
                <td class="action supp"> <button> Supprimer </button> </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <script src="/js/adminJs.js"></script>
</body>