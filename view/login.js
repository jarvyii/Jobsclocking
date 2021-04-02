
function createDiv(Type, Id, className, Text)
{
   let Div = document.createElement( Type ); 

   if( Id != "" ) {
    Div.id= Id;
   }
    
  Div.innerHTML = Text;

  if ( className != "" )
    {
        Div.className =  className;
    }

    Div.style.textAlign = "center";

    return Div;
}

function createForm() {
    const form = document.createElement("form");
    form.setAttribute("method", "GET"); 
    form.setAttribute("action", "../model/login.php" );
    form.id = "loginform";
    form.name = "loginform";
    return form;
}
function  createLoginForm() {
    let form = createForm();

    const divForm = createDiv("div", "divForm", "", "");
    form.appendChild(divForm);
    $("#divlogin").append(form);

    const divImage = '<div class="imgcontainer"><img src="img/login.jpg" alt="Login now" class="avatar"></div>';
    document.getElementById("divForm").innerHTML = divImage;  

    const divloginimput= createDiv("div", "loginimput", "loginimput", "");
    form.appendChild(divloginimput);
    
    const loginimput = '<div><label for="uname"><b>E-Mail @:</b></label><input id="user-name"  autocomplete="username" type="text"  name="uname" required></div>';
    document.getElementById("loginimput").innerHTML = loginimput; 

    const inputError = '<div id="inputerror" class="text-danger"></div>';
    document.getElementById("loginimput").innerHTML += inputError;

    let user = document.getElementById("user-name" );
    //user.title = "Pattern = Email Address";
    user.pattern = "^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$";
    user.placeholder = "account@domain.com";
    //const divPassword = createDiv("div", "divPassword", "", "");
    //form.appendChild( divPassword);

    let Password = '<div id="divPassword"><label for="psw"><b>Password: </b></label>';
    Password += '<input id="user-password" autocomplete="current-password" type="password" placeholder="Enter Password" name="psw" required>';
    
    passwordError = '<div id="passworderror" class="text-danger"></div>';
    Password += passwordError;
    Password += '<label><input type="checkbox" checked="checked" name="remember"> Remember me</label></div>';
  
    document.getElementById("loginimput").innerHTML += Password; 

    

    let Buttons = '<div class="container justify-content-center">';
    Buttons += '<button type="button" class="btn btn-secondary btn-lg" id="buttonlogin">Login</button>';
    Buttons += '<button id="buttoncancel" type="button" class="btn btn-secondary btn-lg ml-2">Cancel</button>';
    Buttons += '<span class="psw">Forgot <a href="#">password?</a></span></div>';

    document.getElementById("loginimput").innerHTML += Buttons; 

}

function ajaxGET( myUrl ) {
  
    return new Promise( (resolve, reject) => {
 
            if (window.XMLHttpRequest) {
               xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
 
           xmlhttp.onreadystatechange = function() {
 
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               
                  if (this.responseText === "") {
                   
 
                       reject("No operation at this moment");
 
                    } else {
                        
                        let myObj = JSON.parse(this.responseText);
                       
                        resolve( myObj);
                   }
               } 
           }
 
           xmlhttp.open("GET", myUrl,true);
 
           xmlhttp.send();  
 
        });
    
 }
 function validUser ( value ){

    if ( value.result == -1 ) {
      document.getElementById("inputerror").innerHTML = "Wrong user email.";
      return
    }
    if ( value.result == -2 ) {
      document.getElementById("passworderror").innerHTML = "Wrong user password.";
    }

    if ( value.result == 1 ) {
      document.getElementById("image-exit-nav").src= "img/exit.png";
      Timecard( value );
    }

 }
function checkUser(){
    let User = document.getElementById("user-name").value;
    let Password = document.getElementById("user-password").value;
    myURL = "model/userlogin.php?username="+ User + "&userpassword="+ Password;
    

    ajaxGET( myURL )
         .then( validUser )
         .catch( err => alert( err ) );



}
function tovalidEmail() {

 // regexp =  new RegExp('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/');
}

// Must be a valid email address
function isValidEmail(email) {

  return /^[^@]+@[^@.]+\.[a-z]+$/i.test(email);

}
function showOrHideTip(show, element) {
  // show element when show is true, hide when false
  if (show) {
   // element.style.display = "inherit";
    document.getElementById("inputerror").innerHTML = "Wrong email format";
  } else {
   // element.style.display = "none";
    //document.getElementById("buttonlogin").disabled = true;
    
  }
  document.getElementById("buttonlogin").disabled = show;
  
}
function createListener(validator) {
  return e => {
    
    const text = e.target.value;
   
    const valid = validator(text);
     
    const showTip = text !== "" && !valid;
    
    const tooltip = e.target.nextElementSibling;
    showOrHideTip(showTip, tooltip);
  };
}

    createLoginForm();
    const usernameInput = document.getElementById("user-name"); 
    const buttonLogin = document.getElementById("buttonlogin"); 
    const userpassword = document.getElementById("user-password");

    usernameInput.addEventListener("blur", createListener(isValidEmail));
    usernameInput.addEventListener("focus", ()=> {
                  document.getElementById("inputerror").innerHTML = "";
                });

    userpassword.addEventListener("focus", ()=> {
                document.getElementById("passworderror").innerHTML = "";
              });
    buttonLogin.addEventListener("click", ()=> {

              checkUser();

            } );
 

$(document).ready(function(){

        
})
