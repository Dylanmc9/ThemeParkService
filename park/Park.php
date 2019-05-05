<?php

require_once("../db/DBController.php");

/*
  A domain class to demonstrate RESTful web services
 */

Class Park {

    private $parks = array();

    public function createPark(array $dbConnectionConfig) {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $city = '';
            $ticket_price = ''; 
            if (isset($_POST['city'])) {
                $city = $_POST['city'];
            }
            if (isset($_POST['ticket_price'])) {
                $ticket_price = $_POST['ticket_price'];
            }

            $dbcontroller = new DBController($dbConnectionConfig);
            $query = "insert into tbl_parks (name,city,ticket_price) values ('" . $name . "','" . $city . "','" . $ticket_price . "')";
            $result = $dbcontroller->execute($query);     // Use this method to run inserts/updates/deletes
            if ($result != 0) {
                $result = array('success' => 1);
                return $result;
            }
        }
    }

    public function retrieveAllParks(array $dbConnectionConfig) {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $query = 'SELECT * FROM tbl_parks WHERE name LIKE "%' . $name . '%"';
        } else {
            $query = 'SELECT * FROM tbl_parks';
        }
        
        $dbcontroller = new DBController($dbConnectionConfig);
        $stmt = $dbcontroller->query($query);      // Use this method to run select statements
        $this->parks = $stmt->fetchAll();
        return $this->parks;
    }

    public function updateParks(array $dbConnectionConfig) {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $city = $_POST['city'];
            $ticket_price = $_POST['ticket_price'];
            $query = "UPDATE tbl_parks SET name = '" . $name . "',city ='" . $city . "',ticket_price = '" . $ticket_price . "' WHERE id = " . $id;
        }
        $dbcontroller = new DBController($dbConnectionConfig);
        $result = $dbcontroller->execute($query);     // Use this method to run inserts/updates/deletes  
        if ($result != 0) {
            $result = array('success' => 1);
            return $result;
        }
    }

    public function deletePark(array $dbConnectionConfig) {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $query = 'DELETE FROM tbl_parks WHERE id = ' . $id;
        }
        $dbcontroller = new DBController($dbConnectionConfig);
        $result = $dbcontroller->execute($query);     // Use this method to run inserts/updates/deletes                       

        if ($result != 0) {
            $result = array('success' => 1);
            return $result;
        }
    }

    public function getPark() {
        // define order field
       // $sOrderField = ($this->sOrder == 'id') ? 'title' : 'views';

        // obtain data from database
        $aData = $GLOBALS['MySQL']->getAll("SELECT * FROM tbl_parks");

        // output in necessary format
        switch ($this->sMethod) {
            case 'json': // gen JSON result
                // you can uncomment it for Live version
                // header('Content-Type: text/xml; charset=utf-8');
                if (count($aData)) {
                    echo json_encode(array('data' => $aData));
                } else {
                    echo json_encode(array('data' => 'Nothing found'));
                }
                break;
            case 'xml': // gen XML result
                $sCode = '';
                if (count($aData)) {
                    foreach ($aData as $i => $aRecords) {
                        $sCode .= <<<EOF
<unit>
    <id>{$aRecords['id']}</id>
    <title>{$aRecords['title']}</title>
    <author>{$aRecords['author']}</author>
    <image>{$aRecords['thumb']}</image>
    <views>{$aRecords['views']}</views>
</unit>
EOF;
                    }
                }

                header('Content-Type: application/json; charset=utf-8');
                echo <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<videos>
{$sCode}
</videos>
EOF;
            }
    }

}
