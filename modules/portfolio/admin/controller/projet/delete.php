<?php
	
	$portfolio = new \modules\portfolio\admin\controller\AdminPortfolio();
	
	$portfolio->setDeleteProjet($_GET['id_projet'], $_GET['titre']);
	
	header("location:".ADMWEBROOT."modules/portfolio");