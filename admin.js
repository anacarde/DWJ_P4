var add_billet_button = document.getElementById('add_billet_button');
var billets_button = document.getElementById('billets_button');
var comments_button = document.getElementById('comments_button');

var add_billet_div = document.getElementById('add_billet_div');
var billets_table = document.getElementById('billets_table');
var comments_table = document.getElementById('comments_table');

add_billet_button.addEventListener('click', function() {
	add_billet_div.classList.remove("hide");
	billets_table.classList.add("hide");
	comments_table.classList.add("hide");
});

billets_button.addEventListener('click', function() {
	add_billet_div.classList.add("hide");
	billets_table.classList.remove("hide");
	comments_table.classList.add("hide");
});

comments_button.addEventListener('click', function() {
	add_billet_div.classList.add("hide");
	billets_table.classList.add("hide");
	comments_table.classList.remove("hide");
});