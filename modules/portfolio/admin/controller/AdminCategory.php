<?php
	namespace modules\portfolio\admin\controller;
	
	
	use core\App;
	use core\functions\ChaineCaractere;
	use core\HTML\flashmessage\FlashMessage;
	
	class AdminCategory {
		
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		public function __construct() {
			
		}
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		/**
		 * @param $name
		 * @return bool
		 * function to add a category
		 */
		public function setAddCategory($name) {
			$dbc = App::getDb();

			$dbc->insert("category", $name)->insert("url_category", ChaineCaractere::setUrl($name))->into("_blog_category")->set();
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
			
			$dbc->update("category", $name)->update("url_category", ChaineCaractere::setUrl($name))
				->from("_blog_category")->where("ID_category", "=", $id)->set();
			
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
			
			$dbc->delete()->from("_blog_category")->where("ID_category", "=", $id_category)->del();
			$dbc->delete()->from("_blog_article_category")->where("ID_category", "=", $id_category)->del();
		}
		//-------------------------- END SETTER ----------------------------------------------------------------------------//
	}