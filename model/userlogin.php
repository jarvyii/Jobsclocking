<?php

class Users
{
    
	protected $user;
	private $pass, $hash;

  private $conn;  //Database connector

    function __construct( $user=false, $pass=false ) // Types for paramters
    {
        $this->user 	= ( isset( $user ) && $user != '' && $user != false ? $user: false );
        $this->pass 	= ( isset( $pass ) && $pass != '' && $pass != false ? $pass: false );
        $this->error 	= false;
        $this->connect(); // Constructor doing work
    }

    function connect()
    {
    
      $this-> conn = new PDO('sqlite:../data/jobscloking.db');


	}

    function Login($user, $pass) // Allows user to control flow
    {

      $sql = " SELECT id, firstname, lastname, password ".
             " FROM users where username = '$user';"; // Yikes! SQL injection possible, use PDO#bindParam

      $ret = $this-> conn ->query($sql);
      $result =$ret->fetchAll();  // Why fetchAll for a single result?

      if (count($result) > 0) 
      {
            foreach ($result as $Record) 
            {
                if($Record['password'] === $pass) // The password should *never* be stored in plain text
                {
                    $Record['result'] = 1;
                    return $Record; // good user and password
                } else
                {
                    $Record['result'] = -2;
                    return  $Record; // Wrong password.
                }
            }
        } else // Funky spacing
        {
            $Record['result'] = -1;
            return $Record;// Unknown or wrong user Id
        }
   }
}
// End of the class Users


if( !isset($_GET['username']) or  !isset($_GET['userpassword'])  ){
    echo "Error: Wrong access.";
    return;
  }

  $userName =   htmlspecialchars($_GET['username']); // Not how to handle characters for SQL
  $UserPassword =  htmlspecialchars($_GET['userpassword']); // Inconsistent capitalization

  $objUser = new Users();
  $logUser = $objUser->Login( $userName, $UserPassword );

  echo json_encode( $logUser ); // This also returns their password?!

?>