<!DOCTYPE html>
<html>
<head>
    <title> Le blog de Jean Forteroche </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/src/View/css/visitorStyle.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
</head>
<body id="billets_body">
    <header id="header_banner">
        <div id="header_banner_image">
        </div>
        <div id="header_banner_title">
            <h1 > Billet simple pour l'Alaska </h1>
        </div>
        <div id="header_banner_author">
            <em id="author"> Par Jean Forteroche </em>
        </div>
    </header>
    <div id="reading_intro">
        <hr/>
        <h2> Lecture </h2>
    </div>
    <section id="chapters_section">
        <div id="chapter_reading">
            <h2 id="billet_title"> <?= $chapterContent->getTitle(); ?> </h2>
            <p id="chapter">
                <?= $chapterContent->getContent(); ?>
            </p>
            <button id="chapter_top"> Haut du chapitre </span>
        </div>
        <nav id="chapters_list_section">
            <ul>
                <?php 
                foreach ($chaptersList as $chapterTitle) 
                {
                ?>
                <li> <a href="<?= $chapterTitle->getId() ?>">
                    <?= $chapterTitle->getChapterNumber(); ?>
                    <?= $chapterTitle->getTitle(); ?> 
                </a> </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </section>
    <div id="comments_intro">
        <hr/>
        <h2> Commentaires </h2>
    </div>
    <section id="comments_section">
        <form action="" method="post">
            <div id="pseudo_div">
                <label for="pseudo" id="pseudo_label"> Pseudo </label> 
                <input type="text" id="pseudo" class="input" name="pseudo" />
            </div>
            <div id="comment_div">
                <label for="comment" id="comment_label"> Message </label> 
                <textarea id="comment" class="input" name="comment" rows="3"></textarea>
            </div>
            <input type="submit" id="submit" value="envoyer" />
        </form>
        <div id="comments_container">
        </div>
    </section>
    <footer id="footer_banner">
        <div id="footer_contact">
            <h3> Me contacter : </h3>
            <p id="contact_mail"> <a href=""> Nom@exemple.org </a> </p>
        </div>
    </footer>
    <script src="/src/view/js/visitorJs.js"></script>
</body>
</html>