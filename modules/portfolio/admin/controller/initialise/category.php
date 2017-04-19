<?php
	$category = new \modules\portfolio\admin\controller\AdminCategory();
	$category->getCategory($_GET["id_category"]);
	
	$arr = \modules\portfolio\app\controller\Portfolio::getValues();