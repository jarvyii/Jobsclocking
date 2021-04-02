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
    <nav id ="navbar" class="navbar navbar-expand-sm navbar-light bg-white fixed-top">
       <span class="navbar-brand mb-0 h1"><img src="img/clock blue.png" width="25" height="25" alt=""></span>
       <a id="exit-nav" class="navbar-brand order-1 mr-0" href="http://localhost/jobsclocking/index.php" target="_self">
          <img id="image-exit-nav" src="" width="25" height="25" alt=""></span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>   
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
            <ul class="navbar-nav mr-auto ">
              <li class="nav-item active">
             <!--   <a class="nav-link" aria-current="page" href="#">Home</a> -->
                <a id="home-menu" class="nav-link" href="#main">Home <span class="sr-only">(current)</span></a></li>
              <li class="nav-item">
              <!--  <a class="nav-link" href="#about">About</a> -->
                <a id="about-menu" class="nav-link" href="#about">About</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
              <li class="nav-item"><a class="nav-link" href="#">HH-RR</a></li>
            </ul>
          </div>
        </div>
        <a id="user-nav" class="navbar-brand mr-4" href="https://www.linkedin.com/in/jareynaldo/" target="_blank">Jose A Reynaldo </a>
          <form id="search-form"class="form-inline my-2 my-lg-0">
                <input id="searchPeriod" class="form-control mr-sm-2" type="text" placeholder="Period" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">to Search</button>
          </form>
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
          <form id="formTimecard" class="formTimecard"  method= "POST" target="_blank" action = "model\reportTimecard.php"> 
             <!--Hide field to be use in others area of the web -->
             <input type="hidden" id = "idUser" name="idUser" class = "formInput">
             <input type="hidden" id = "username" name="username">
             <input type="hidden" id = "startday" name="startday">
             <input type="hidden" id = "lastday" name="lastday">
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
             <div class="row tcBackgraound">
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
               <button id="save" type="button" class="btn btn-secondary btn-lg" disabled>Save</button>
               <button id="restore" type="reset" class="btn btn-secondary btn-lg">Reset</button>
               <button id="btnReport" name = "btnReport" target = "_blank" type="submit" class="btn btn-secondary btn-lg">Print</button>
              </div>
          </form>
        </div>
    </main>  


    <div class="main">
      <!-- /About -->
      <div id="about">
        <div id="bars-about"></div>
       <h2>Timecards System</h2>
       <hr>
       <p id="header-text">TimesCards System is a coorporate tool that provides a timesheet system
          with project organization features and time tracking. This software is WEB-based, and can be
          run on any Computer, across a network or in any movil device. Project budgeting, reporting,
          and billing are easy to do with this software.
       </p>
       <p> With the System you can have the control of the Timesheet of your employees, week per week and with different way of payments.
           By default: </p>
           <ul>
            <li> <strong>Regulars</strong></li>
            <li> <strong>Sicks</strong></li>
            <li> <strong>Holidays</strong></li>
            <li> <strong>Vacations</strong></li>
           </ul>
            <section>
             <h2>Options</h2>
             <hr>
             <h6>MENU:</h6>
             <image class="icon-position img-fluid" src="img/timesheet-menue.png" alt = "Timesheet Menue Image">
             <p><br><span class="bold-text">Home:</span> Allow the user to use and update the timesheet in the active week.</p>
             <p><span class="bold-text">About:</span> Give you all information about the System and how you can use it.</p>
             <p><span class="bold-text">Report:</span> You can access to different report in correspondt with the user access level.</p>
             <p><span class="bold-text">HH-HH:</span> This option is to be  use only for HH-RR Deparment. They can access to modify closed period, add emplyee, and remove employee<./p>
             <p><span class="bold-text">Period to Search:</span> Allow you to type and old and closed period. You can see it and print it.</p>
             <h3>TIMESHEET Fields:</h3>
             <hr>
             <image class="icon-position img-fluid" src="img/timesheet.png" alt = "Timesheet Cards Image">
            <p><span class="bold-text">Name:</span> First and Last name of the employee</p>
            <p><span class="bold-text">From:</span> The First day and the Last day of the week.</p>
            <p><span class="bold-text">Date:</span> The date of the month.</p>
            <p><span class="bold-text">Description:</span> Differents way of payments. By default:</p>
           <ul>
            <li> <strong>Regulars</strong></li>
            <li> <strong>Sicks</strong></li>
            <li> <strong>Holidays</strong></li>
            <li> <strong>Vacations</strong></li>
           </ul>
            <p><span class="bold-text">Timesheet:</span> The employee can update his working hour in this week, for Monday to Sunday. He has until Sunday 11:59 PM of the active week to update his hours.</p>
           
            <p><span class="bold-text">Form BUTTONS</span></p>
            <hr>
            <image class="icon-position img-fluid" src="img/formButtons.png" alt = "Timesheet Cards Image">
            <p><span class="bold-text">Save:</span> Save the information to the database system.</p>
            <p><span class="bold-text">Reset:</span> Restore the old value saved in the database system.</p>
            <p><span class="bold-text">Print:</span> Print the work report.</p>
            <image class="icon-position img-fluid" src="img/reportTimecard.png" alt = "Timesheet Cards Image">
          </section>
            <section>
            </section>
        </div>
        <!-- \About -->
      </div>

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
