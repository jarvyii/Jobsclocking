Jobsclocking System. Version 2.0

**************************************************************************************
REQUIREMENTS TO EXECUTE THE PROJECT

I use SQLITE as Database system.

 1- You need to use a WEB Server in oder to access the table on database. I use XAMPP in my Computer.
  
 2- You have to Login using one of this users:
  
      - User: a@ta.com    Password: a
	  - User: b@tb.com    Password: b
	  
	  You can create your own User and Password updating the table users on data/jobsclocking.db database:  jobsclocking.db  
*****************************************************************************************
 
Description

This is a dynamic WEB site. Its designed to be use for differents Companies or individual person. 

You have to initiate the system  with the Costumer information (Company Name, WEB address).

The purpose is to create a website where the employees can update their own worked hour every week and they can access to see and print old periods.

PENDING: HH-RR department will have the access to add or delete users from the system and modify the timesheet of the last closed period.
         The Supervisor must approobe it every week and must have access to all his employees.

You has to login using one of the predefined users created by HH-RR Department in order to use the website.

The Login Form has to validate the User and Password through my own JavaScript function with the stored info in the table USERS. I use a regular expression to validate that the user name has to be an email account.

The employee can modify any worked hour during the active week. 

I created new event to manipulate the totals by columns, by rowd, and by the Grand total of the week. In the beggining the save button is disabled but after the first changed in any value the save button is automatic ebabled. If the user save his information the button is disabled again.

I add in the rooth folder 2 images (login.jpg and timesheet.jpg) to show you how you will see the login form and timesheet forms working in the right way.
		 

1. Custom CSS Classes
   The class(es) I created are:

  .headlabel 
  .img-jumbo
  .cancelbtn
  .totalInfo
  
2- SQLite Database. 
	 
      USERS
	 ***********************************
	 Name        Type            NN   AI
      -----------------------------------
      iduser       INT             X    X
      username     TEXT            X 
      password     TEXT            x 
      firstname    TEXT            x
      lastname     TEXT            x 
	 
	 
	 TIMECARDS
	 **********************************
      Name        Type            NN   AI    DEFAULT
      -----------------------------------
      userid      INT             x
      startdate   TEXT            x
      day1        INT                           0
      day2        INT                           0
      day3        INT                           0
      day4        INT                           0
      day5        INT                           0
      day6        INT                           0
      day7        INT                           0

    
3. Custom JavaScript Functions
   My functions:

   timecard.js
   *******************************************************************
 
   1-) function writePaymentsDescription()
       Write in the DOM the Content of the Column Description of the Timecards

   2-) function updateTotalOnChange()
       To update the total by column, the total by row, and grant total with any change make in the Timecard Form 

   3-) function addDay(i, j, value, disabledValue)
       To create a dom element  in the Timesheet form

   4-) function writeDays( objTimecard )
       Use all info of the timecard Array to create the scaque in the Timecards Sheet

   5-) function fillEmptyTimecard( ) 
       Fill 0 in any new week.

   6-) function fillTimecard( User, Period )
       Call an ajax function to read the info of the employee in an specific week

   7-) function getFormattedDate(date) 
        To format a date value

   8-) function startOfWeek(date)
       Return the first day of the week

   9-) function endOfWeek(date)
       Return the last day of the week

   10-) function createFormElement( name, value, type , status)
       Return a new form element

   11-) function setHeaderTimecard(User )
       To set the header of the timecard

   12-) function menueAbout() 
       Switch between de Main Menu and the About Menu

   13-) function menueHome() 
      Switch between the About menu and the  Home MENU

   14-) function createFormTimecard(User)

   15-) function postAJAX( Url, formClass )
       Call a (PHP) Backend function to save data with the specific URL. Using AJAX and the POST method

   16-) $('#save').click(function () 
       Save all INFO to the Database, the employee can continue working on it later.

   login.js
   *******************************************************************

   1-) function createDiv(Type, Id, className, Text)
       Return a mew DOM element

   2-) function createForm() 
       To create and return a new form

   3-) function  createLoginForm() 
       To create a new login form

   4-) function ajaxGET( myUrl ) 
       Use to access and (PHP) backend module to return the user data information store in a SQLite database system.
       Using AJAX functiosn with GET method.  
   
   5-) function validUser ( value )
       To valid the user information returned by the ajax function accesing a PHP backend service.

   6-) function checkUser(){
       Prepare the condition with the user information to call the ajax function to access the database in SQLite

   7-) function isValidEmail(email) 
      To valid email account format using a regular expresion 



