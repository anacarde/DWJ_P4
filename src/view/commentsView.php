<?php
foreach($chapterComments as $key => $comment) {
?>
    <h4> <?= $comment->getAuthor() ?> <em class="date"> <?= $comment->getDateAdd() ?> </em> </h4> 
    <p> <?= $comment->getContent() ?> </p>
<?php
}
?>

