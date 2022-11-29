const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");
      forms = document.querySelector(".forms");
      createPassword = document.getElementById('createPassword');
      confirmPassword = document.getElementById('confirmPassword');
      erreur = document.getElementById('erreur');
      erreurConnection = document.getElementById('erreurConnection');
var str;
var str2;
var b = false;

    //partie pour cacher/montrer le/les mot(s) de passe
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })

    //partie pour afficher la partie inscription ou connection
    signUp.addEventListener("click", ( )=>{
        partie1.style.display = "none";
        container.classList.add("active");
    });
    login.addEventListener("click", ( )=>{
        partie1.style.display = "initial"
        container.classList.remove("active");
    });

    createPassword.addEventListener('input', updateValue);

    function updateValue(e) {
        str = e.target.value;
    }

    confirmPassword.addEventListener('input', updateValue);

    function updateValue(e) {
        str2 = e.target.value;
    }

    function signup() {
        if (str != str2) {
            erreur.textContent = "Mots de passe ne correspondent pas"
        }
        else {
            //fait des trucs
        }
    }

    function connection() {
        if (b === false) {
            erreurConnection.textContent = "Mot de passe et identifiant pas correspondant"
        }
        else {
            //fait des trucs
        }
    }


