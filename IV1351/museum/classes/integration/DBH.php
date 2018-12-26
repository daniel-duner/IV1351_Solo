<?php

class DBH{

    function __constrcut(){

    }

    //create a connection to the database
    private function connect(){
        $servername = "localhost";
        $username = "danne";
        $password = "danne123";
        $dbname = "museum";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        mysqli_set_charset($conn,"utf8");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

  //prepare a safe statement and retrieves the data from the database
  public function safeExecution($sql,array $param){
    $conn = $this->connect();
    if(empty($param)){
        $nrOfVar = 0;
    }
    else{
        $stmt = $conn->prepare($sql);
        $nrOfVar = count($param);
    }
    switch($nrOfVar){
        case 0:
        break;
        case 1:
        $stmt->bind_param('s',$param[0]);
        break;
        case 2:
        $stmt->bind_param('ss',$param[0],$param[1]);
        break;
        case 3:
        $stmt->bind_param('sss',$param[0],$param[1],$param[2]);
        break;
        case 4:
        $stmt->bind_param('ssss',$param[0],$param[1],$param[2],$param[3]);
        break;
        case 5:
        $stmt->bind_param('ssss',$param[0],$param[1],$param[2],$param[3],$param[4]);
        break;
        }
        if($nrOfVar == 0){
            $result = mysqli_query($conn,$sql);
        }else {
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }

    public function safeQuery($sql,array $param){
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $nrOfVar = count($param);
        switch($nrOfVar){
            case 0:
            break;
            case 1:
            $stmt->bind_param('s',$param[0]);
            break;
            case 2:
            $stmt->bind_param('ss',$param[0],$param[1]);
            break;
            case 3:
            $stmt->bind_param('sss',$param[0],$param[1],$param[2]);
            break;
            case 4:
            $stmt->bind_param('ssss',$param[0],$param[1],$param[2],$param[3]);
            break;
            case 5:
            $stmt->bind_param('ssss',$param[0],$param[1],$param[2],$param[3],$param[4]);
            break;
            }
            $stmt->execute();
            return $stmt;
        }

}
