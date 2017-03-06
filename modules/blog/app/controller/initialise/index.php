<?php
	$blog = new \modules\blog\app\controller\Article();
	$blog->getLastArticle();
	
	$category = new \modules\blog\app\controller\Category();
	
	$arr = \modules\blog\app\controller\Blog::getValues();
	
	\core\App::setTitle("Blog Anthony PIlloud développeur web en Franche-Comté");
	\core\App::setDescription("Blog Développeur web Doubs - Franche-Comté - Pontarlier - Besançon, Venez découvrir mes différents articles !");