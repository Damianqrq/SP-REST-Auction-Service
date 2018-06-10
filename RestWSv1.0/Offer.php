<?php
require_once("dbcontroller.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class Offer {
	
	private $offers = array();
        
	public function getAllOffer(){
                $query = 'SELECT * FROM offerstable';
		$dbcontroller = new DBController();
		$this->offers = $dbcontroller->executeSelectQuery($query);
		return $this->offers;
	}
	
	public function getOffer($id){
                $query = 'SELECT * FROM offerstable WHERE id='.$id.'';
                $dbcontroller = new DBController();
                $offer = $dbcontroller->executeSelectQuery($query);
		return $offer[0];
	}	
        public function addOffer(){
            //echo $_SERVER['REQUEST_METHOD'];
            //var_dump($_GET);
            if(isset($_POST['title'])){
			$title = $_POST['title'];
				$content = '';
				$price = 'NULL';
                                $image_url = 'NULL';
			if(isset($_POST['content'])){
				$content = $_POST['content'];
			}
			if(isset($_POST['price'])){
				$price = $_POST['price'];
			}
                        if(isset($_POST['image_url'])){
                                $image_url = $_POST['image_url'];
                        }
                $query = "INSERT INTO offerstable (title,content,price,image_url) values('"
                        .$title."','".$content."','".$price."','".$image_url."')";
                $dbcontroller = new DBController();
                $result = $dbcontroller->executeQuery($query);
                if($result != 0){
                    //getting autoincrement id
                    $query = "SELECT max(id) as id from offerstable";
                    $result = $dbcontroller->executeSelectQuery($query);
                    return $result[0];
		}
            }
        }
        public function deleteOffer(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $query = "DELETE FROM offerstable WHERE id ='".$id."'";
                $dbcontroller = new DBController();
                $result = $dbcontroller->executeQuery($query);
            }
        }
}
?>