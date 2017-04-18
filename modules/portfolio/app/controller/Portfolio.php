<?php
	namespace modules\portfolio\app\controller;
	
	
	use core\App;
	
	class Portfolio {
		private static $category;
		
		private static $values = [];
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		public function __construct($init = null) {
			$dbc = App::getDb();
			
			if ($init == 1) {
				$query = $dbc->select()->from("_portfolio")->get();
				
				if ((is_array($query)) && (count($query) > 0)) {
					$articles = [];
					
					foreach ($query as $obj) {
						$articles[] = [
							"id_portfolio" => $obj->ID_portfolio,
							"titre" => $obj->titre,
							"description" => $obj->description,
							"image" => $obj->image,
							"url" => $obj->lien,
							"colonne" => $obj->colonne,
							"categories" => self::getCategory()->getCategoryProject($obj->ID_portfolio)
						];
					}
					
					self::setValues(["projets" => $articles]);
				}
			}
		}
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		public function getProjetColonne($colonne) {
			$dbc = App::getDb();
			$query = $dbc->select()->from("_portfolio")->where("colonne", "=", $colonne)->orderBy("", "RAND()")->get();
			
			if ((is_array($query)) && (count($query) > 0)) {
				$articles = [];
				
				foreach ($query as $obj) {
					$articles[] = [
						"id_portfolio" => $obj->ID_portfolio,
						"titre" => $obj->titre,
						"description" => $obj->description,
						"image" => $obj->image,
						"url" => $obj->lien,
						"colonne" => $obj->colonne,
						"categories" => self::getCategory()->getCategoryProject($obj->ID_portfolio)
					];
				}
				
				self::setValues(["colonne$colonne" => $articles]);
			}
		}
		
		/**
		 * @return array
		 * get array of all values wich will be used in the page
		 */
		public static function getValues() {
			return ["portfolio" => self::$values];
		}
		
		public static function getCategory() {
			if (self::$category == null) {
				self::$category = new Category();
			}
			
			return self::$category;
		}
		
		public function getProjet($id_projet) {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_portfolio")->where("ID_portfolio", "=", $id_projet)->get();
			
			if ((is_array($query)) && (count($query) == 1)) {
				foreach ($query as $obj) {
					$projet = [
						"id_portfolio" => $obj->ID_portfolio,
						"titre" => $obj->titre,
						"description" => $obj->description,
						"image" => $obj->image,
						"url" => $obj->lien,
						"colonne" => $obj->colonne,
						"categories" => self::getCategory()->getCategoryProject($obj->ID_portfolio)
					];
				}
				
				self::setValues(["projet" => $projet]);
			}
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		/**
		 * @param $values
		 * can set values while keep older infos
		 */
		public static function setValues($values) {
			Portfolio::$values = array_merge(Portfolio::$values, $values);
		}
		//-------------------------- END SETTER ----------------------------------------------------------------------------//    
	}