<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <title>Jobsclocking System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/timecards.css">
    <link rel="stylesheet" href="css/login.css">

  </head>

  <body id="home" data-spy="scroll" data-target=".navbar" data-offset="100">
    <head>
    <!-- NAV Menue -->
    <nav id ="navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container-fluid">
          <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarExample01"
            aria-controls="navbarExample01"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item active">
                <a class="nav-link" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Reports</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">HH-RR</a>
              </li>
            </ul>
          </div>
        </div>
     </nav>

    </head>
   
    <!--  It include the Jumbotron, Login Form and the tiemesheet Form-->
    <main id="main" role="main">
          <div id="bar-jumbotron"></div>
            <!-- Main jumbotron for a  marketing message about the system-->
            <div id="jumbotron" class="jumbotron">
              <div class="container page-header">
                  <div class="row hidden-xs justify-content-center">
                    <img class="img-jumbo rounded-circle" src="img/clockin.png"  alt="">
                      <h1 id="jumboh6" class="display-5 text-sm-center">Jobsclocking System!</h1>
                      <img class="img-jumbo rounded-circle" src="img/clockout.png"  alt="">
                  </div>  <!-- /Row -->
              </div> <!-- /Container -->
            </div> <!-- /jumbotron -->
       <div id = "divlogin"></div>
       <!-- Timesheet form to update the worked hour-->
      <div id="timesheet" class="container text-center d-none">
          <form id="formTimecard" class="formTimecard">
             <!--Hide field to be use in others area of the web -->
             <input type="hidden" id = "idUser" name="idUser" class = "formInput">
             <input type="hidden" id = "idPeriod" name="idPeriod" class = "formInput">
             <input type="hidden" id = "activePeriod" name="activePeriod" class = "formInput">
            <!-- The head of the timesheet -->
              <div class="row">
                <div class="col-md-4">
                  <h4 id="fullname"><span class="headlabel">Name:</span> </h4>
                </div>
                <div class="col-md-4">
                  <h4 id="period"><span class="headlabel">From: </span></h4>
                </div>
                <div class="col-md-4">
                  <h4 id="id-date"><span class="headlabel">Date: </span></h4>
                </div>
              </div>
              <hr>
              <!-- The squeleton of the Timesheet. It is created with JavaScript function -->
              <!-- I use the form of a Matrix 5x8 to work with it.  -->
             <div class="row bg-success">
               <div class="col-md-4">
                 <div class="row">
                   <div id= "column-0" class="col-4 "></div>
                   <div id= "column-1" class="col-4">Monday</div>
                   <div id= "column-2" class="form-group col-4">Tuesday</div>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="row">
                 <div id= "column-3" class="form-group col-4">Wednesday</div>
                 <div id= "column-4" class="form-group col-4">Thursday</div>
                 <div id= "column-5" class="form-group col-4">Friday</div>
               </div>
              </div>
              <div class="col-md-4">
                   <div class="row">
                     <div id= "column-6" class="form-group col-4">Saturday</div>
                     <div id= "column-7" class="form-group col-4">Sunday</div>
                     <div id= "column-8" class="form-group col-4">TOTAL</div>
                   </div>
               </div>
              </div>
              <div id="button-main">
               <button id="submmit" type="button" class="btn btn-secondary btn-lg">Submit</button>
               <button id="save" type="button" class="btn btn-secondary btn-lg">Save</button>
               <button id="restore"type="button" class="btn btn-secondary btn-lg">Restore</button>
               <button id="print" type="button" class="btn btn-secondary btn-lg">Print</button>
              </div>
          </form>
        </div>
    </main>  
    <!--\\ Start the week Days-->
 
        <!-- \About -->
    
    <!-- /body -->
    <!-- Footer -->
    <footer >
      <div class="footer text-md-center">
          <a href="https://www.linkedin.com/in/jareynaldo/" target="_blank"><small>&copy; 2021 Clocking System 2.0 &amp; Jarv INC</small></a>
      </div>
    </footer>
    <!-- /Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="view/timecard.js"></script>
    <script src="view/login.js"></script>
  </body>
</html>
