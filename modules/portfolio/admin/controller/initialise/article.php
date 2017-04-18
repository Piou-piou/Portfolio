<?php
	$portfolio = new \modules\portfolio\app\controller\Portfolio();
	$portfolio->getProjet($_GET['id_projet']);
	
	$category = new \modules\portfolio\app\controller\Category();
	$category->getCategoryProject($_GET['id_projet']);
	
	$arr = \modules\portfolio\app\controller\Portfolio::getValues();