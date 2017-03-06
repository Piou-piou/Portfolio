<?php
	$article = new \modules\blog\app\controller\Article();
	$article->getArticle();
	
	$category = new \modules\blog\app\controller\Category();
	$category->getCategoryArticle();
	
	$arr = \modules\blog\app\controller\Blog::getValues();
	
	\core\App::setTitle("Anthony Pilloud développeur web Blog :".$arr["blog"]["article"]["title"]);
	\core\App::setDescription("Page d'article rédigé par Anthony Pilloud développeur web en Franche-Comté ayant pour titre : ".$arr["blog"]["article"]["title"]);