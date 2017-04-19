<?php
	namespace modules\portfolio\admin\controller;
	
	
	use core\App;
	use Intervention\Image\ImageManager;
	use core\functions\ChaineCaractere;
	use core\HTML\flashmessage\FlashMessage;
	use modules\portfolio\app\controller\Portfolio;
	
	
	class AdminPortfolio extends Portfolio {
		private static $admin_category;
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		public function __construct() {
			
		}
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		public static function getAdminCategory() {
			if (self::$admin_category == null) {
				self::$admin_category = new AdminCategory();
			}
			
			return self::$admin_category;
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		/**
		 * @param $title
		 * function that add image to an article
		 */
		private function setImageProjet($title) {
			if (!empty($_FILES['image']['tmp_name'])) {
				$title_image = ChaineCaractere::setUrl($title);
				
				$name_image = ROOT."modules/portfolio/images/".$title_image.".jpg";
				$name_image1 = ROOT."modules/portfolio/images/grande/".$title_image.".jpg";
				
				$manager = new ImageManager();
				$image = $manager->make($_FILES['image']['tmp_name']);
				$image->fit(480, 330, null, "top-left");
				$image->save($name_image);
				
				$image = $manager->make($_FILES['image']['tmp_name']);
				$image->fit(1920, 500, null, "top-left");
				$image->save($name_image1);
			}
		}
		
		private function setOrdreProjets($ordre, $colonne) {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_portfolio")->where("ordre", "=", $ordre, "AND")
				->where("colonne", "=", $colonne)->get();
			
			if (count($query) > 0) {
				$query = $dbc->select()->from("_portfolio")->where("ordre", ">=", $ordre, "AND")
					->where("colonne", "=", $colonne)->get();
				
				foreach ($query as $obj) {
					$dbc->update("ordre", $obj->ordre+1)->from("_portfolio")->where("ID_portfolio", "=", $obj->ID_portfolio)->set();
				}
			}
		}
		
		/**
		 * @param $title
		 * @param $categories
		 * @param $article
		 * @param $state
		 * @return bool
		 * function to add an article and his categories
		 */
		public function setAddProjet($title, $categories, $article, $url, $colonne, $ordre) {
			$dbc = App::getDb();
			
			$this->setImageProjet($title);
			
			$this->setOrdreProjets($ordre, $colonne);
			
			$dbc->insert("titre", $title)
				->insert("lien", $url)
				->insert("image", ChaineCaractere::setUrl($title))
				->insert("description", $article)
				->insert("colonne", $colonne)
				->insert("ordre", $ordre)
				->into("_portfolio")->set();
			
			$id_projet = $dbc->lastInsertId();
			
			self::getAdminCategory()->setCategoriesArticle($categories, $id_projet);
			return true;
		}
		
		/**
		 * @param $title
		 * @param $categories
		 * @param $article
		 * @param $state
		 * @return bool
		 * function to edit an article and his categories
		 */
		public function setEditProjet($title, $categories, $article, $url, $colonne, $ordre, $id_projet) {
			$dbc = App::getDb();
			
			$ordre_projet = $this->getProjet($id_projet);
			
			self::getAdminCategory()->setUpdateCategoriesProjet($categories, $id_projet);
			
			$dbc->update("titre", $title)
				->update("lien", $url)
				->update("description", $article)
				->update("colonne", $colonne)
				->update("ordre", $ordre)
				->from("_portfolio")
				->where("ID_portfolio", "=", $id_projet)
				->set();
			
			if ($ordre_projet != $ordre) {
				$this->setOrdreProjets($ordre, $colonne);
			}
			
			return true;
		}
		
		/**
		 * @param $id_article
		 * function that is used to delete an article
		 */
		public function setDeleteProjet($id_projet, $titre) {
			$dbc = App::getDb();
			
			$title_image = ChaineCaractere::setUrl($titre);
			
			unlink(ROOT."modules/portfolio/images/".$title_image.".png");
			unlink(ROOT."modules/portfolio/images/grande/".$title_image.".png");
			
			$dbc->delete()->from("_portfolio")->where("ID_portfolio", "=", $id_projet)->del();
			$dbc->delete()->from("_portfolio_portfolio_tag")->where("ID_portfolio", "=", $id_projet)->del();
			
			
			FlashMessage::setFlash("Votre projet a bien été supprimé", "success");
		}
		//-------------------------- END SETTER ----------------------------------------------------------------------------//
	}