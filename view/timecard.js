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
              p.className="form-control description bg-success";
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
    var numRow = this. id[4];
    // To update the Total of the Row
    document.getElementById("Data"+numRow+8).value=0;
    var valTotal = 0;
    for (var j=1; j<= 8; j++ ){
      valTotal += Number(document.getElementById("Data"+numRow+j).value)
      }
    document.getElementById("Data"+numRow+8).value = valTotal;
    valTotal = 0;
    for (var i=1; i< totalWayPayments; i++ ){
      valTotal += Number(document.getElementById("Data"+i+numColumn).value)
      }
    document.getElementById("Data"+totalWayPayments+numColumn).value = valTotal;
    document.getElementById("Data"+totalWayPayments+8).value = 0;
    valTotal=0;
    for( j= 1; j <=7; j++){
      valTotal += Number(document.getElementById("Data"+totalWayPayments+j).value);
    }
    document.getElementById("Data"+totalWayPayments+8).value = valTotal;
  } // \FUNCTION updateTotalOnChange()
/* To create a dom element  in the Timesheet form*/
function addDay(i, j, value, disabledValue){
           var p = document.createElement("INPUT");
           p.id= "Data"+i+j;
           if ( (i == Description.length) || (j == 8) ) {
                 p.className="form-control totalInfo";
             } else {
                 p.className="form-control";
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
            addDay(i, j, objTimecard[i]['day'+j], !document.getElementById("activePeriod").value )
            columnTotal += Number(objTimecard[i][j]);
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
function setTimecardValues( objTimecard ){

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

function setHeaderTimecard(User) {
    
    const dToday = new Date(); 
    const firstDay = getFormattedDate(startOfWeek(dToday));
    const lastDay = getFormattedDate(endOfWeek(dToday));
    const Period = {
        firstDay : firstDay,
        lastDay: lastDay
    }

    document.getElementById("fullname").innerHTML += User.lastname + ",  "+ User.firstname;
    document.getElementById("period").innerHTML += firstDay + " to "+ lastDay;
    document.getElementById("id-date").innerHTML +=  getFormattedDate(dToday);

    return Period;

}

function createFormTimecard(User){
      $("#loginform").remove();
     // document.getElementById("divtimecard").innerHTML = formContent;
     document.getElementById("timesheet").className = "container text-center d-block";
     const Period = setHeaderTimecard(User);

     setBodyTimecard(User, Period); 
     

}

  function Timecard( User ){

        createFormTimecard(User);
  }

  $(document).ready(  function() {


  });