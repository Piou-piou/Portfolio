<?php
	namespace modules\portfolio\admin\controller;
	
	
	use core\App;
	use core\functions\ChaineCaractere;
	use core\HTML\flashmessage\FlashMessage;
	use modules\portfolio\app\controller\Portfolio;
	
	class AdminCategory {
		
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		public function __construct() {
			
		}
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		public function getCategory($id_category) {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_portfolio_tag")->where("ID_tag", "=", $id_category)->get();
			
			if (count($query) == 1) {
				foreach ($query as $obj) {
					Portfolio::setValues([
						"category_name" => $obj->nom,
						"id_category" => $obj->ID_tag
					]);
				}
			}
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		/**
		 * @param $name
		 * @return bool
		 * function to add a category
		 */
		public function setAddCategory($name) {
			$dbc = App::getDb();

			$dbc->insert("nom", $name)->into("_portfolio_tag")->set();
			FlashMessage::setFlash("Votre catégorie a été correctement ajoutée", "success");
			return true;
		}
		
		/**
		 * @param $name
		 * @param $id
		 * @return bool
		 * function to edit the name of a category
		 */
		public function setEditCategory($name, $id) {
			$dbc = App::getDb();
			
			$dbc->update("nom", $name)->from("_portfolio_tag")->where("ID_tag", "=", $id)->set();
			
			FlashMessage::setFlash("Votre catégorie a été correctement ajoutée", "success");
			return true;
		}
		
		/**
		 * @param $categories
		 * @param $id_article
		 * add list of categories to an article
		 */
		public function setCategoriesArticle($categories, $id_projet) {
			$dbc = App::getDb();
			
			$count = count($categories);
			if ((is_array($categories)) && ($count > 0)) {
				for ($i=0 ; $i<$count ; $i++) {
					
					$dbc->insert("ID_tag", $categories[$i])
						->insert("ID_portfolio", $id_projet)
						->into("_portfolio_portfolio_tag")
						->set();
				}
			}
		}
		
		/**
		 * @param $categories
		 * @param $id_article
		 * function to update catgories, in first step delete all categories and reinsert it after
		 */
		public function setUpdateCategoriesProjet($categories, $id_projet) {
			$dbc = App::getDb();
			
			echo $id_projet;
			
			$dbc->delete()->from("_portfolio_portfolio_tag")->where("ID_portfolio", "=", $id_projet)->del();
			
			$this->setCategoriesArticle($categories, $id_projet);
		}
		
		/**
		 * @param $id_category
		 * function that can delete an category and all article related to it
		 */
		public function setDeleteCategory($id_category) {
			$dbc = App::getDb();
			
			$dbc->delete()->from("_portfolio_tag")->where("ID_tag", "=", $id_category)->del();
			$dbc->delete()->from("_portfolio_portfolio_tag")->where("ID_tag", "=", $id_category)->del();
		}
		//-------------------------- END SETTER ----------------------------------------------------------------------------//
	}