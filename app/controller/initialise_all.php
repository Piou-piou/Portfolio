<?php
	$gestion_module = new \core\modules\GestionModule();
	$gestion_module->getListeModuleActiver();
	
	$blog = new \modules\blog\app\controller\Article();
	$blog->getLastArticle();
	
	$category = new \modules\blog\app\controller\Category();
	
	$arr = \modules\blog\app\controller\Blog::getValues();