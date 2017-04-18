<?php
	namespace modules\portfolio\app\controller;
	
	
	use core\App;
	
	class Article {
		
		
		//-------------------------- BUILDER ----------------------------------------------------------------------------//
		public function __construct() {
			$dbc = App::getDb();
			
			$query = $dbc->select()->from("_portfolio")->get();
			
			if ((is_array($query)) && (count($query) > 0)) {
				$articles = [];
				
				foreach ($query as $obj) {
					$articles[] = [
						"id_portfolio" => $obj->ID_portfolio,
						"titre" => $obj->titre,
						"description" => $obj->description,
						"image" => $obj->image,
						"lien" => $obj->lien,
						"categories" => Portfolio::getCategory()->getCategoryProject($obj->ID_portfolio)
					];
				}
				
				Blog::setValues(["articles" => $articles]);
			}
		}
		//-------------------------- END BUILDER ----------------------------------------------------------------------------//
		
		
		//-------------------------- GETTER ----------------------------------------------------------------------------//
		/**
		 * function that get one article
		 */
		public function getArticle() {
			$dbc = App::getDb();
			$param = Blog::$router_parameter;
			
			$query = $dbc->select()->from("_blog_article")->from("identite")->from("_blog_state")
				->where("ID_article", "=", $param, "OR")
				->where("url", "=", $param, "AND")
				->where("_blog_article.ID_identite", "=", "identite.ID_identite", "AND", true)
				->where("_blog_article.ID_state", "=", "_blog_state.ID_state", "", true)
				->get();
			
			if ((is_array($query)) && (count($query) == 1)) {
				foreach ($query as $obj) {
					$this->getExtract($obj->article);
					
					Blog::setValues(["article" => [
						"id_article" => $obj->ID_article,
						"title" => $obj->title,
						"url" => $obj->url,
						"article" => $obj->article,
						"extract" => $this->getExtract($obj->article),
						"pseudo" => $obj->pseudo,
						"id_state" => $obj->ID_state,
						"state" => $obj->state,
						"publication_date" => $this->getDateFr($obj->publication_date),
						"categories" => Blog::getCategory()->getCategoryArticle()
					]]);
				}
			}
		}
		//-------------------------- END GETTER ----------------------------------------------------------------------------//
		
		
		//-------------------------- SETTER ----------------------------------------------------------------------------//
		//-------------------------- END SETTER ----------------------------------------------------------------------------//    
	}