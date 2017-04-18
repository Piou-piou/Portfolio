<?php
	namespace modules\portfolio\app\controller;
	
	
	use core\App;
	
	class Category {
		
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		public function __construct() {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_portfolio_tag")->get();
			
			if ((is_array($query)) && (count($query) > 0)) {
				$categories = [];
				
				foreach ($query as $obj) {
					$categories[] = [
						"id_category" => $obj->ID_tag,
						"category" => $obj->nom,
					];
				}
				
				Portfolio::setValues(["categories_list" => $categories]);
			}
		}
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		/**
		 * get all categories of an article
		 */
		public function getCategoryProject($id_portfolio) {
			$dbc = App::getDb();
			
			$query = $dbc->select()
				->from("_portfolio")
				->from("_portfolio_tag")
				->from("_portfolio_portfolio_tag")
				->where("_portfolio.ID_portfolio", "=", $id_portfolio, "AND")
				->where("_portfolio_portfolio_tag.ID_portfolio", "=", "_portfolio.ID_portfolio", "AND", true)
				->where("_portfolio_portfolio_tag.ID_tag", "=", "_portfolio_tag.ID_tag", "", true)
				->get();
			
			if ((is_array($query)) && (count($query) > 0)) {
				$categories = [];
				foreach ($query as $obj) {
					$categories[] = [
						"id_category" => $obj->ID_tag,
						"category" => $obj->nom,
					];
				}
				
				return $categories;
			}
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		//-------------------------- END SETTER ----------------------------------------------------------------------------//    
	}