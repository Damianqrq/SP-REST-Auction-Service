<?php
/* 
A domain Class to demonstrate RESTful web services
*/
Class Offer {
	
	private $offers = array(
		1 => ['id' => 1, 'title' => 'Apple iPhone 6S', 'content' => 'Lorem ipsum'],
		2 => ['id' => 2, 'title' => 'Samsung Galaxy S6', 'content' => 'Lorem ipsum'],  
		3 => ['id' => 3, 'title' => 'Apple iPhone 6S Plus', 'content' => 'Lorem ipsum'],  			
		4 => ['id' => 4, 'title' => 'LG G4', 'content' => 'Lorem ipsum'],  			
		5 => ['id' => 5, 'title' => 'Samsung Galaxy S6 edge', 'content' => 'Lorem ipsum'],  
		7 => ['id' => 7, 'title' => 'OnePlus 2', 'content' => 'Lorem ipsum']);
		
	/*
		you should hookup the DAO here
	*/
	public function getAllOffer(){
                
		return $this->offers;
	}
	
	public function getOffer($id){
                $offer = $this->offers[$id];
		//$offer = array($id => ($this->offers[$id]) ? $this->offers[$id] : $this->offers[1]);
		return $offer;
	}	
}
?>