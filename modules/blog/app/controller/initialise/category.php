<?php
	
	$article = new \modules\blog\app\controller\Article();
	$article->getCategoryArticle();
	
	$category = new \modules\blog\app\controller\Category();
	
	$arr = \modules\blog\app\controller\Blog::getValues();
	
	\core\App::setTitle("Anthony Pilloud blog liste des articles de la catégorie : ".$category->getNamemCategorieUrl());
	\core\App::setDescription("Page d'articles rédigés par Anthony Pilloud développeur web en Franche-Comté ayant pour catégorie ". $category->getNamemCategorieUrl());