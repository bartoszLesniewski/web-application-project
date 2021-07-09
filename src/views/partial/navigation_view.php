<nav>
	<button class="btn"><img src="../static/img/hamburger_icon.svg" alt="Hamburger icon"></button>
	<ol class="menu">
		<li><a href="/">Strona główna</a></li>
		<li><a href="dodaj-zdjecie">Dodaj zdjęcie</a></li>
		<li><a href="galeria">Galeria</a></li>
		<li><a href="zapamietane">Zapamiętane zdjęcia</a></li>
		<li><a href="wyszukiwarka">Wyszukiwarka</a></li>
		
		<?php if(!isset($_SESSION['logged'])): ?>
		<li><a href="rejestracja">Zarejestruj się</a></li>
		<li><a href="logowanie">Logowanie</a></li>
		<?php else: ?>
		<li><a href="wylogowanie">Wyloguj się</a></li>
		<?php endif ?>
	</ol>
</nav>