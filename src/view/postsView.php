<!DOCTYPE html>
<html>
<head>
	<title> Le blog de Jean Forteroche </title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="src/view/css/postsStyle.css" />
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
			<div id="arrows_and_title">
				<span id="left_arrow" class="arrow"> &lt; </span>
				<h2 id="billet_title"> titre 1 </h2>
				<span id="right_arrow" class="arrow"> &gt; </span>
			</div>
			<p id="chapter">


			Novo denique perniciosoque exemplo idem Gallus ausus est inire flagitium grave, quod Romae cum ultimo dedecore temptasse aliquando dicitur Gallienus, et adhibitis paucis clam ferro succinctis vesperi per tabernas palabatur et conpita quaeritando Graeco sermone, cuius erat inpendio gnarus, quid de Caesare quisque sentiret. et haec confidenter agebat in urbe ubi pernoctantium luminum claritudo dierum solet imitari fulgorem. postremo agnitus saepe iamque, si prodisset, conspicuum se fore contemplans, non nisi luce palam egrediens ad agenda quae putabat seria cernebatur. et haec quidem medullitus multis gementibus agebantur.

			Hanc regionem praestitutis celebritati diebus invadere parans dux ante edictus per solitudines Aboraeque amnis herbidas ripas, suorum indicio proditus, qui admissi flagitii metu exagitati ad praesidia descivere Romana. absque ullo egressus effectu deinde tabescebat immobilis.

			Quapropter a natura mihi videtur potius quam ab indigentia orta amicitia, applicatione magis animi cum quodam sensu amandi quam cogitatione quantum illa res utilitatis esset habitura. Quod quidem quale sit, etiam in bestiis quibusdam animadverti potest, quae ex se natos ita amant ad quoddam tempus et ab eis ita amantur ut facile earum sensus appareat. Quod in homine multo est evidentius, primum ex ea caritate quae est inter natos et parentes, quae dirimi nisi detestabili scelere non potest; deinde cum similis sensus exstitit amoris, si aliquem nacti sumus cuius cum moribus et natura congruamus, quod in eo quasi lumen aliquod probitatis et virtutis perspicere videamur.
 
			</p>
		</div>
		<nav id="chapters_list_section">
			<ul>
				<?php 
				foreach ($this->chapters as $chapter) 
				{
				?>
				<li> <a href=""> <?= $chapter->getTitle() ?> </a> </li>
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
		<div id="comments">
			<h4> Ezechiel <em class="date"> Le 5 Janvier 2012 à 18h </em> </h4> 
			<p> aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
			<h4> Mohamed <em class="date"> Le 5 Janvier 2012 à 18h </em>  </h4> 
			<p> bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb </p>
		</div>
		<div id="comments_pages">
			<a href=""> 1 </a>
			<a href=""> 2 </a>
			<a href=""> 3 </a>
			<a href=""> 4 </a>
		</div>
	</section>
	<footer id="footer_banner">
		<div id="footer_contact">
			<h3> Me contacter : </h3>
			<p id="contact_mail"> <a href=""> Nom@exemple.org </a> </p>
		</div>
	</footer>
</body>
</html>