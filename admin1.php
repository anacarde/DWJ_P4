<!DOCTYPE html>
<html>
<head>
	<title> Le blog de Jean Forteroche - espace administrateur </title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=wmpba1qv3ow0lxpqb3udwiw8kxn9h8lqarl3tyx33nzo16xb"></script> 
	<script>
	  tinymce.init({
	    selector: '#billet_editor',
	    language: 'fr_FR',
	    language_url: 'http://localhost/P4_Patron/tinymce_lang/fr_FR.js',
	    body_id: 'billet_editor'
	  });
  </script>
</head>
<body>
	<h1 id="admin_welcome"> Bienvenue Jean Forteroche. </h1>
	<div id="onglets_admin">
		<button id="add_billet_button" class="button_admin"> Ajouter un nouveau billet </button>
		<button id="billets_button" class="button_admin"> Gérer mes billets </button>
		<button id="comments_button" class="button_admin"> Gérer mes commentaires </button>
	</div>
		<div id="add_billet_div" class="">
			<textarea id="billet_editor"></textarea>
		</div>
	</div>
	<div id="billets_table" class="">
		<table>
			<tr>
				<th> Numéro de chapitre </th>
				<th> Titre du billet </th>
				<th> Date d'ajout </th>
				<th> Date de modification </th>
				<th> Action </th>
			</tr>
			<tr>
				<td> Salut </td>
				<td> Salut </td>
				<td> Salut </td>
				<td> Salut </td>
				<td> Modifier | Supprimer </td>
			</tr>
			<tr>
				<td> Salut </td>
				<td> Salut </td>
				<td> Salut </td>
				<td> Salut </td>
				<td> Modifier | Supprimer </td>
			</tr>
			<tr>
				<td> Salut </td>
				<td> Salut </td>
				<td> Salut </td>
				<td> Salut </td>
				<td> Modifier | Supprimer </td>
			</tr>
		</table>
	</div>
	<div id="comments_table" class="">
		<table>
			<tr>
				<th> Chapitre du commentaire </th>
				<th> Auteur </th>
				<th> Contenu </th>
				<th> Action </th>
			</tr>
			<tr>
				<td> Hello </td>
				<td> Hello </td>
				<td> Hello </td>
				<td> Modifier | Supprimer </td>
			</tr>
			<tr>
				<td> Hello </td>
				<td> Hello </td>
				<td> Hello </td>
				<td> Modifier | Supprimer </td>
			</tr>
			<tr>
				<td> Hello </td>
				<td> Hello </td>
				<td> Hello </td>
				<td> Modifier | Supprimer </td>
			</tr>
		</table>
	</div>

	<script src="admin.js"> </script>
</body>