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

   
}
// End of the class Users

?>