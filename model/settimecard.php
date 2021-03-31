<?php
require_once 'classTimecards.php';


if( !isset($_POST["totalpayments"]) or  !isset($_POST["Data01"])  ){
    echo "Error: Wrong access.";
    return;
  }

  $userId =  (int) htmlspecialchars($_POST['idUser']);

  $firstDay =  htmlspecialchars($_POST['idPeriod']);

  $totalPayments = (int) htmlspecialchars($_POST[ "totalpayments" ]);

 

  for( $i=0; $i < $totalPayments; $i++) 
  {
      for ( $j=1; $j <= 7; $j++) 
      {

          $Timecard[$i][$j] =  isset($_POST["totalpayments"]) ?  htmlspecialchars($_POST[ 'Data'.$i.$j]) : 0;

      }

  }

 
  $objTimecards = new Timecards();
  $userTimecard = $objTimecards->setTimecard( $userId, $firstDay, $totalPayments, $Timecard );

  echo json_encode( $userTimecard );

?>