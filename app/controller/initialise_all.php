<?php
	$gestion_module = new \core\modules\GestionModule();
	$gestion_module->getListeModuleActiver();
	
	$blog = new \modules\blog\app\controller\Article();
	$blog->getLastArticle();
	
	$category = new \modules\blog\app\controller\Category();
	
	$arr = \modules\blog\app\controller\Blog::getValues();
	
	//pour le portfolio
	$portfolio = new \modules\portfolio\app\controller\Portfolio();
	$portfolio->getProjetColonne(1);
	$portfolio->getProjetColonne(2);
	$portfolio->getProjetColonne(3);
	$portfolio->getProjetColonne(4);
	
	$arr = array_merge($arr, \modules\portfolio\app\controller\Portfolio::getValues());