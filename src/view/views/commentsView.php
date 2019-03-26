<div id="comments">
    <?php
    foreach($chapterComments as $key => $comment) {
    ?>
        <h4> <?= $comment->getAuthor() ?> <em class="date"> <?= $comment->getDateAdd() ?> </em> </h4> 
        <p> <?= $comment->getContent() ?> </p>
    <?php
    }
    ?>
</div>
<div id="comments_pages">
    <?php
    for ( $i=1 ; $i<=ceil($comments_nb/5) ; $i++) {
    ?>
        <a href="<?=/* $chapterContent->getId()."?commentsPage=$i"*/ ?>"> <?= $i ?> </a>
    <?php
    }
    ?>
</div>