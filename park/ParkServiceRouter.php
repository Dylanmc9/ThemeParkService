<?php

require_once("ParkServiceHandler.php");
require_once("settings.config.php");

//$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
$page_key = filter_input(INPUT_GET, 'page_key', FILTER_SANITIZE_SPECIAL_CHARS);

/*
  controls the RESTful services
  URL mapping
 */
switch ($page_key) {

    case "create":
        // to handle REST Url /Park/create/
        $appRestHandler = new ParkServiceHandler($localhostConnectionConfig);
        $appRestHandler->createPark();
        break;

    case "retrieve":
        // to handle REST Url /Park/retrieve/
        $appRestHandler = new ParkServiceHandler($localhostConnectionConfig);
        $result = $appRestHandler->retrieveAllParks();
        break;

    case "update":
        // to handle REST Url /Park/update/
        $appRestHandler = new ParkServiceHandler($localhostConnectionConfig);
        $appRestHandler->updateParkById();
        break;

    case "delete":
        // to handle REST Url /Park/delete/
        $appRestHandler = new ParkServiceHandler($localhostConnectionConfig);
        $result = $appRestHandler->deleteParkById();
        break;
}

