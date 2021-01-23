<nav class="grid grid-cols-12">
<div class="col-start-3 flex col-span-8">
	<div class="text-jaune-300"><?php readfile(getcwd().'/templates/header/logo.html');?></div>
	<?php readfile(getcwd().'/templates/header/searchbarNav.html');?>
	<div class="flex">
	<a href="index.php?module=user&action=likes">
	<svg class="fill-current text-jaune-300" xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 20 20"><path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z"/></svg></a>
	<a href="index.php?module=user&action=profile">
	<svg class="fill-current text-jaune-300" xmlns="http://www.w3.org/2000/svg" width="70" height="70"viewBox="0 0 20 20"><path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg></a>	
	</div>
</button>
</div> 
</nav>