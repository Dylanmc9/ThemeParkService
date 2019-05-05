<?php

require_once("../rest/SimpleRest.php");
require_once("Park.php");

class ParkServiceHandler extends SimpleRest {

    private $dbConnectionConfig;

    public function __construct(array $dbConnectionConfig) {
        $this->dbConnectionConfig = $dbConnectionConfig;
    }

    function createPark() {
        $Park = new Park();
        $rawData = $Park->createPark($this->dbConnectionConfig);

        //set status for response
        if (empty($rawData)) {
            $statusCode = 404;
            $rawData = array('success' => 0);
        } else {
            $statusCode = 200;
        }

        //add header
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $result = $rawData;

        //add response payload (i.e. content)
        $this->setResponseContent($requestContentType, $result);
    }

    function retrieveAllParks() {

        $Park = new Park();
        $rawData = $Park->retrieveAllPark($this->dbConnectionConfig);

        //set status for response
        if (empty($rawData)) {
            $statusCode = 404;
            $rawData = array('success' => 0);
        } else {
            $statusCode = 200;
        }

        //add header
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $result["output"] = $rawData;

        //add response payload (i.e. content)
        $this->setResponseContent($requestContentType, $result);
    }

    function updateParkById() {
        $Park = new Park();
        $rawData = $Park->updatePark($this->dbConnectionConfig);

        //set status for response
        if (empty($rawData)) {
            $statusCode = 404;
            $rawData = array('success' => 0);
        } else {
            $statusCode = 200;
        }

        //add header
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $result = $rawData;

        //add response payload (i.e. content)
        $this->setResponseContent($requestContentType, $result);
    }

    function deleteParkById() {
        $Park = new Park();
        $rawData = $Park->deletePark($this->dbConnectionConfig);

        //set status for response
        if (empty($rawData)) {
            $statusCode = 404;
            $rawData = array('success' => 0);
        } else {
            $statusCode = 200;
        }

        //add header
        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        $result = $rawData;

        //add response payload (i.e. content)
        $this->setResponseContent($requestContentType, $result);
    }

}
