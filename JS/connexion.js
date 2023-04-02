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
formConnexion = document.getElementById('form-connexion');
formInscription = document.getElementById('form-inscription');

console.log(formConnexion);
var str;
var str2;
var b = false;
var btnconnexion;

/**
 * partie pour cacher/montrer le/les mot(s) de passe
 */
pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        pwFields.forEach(pwField => {
            if (pwField.type === "password") {
                pwField.type = "text";

                pwShowHide.forEach(icon => {
                    icon.classList.replace("uil-eye-slash", "uil-eye");
                })
            } else {
                pwField.type = "password";

                pwShowHide.forEach(icon => {
                    icon.classList.replace("uil-eye", "uil-eye-slash");
                })
            }
        })
    })
})

/**
 * partie pour afficher la partie inscription ou connection
 */

function afficherInscription() {
    formConnexion.style.display = "none";
    formInscription.style.display = "flex";
}
function afficherConnexion() {
    formConnexion.style.display = "flex";
    formInscription.style.display = "none";
}
/*
signUp.addEventListener("click", () => {
    partie1.style.display = "none";
    container.classList.add("active");
});
login.addEventListener("click", () => {
    partie1.style.display = "initial"
    container.classList.remove("active");
});*/