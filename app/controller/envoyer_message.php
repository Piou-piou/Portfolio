<?php
	$validator = new \core\form\FormValidator($_POST);
	$validator->Check('prenom', 'required');
	$validator->Check('mail', 'required');
	$validator->Check('message', 'required');


	if ($validator->getErrors()) {
		\core\HTML\flashmessage\FlashMessage::setFlash("Merci de remplir tous les champs obligatoires");
	}
	else {
		$objet = "message de la part de ".$_SERVER['HTTP_HOST'];
		$message = $_POST['message']."<br><br>"."numéro de téléphone : ".$_POST['tel'];

		\core\App::envoyerMail($_POST['mail'], $config->getMailAdministrateur(), $objet, $message);
		
		\core\HTML\flashmessage\FlashMessage::setFlash("Votre message a été correctement envoyé et sera traité au plus vite", "success");
	}

	header("location:".WEBROOT."#contact_Anthony_Pilloud_développeur_web_Franche_Comté_Besancon_Pontarlier");
?>