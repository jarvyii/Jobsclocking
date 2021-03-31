<?php
require_once 'classTimecards.php';

if( !isset($_GET['userid']) or  !isset($_GET['firstday'])  ){
    echo "Error: Wrong access.";
    return;
  }

  $userId =   htmlspecialchars($_GET['userid']);
  $firstDay =  htmlspecialchars($_GET['firstday']);
 
  $objTimecard = new Timecards();
  $userTimecard = $objTimecard->getTimecard( $userId, $firstDay );

  echo json_encode( $userTimecard );

?>