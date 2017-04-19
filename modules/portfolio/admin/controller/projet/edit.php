<?php
	$portfolio = new \modules\portfolio\admin\controller\AdminPortfolio();
	
	$portfolio->setEditProjet($_POST['title'], $_POST['categories'], $_POST['article'], $_POST['url'], $_POST['colonne'], $_POST['ordre'], $_POST['id_projet']);
	
	\core\HTML\flashmessage\FlashMessage::setFlash("Votre article a été correctement ajouté", "success");
	
	header("location:".ADMWEBROOT."modules/portfolio");