<?php

class Timecards
{
    
	protected $user;
	private $pass, $hash;

  private $conn;  //Database connector

    function __construct( $user=false, $pass=false ) 
    {
        $this->user 	= ( isset( $user ) && $user != '' && $user != false ? $user: false );
        $this->pass 	= ( isset( $pass ) && $pass != '' && $pass != false ? $pass: false );
        $this->error 	= false;
        $this->connect();
    }

    function connect()
    {
    
      $this-> conn = new PDO('sqlite:../data/jobscloking.db');


	}

    function getTimecard( $userId, $firstDay ){

        $userId = (int) $userId;

        $sql = " SELECT userid, paymentid, day1, day2, day3, day4, day5, day6, day7 ".
               " FROM timecards ". 
               " where userid = $userId and startdate ='$firstDay' ". 
               " order by paymentid;";
               
        $ret = $this-> conn ->query($sql);
        $result = $ret->fetchAll();
        return $result;

    }
    function FindTimecard( $userId, $firstDay )
    {
        $userId = (int) $userId;

        $sql = " SELECT userid ".
               " FROM timecards ". 
               " where userid = $userId and startdate ='$firstDay' ;";
               
        $ret = $this-> conn ->query($sql);
        $result = $ret->fetchAll();
       
        if ( count($result) === 0 )
        {
            return false;
        } else 
        {
            return true;
        }

    }

    function updateTimecard( $userId, $firstDay, $totalPayments, $Timecard)
    {
        $userId = (int) $userId;

        for( $i=0; $i < $totalPayments; $i++) 
        {
           $sql = " UPDATE timecards  SET day1 = ". $Timecard[$i][1];
          for ( $j=2; $j <= 7; $j++) 
          {
    
            $sql .= ", day".$j." =". $Timecard[$i][$j];
       
          }
          $idPayment = $i+1;
          $sql .= " WHERE userid=$userId and   startdate='$firstDay' and paymentid = $idPayment ;";
        
          $Data = $this->conn->prepare($sql);
           
          $result = $Data->execute();
        }
        
       return $result;
    }

    function insertRow( $sql)
    {
        $Data = $this->conn->prepare($sql);
        return $Data->execute();
    }

    function insertTimecard( $userId, $firstDay, $totalPayments, $Timecard)
    {
        $userId = (int) $userId;

        for( $i=0; $i < $totalPayments; $i++) 
        {  
           $idPayment = $i+1;
           $sql = " INSERT INTO timecards  ".
                  " ( userid, startdate, paymentid, day1, day2, day3, day4, day5, day6, day7 ) ".
                  " VALUES  (".$userId .", '$firstDay',". $idPayment;
                  
          for ( $j=1; $j <= 7; $j++) 
          {
             $sql .= ", ". $Timecard[$i][$j];
          }

           $sql .= " );";

           $result = $this->insertRow( $sql) ;

        }
       
        
        echo $result;
        /*
        $OrderNumber = $Param['order']; $LineNumber = $Param['line']; $Machine = $Param['machine'];
				$Operator = trim($Param['operator']); $Qtty = $Param['qty']; $startTime = $Param['starttime'];
				$stopTime = $Param['endtime']; $Override = $Param['override']; $Comment = $Param['comment'];
        $sql = "INSERT INTO FMLOCHIST (LHORD, LHLIN, LHMACH, LHOPER, LHQTY, LHSTRDTTIM, LHSTPDTTIM, LHSOVR, LHCOMM) VALUES ('$OrderNumber', '$LineNumber','$Machine', '	$Operator', '$Qtty', '$startTime', '$stopTime', '$Override', '$Comment')";
        $Data = $this->conn->prepare($sql);

        $Data->execute();
        */
    }

    function setTimecard( $userId, $firstDay, $totalPayments, $Timecards )
    {
      
        

        if ( $this->findTimecard( $userId, $firstDay ))
        {
           return $this->updateTimecard( $userId, $firstDay, $totalPayments, $Timecards);
        } else 
        {
           return $this->insertTimecard( $userId, $firstDay, $totalPayments, $Timecards);
        }
    }

   
}
// End of the class Users

?>