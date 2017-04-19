<?php
	$portfolio = new \modules\portfolio\admin\controller\AdminPortfolio();
	
	$portfolio->setAddProjet($_POST['title'], $_POST['categories'], $_POST['article'], $_POST['url'], $_POST['colonne'], $_POST['ordre']);

	\core\HTML\flashmessage\FlashMessage::setFlash("Votre article a été correctement ajouté", "success");
	
	header("location:".ADMWEBROOT."modules/portfolio");