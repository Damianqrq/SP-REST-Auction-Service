<?php
require_once("OfferRestHandler.php");
$method = $_SERVER['REQUEST_METHOD'];

//json post handling
$_POST = json_decode(file_get_contents('php://input'),true);

//var_dump($_GET);
/*
controls the RESTful services
URL mapping
*/
switch($method){
    case "GET":
        $view = "";
        if(isset($_GET["view"]))
            $view = $_GET["view"];
        switch($view){

                case "all":
                        // to handle REST Url /offer/list/
                        $offerRestHandler = new OfferRestHandler();
                        $offerRestHandler->getAllOffers();
                        break;

                case "single":
                        // to handle REST Url /offer/list/<id>/
                        $offerRestHandler = new OfferRestHandler();
                        $offerRestHandler->getOffer($_GET["id"]);
                        break;

                case "" :
                        //404 - not found;
                        echo("error");
                        break;
        }
    break;
    case "POST":
        $offerRestHandler = new OfferRestHandler();
        $offerRestHandler->addOffer();
    break;
    case "DELETE":
        $offerRestHandler = new OfferRestHandler();
        $offerRestHandler->deleteOffer();
    break;
}
?>