<nav class="grid grid-cols-12">
<div class="grid grid-cols-12 col-start-3 flex items-center col-span-8 gap-2">
	<div class="justify-center text-jaune-300 md:col-span-3 col-span-12 flex md:justify-end"><?php readfile(getcwd().'/templates/header/logo.html');?></div>
	<?php readfile(getcwd().'/templates/header/searchbarNav.html');?>
	<div class="md:col-span-3 col-span-12 flex justify-evenly md:justify-start">
	<a class="md:mr-2" href="index.php?module=user&action=likes">
	<svg class="fill-current text-jaune-300" xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 20 20"><path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z"/></svg></a>
	<a href="index.php?module=user&action=profile">
	<svg class="fill-current text-jaune-300" xmlns="http://www.w3.org/2000/svg" width="70" height="70"viewBox="0 0 20 20"><path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg></a>	
	</div>
</button>
</div> 
</nav>