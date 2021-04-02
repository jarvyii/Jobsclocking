<?php
require_once 'FPDF/fpdf.php';

class PDF extends FPDF
{
  // Load data

  
function LoadData()
{

  $Description = array("Regulars ", "Sicks ", "Holidays ", "Vacations ", "TOTAL ");
  $userId =  (int) htmlspecialchars($_POST['idUser']);

  

   $this->userName = htmlspecialchars($_POST['username']);
   $this->startDay = htmlspecialchars($_POST['startday']);
   $this->lastDay =  htmlspecialchars($_POST['lastday']);

  $totalPayments = (int) htmlspecialchars($_POST[ "totalpayments" ]);

 

  for( $i=0; $i < $totalPayments; $i++) 
  {

    $Timecard[$i][0] = $Description[$i];
      for ( $j=1; $j <= 7; $j++) 
      {

          $Timecard[$i][$j] =  isset($_POST["totalpayments"]) ?  htmlspecialchars($_POST[ 'Data'.$i.$j]) : 0;

      }

  }
    
    return $Timecard;
}
// Simple table
function BasicTable($header, $data)
{
    // Header
    $this->SetFont('Arial','',10);

    $this->Cell(20,7,"Name: ",0, 0,'R');
    $this->SetFont('Arial','B',10);
    $this->Cell(45,7, $this->userName,0, 0,'L');

    $this->SetFont('Arial','',10);
    $this->Cell(30,7,"From: ",0, 0,'R');

    $this->SetFont('Arial','B',10);
    $this->Cell(20,7, $this->startDay,0, 0,'L');

    $this->SetFont('Arial','',10);
    $this->Cell(4,7," to ",0, 0,'C');

    $this->SetFont('Arial','B',10);
    $this->Cell(30,7, $this->lastDay,0, 0,'L');

    $this->Ln(20);
    $this->SetFont('Arial','B',10);
    foreach($header as $index => $col)
    {
      if ( $index == 0 ) {

         $this->Cell(30,7,trim($col),1, 0,'C');

       } elseif  ( $index == 7 ) {

          $this->Cell(30,7,trim($col),1, 0,'C');

       } else {

          $this->Cell(22,7,trim($col),1, 0,'C');

       }
    }

    $this->Ln();
    $this->Ln(3);
    // Data
    $this->SetFont('Arial','',10);

    foreach($data as $row)
    {
        foreach($row as $index => $col)
          if ( $index == 0) {
            $this->SetFont('Arial','B',10);
            $this->Cell(30,6,trim($col),1, 0,'C');

          } elseif ( $index == 7 ) {

             $this->Cell(30,6,trim($col),1, 0,'C');

          } else {
            $this->SetFont('Arial','',10);
             $this->Cell(22,6,trim($col),1, 0,'C');
          }

        $this->Ln();
    }
}	
// Page header
	
function Header()
{
	// Logo
	$this->Image('../img/jobsclocking.png',37,10,140, 11);
             // ($file, $x=null, $y=null, $w=0, $h=0, $type='', $link='')
	// Arial bold 15
	$this->SetFont('Arial','B',16);
	// Move to the right
	$this->Ln(20); 
	$this->Cell(80);
	// Title
	$this->Cell(30,10,'Timecard Report',0,0,'C');
	// Line break
	$this->Ln(20);  
}

// Page footer
function Footer()
{ 
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial', 'I', 10);
 	$Supervisor =  "Jose Reynaldo, Software Developer"; //'User name: '.htmlspecialchars( $_POST['operator'] ) ; 
	//$this->Cell(0, 10, $Supervisor, 0, 0);
	$mydate=getdate(date("U"));
	$dDate = " Date: ". date('m/d/Y h:i:s a', time());//"$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	//$this->Cell(0, 10, $dDate, 0, 0);
	// Page number
	$this->Cell(0, 10,$Supervisor.'           ' .$dDate.'           Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
} 
}


function createPDF()
{ 
  $pdf = new PDF('P','mm','Letter');

  // Column headings
  $header = array('Payments', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

  $data = $pdf->LoadData();


  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFont('Arial','',10);
  $pdf->BasicTable($header,$data);
  
  $pdf->Output(); 
  
}


createPDF();
echo json_encode("OK");
  // echo  $P;
  return ;

?>
