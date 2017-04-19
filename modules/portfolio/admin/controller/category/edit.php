<?php
	$category = new \modules\portfolio\admin\controller\AdminCategory();
	
	$category->setEditCategory($_POST['category'], $_POST['id_category']);

	header("location:".ADMWEBROOT."modules/portfolio/list-categories");