<?php

class Users
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

    function Login($user, $pass)
    {

      $sql = " SELECT id, firstname, lastname, password ".
             " FROM users where username = '$user';";

      $ret = $this-> conn ->query($sql);
      $result =$ret->fetchAll();

      if (count($result) > 0) 
      {
            foreach ($result as $Record) 
            {
                if($Record['password'] === $pass)
                {
                    $Record['result'] = 1;
                    return $Record; // good user and password
                } else
                {
                    $Record['result'] = -2;
                    return  $Record; // Wrong password.
                }
            }
        } else 
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

  $userName =   htmlspecialchars($_GET['username']);
  $UserPassword =  htmlspecialchars($_GET['userpassword']);
 
  $objUser = new Users();
  $logUser = $objUser->Login( $userName, $UserPassword );

  echo json_encode( $logUser );

?>