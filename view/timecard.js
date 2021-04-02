const userName = document.getElementById("user-name"); 
const userPassword = document.getElementById("user-password");

// Different type of payments
const Description =[
    "Regulars ",
    "Sicks ",
    "Holidays ",
    "Vacations ",
    "TOTAL "
  ];
const totalWayPayments = Description.length ;

 /*********************************************************************************
 Write in the DOM the Content of the Column Description of the Timecards
*********************************************************************************/
function writePaymentsDescription(){
   
      function addDescrption(value){    //Add the description to the column
          var p = document.createElement("INPUT");
              p.style.margin =0;
            //  p.border-style = none;
              p.className="form-control description tcBackgraound";
              p.setAttribute("type", "text");
              p.setAttribute("value", value);
            //  p.disabled = true;
              document.getElementById("column-0").appendChild(p);
            
        } 

       document.getElementById("column-0").innerHTML ="Payments";

       Description.forEach(addDescrption);
}
/*******************************************************************************
 Function to Update the Total Column and Total Row with any change in the Timecard Form
 ********************************************************************************/
 function updateTotalOnChange(){
    var numColumn =  this.id[5];

    document.getElementById("save").disabled = false;
    
    var numRow = this. id[4];
    // To update the Total of the Row
    document.getElementById("Data"+numRow+8).value=0;
    var valTotal = 0;
    for (var j=1; j<= 8; j++ ){
      valTotal += Number(document.getElementById("Data"+numRow+j).value)
      }
    document.getElementById("Data"+numRow+8).value = valTotal;

    valTotal = 0;
    for (var i=0; i< totalWayPayments-1; i++ ){
      valTotal += Number(document.getElementById("Data"+i+numColumn).value)
      }
    const lastRow =  totalWayPayments-1;
    document.getElementById("Data" + lastRow + numColumn).value = valTotal;
    
    valTotal=0;
    for( j= 1; j <=7; j++){
      valTotal += Number(document.getElementById("Data"+ lastRow +j).value);
    }
    document.getElementById("Data"+ lastRow +8).value = valTotal;
  } // \FUNCTION updateTotalOnChange()

/* To create a dom element  in the Timesheet form*/
function addDay(i, j, value, disabledValue){
           var p = document.createElement("INPUT");
           p.id= "Data"+i+j;
           p.name= "Data"+i+j;
           if ( (i == Description.length) || (j == 8) ) {
                 p.className="form-control" ;
             } else {
                 p.className="form-control formInput";
             }
           p.setAttribute("type", "number");
           p.setAttribute("value", value);
          p.min="0";
          p.max="24";
          p.step="0.5";
          p.addEventListener("input", updateTotalOnChange);
          p.disabled = disabledValue;
          document.getElementById("column-"+j).appendChild(p);
       }
/******************************************************************************
 Use all info of the Timecard Array to create the scaque in the Timecards Sheet
******************************************************************************/
function writeDays( objTimecard ){
    var columnTotal=0;
    var rowTotal =0;

    for(var i=0; i < Description.length-1; i++ ){
        columnTotal =0;
        for(var j=1; j<8; j++){

            addDay(i, j, objTimecard[i]['day'+j], !document.getElementById("activePeriod").value );

            
            columnTotal += Number(objTimecard[i]['day'+j]);
          }
        addDay(i, j, columnTotal, true); // Fill the Info in the TOTAL  of the i row
      }
    
    var grantTotal = 0; // Total of hour worked in the week.
    for(var j=1; j<8; j++){
          rowTotal=0;
          for(var i=0; i < Description.length-1; i++ ){
            rowTotal += Number(objTimecard[i]['day'+j])
          }
          addDay(i, j, rowTotal, true);// Fill the Info in the TOTAL of the i row
          grantTotal += rowTotal;
      }
      addDay(i, j, grantTotal, true);
    //  var p = document.createElement("INPUT");
  }// \FUNTION    writeDays()

 function fillEmptyTimecard( ) {
     let objTimecard =[]
    for(var i=0; i < Description.length-1; i++ ){
        objTimecard[i] = [];
        for(var j=1; j<8; j++){
            
            objTimecard[i]['day'+j] = 0;
            
          }

      }
       
      return objTimecard;
 } 


function setTimecardValues( objTimecard ){

    if(objTimecard == "")
    {
        
        objTimecard = fillEmptyTimecard( );
        

    }

    writeDays( objTimecard );

}
function fillTimecard( User, Period ){

    myURL = "model/gettimecard.php?userid="+ User.id + "&firstday="+ Period.firstDay;
    

    ajaxGET( myURL )
         .then( setTimecardValues )
         .catch( err => alert( err ) );
           

}

function setBodyTimecard( User, Period ){
    writePaymentsDescription();
    fillTimecard( User, Period );

}
function getFormattedDate(date) {
    var year = date.getFullYear();

    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;

    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;
    
    return month + '/' + day + '/' + year;
}
function startOfWeek(date)
{
    var diff = date.getDate() - date.getDay() + (date.getDay() === 0 ? -6 : 1);

    return new Date(date.setDate(diff));

}
function endOfWeek(date)
  {
     
    var lastday = date.getDate() - (date.getDay() - 1) + 6;
    return new Date(date.setDate(lastday));
 
  }
function createFormElement( name, value, type , status){
    var p = document.createElement("INPUT");
    p.id= name;
    p.name= name;
    p.className="form-control formInput";
    p.setAttribute("type", type);
    p.setAttribute("value", value);

   p.disabled = status;

   return p;
   
}
function setHeaderTimecard(User ){
    
    const dToday = new Date(); 
     firstDay = getFormattedDate(startOfWeek(dToday));
     
     lastDay = getFormattedDate(endOfWeek(dToday));
    const Period = {
        firstDay : firstDay,
        lastDay: lastDay
    }

    document.getElementById("fullname").innerHTML += "<strong>"+User.lastname + ",  "+ User.firstname + "</strong>";
    document.getElementById("username").value =  User.lastname + ",  "+ User.firstname;
    document.getElementById("period").innerHTML += "<strong>" + firstDay + " to "+ lastDay + "</strong>";
    document.getElementById("startday").value = firstDay;
    document.getElementById("lastday").value = lastDay;
    document.getElementById("id-date").innerHTML +=  "<strong>" + getFormattedDate(dToday) + "</strong>";
    document.getElementById("activePeriod").value = true;

    document.getElementById("idUser").value = User.id;
    document.getElementById("idPeriod").value = Period.firstDay;
    
    const Element = createFormElement(  "totalpayments",totalWayPayments-1,  "hidden", false);
    document.getElementById("formTimecard" ).appendChild(Element);

    return Period;

}
/*****************************************************************************
  Switch between de Main Menu and the About Menu
******************************************************************************/
function menueAbout() {
  document.getElementById("main").style.display = "none";
  document.getElementById("about").style.display = "block";
  return false;
} // \menueAbout()

/**********************************************************************
Switch between the About menu and the  Home MENU
**********************************************************************/
function menueHome() {
 document.getElementById("main").style.display = "block";
 document.getElementById("about").style.display = "none";
    return false;
} // \menueHome()

function createFormTimecard(User){
      $("#loginform").remove();
     // document.getElementById("divtimecard").innerHTML = formContent;
     document.getElementById("timesheet").className = "container text-center d-block";
     const Period = setHeaderTimecard(User);

     setBodyTimecard(User, Period); 
     

}

  function Timecard( User ){
    document.getElementById("about-menu").addEventListener("click", menueAbout);
    document.getElementById("home-menu").addEventListener("click", menueHome);
    document.getElementById("search-form").style.display = "block";
    createFormTimecard(User);
  }

  /*******************************************
 Call a (PHP) Backend function to save data with the specific URL.
********************************************/
function postAJAX( Url, formClass ){
    
    if (window.XMLHttpRequest) {
              xmlhttp = new XMLHttpRequest();
     }else {
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
     }

    var elements = document.getElementsByClassName(formClass);
    console.dir(elements);
     var formData = new FormData(); 
     for(var i=0; i<elements.length; i++)
     {
         formData.append(elements[i].name, elements[i].value);
     }
     
     xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              console.dir(this.responseText);
             if (this.responseText != "OK") {
                alert("Sorry. No updated");
             } else {
                 return "OK";
             }

         }
     }
     
     xmlhttp.open("post", Url, true);
     xmlhttp.send(formData);  

}

  /**************************************************************************
 Save all INFO to the Database, the employee can continue working on it later.
**************************************************************************/
$('#save').click(function () {
    const myURL = "model/settimecard.php";
    const formTimecard = "formInput";
    postAJAX( myURL,  formTimecard);
    document.getElementById("save").disabled = true;
            

   }); // /$('#save').click(function ());

  $(document).ready(  function() {


  });