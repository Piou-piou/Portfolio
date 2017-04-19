<?php
	
	$category = new \modules\portfolio\admin\controller\AdminCategory();
	
	$category->setDeleteCategory($_GET['id_category']);
	
	header("location:".ADMWEBROOT."modules/portfolio/list-categories");