<?php
	$category = new \modules\portfolio\admin\controller\AdminCategory();
	
	if ($category->setAddCategory($_POST['category']) == false) {
		$_SESSION['category'] = $_POST['category'];
		
		header("location:".ADMWEBROOT."modules/portfolio/add-category");
	}
	else {
		unset($_SESSION['category']);
		
		header("location:".ADMWEBROOT."modules/portfolio/list-categories");
	}
	