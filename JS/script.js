const NbLvl = 4;
var btn = [];
var btnid;
var btnCampagne;
var btnRetour = document.createElement("button")
var btnconnexion


function menuLvl() {
    btnCampagne  = document.getElementById("boutonJouer");
    textDescription = document.getElementById('textDescription');
    score = document.getElementById('scores');
    histoire = document.getElementById('histoire');
    //on récupère tout les éléments présent au début

    removeAllChildNodes(document.getElementById('menu'));
    removeAllChildNodes(document.getElementById('description'));
    removeAllChildNodes(document.getElementById('menuHistoire'));
    removeAllChildNodes(document.getElementById('sectionScore'));
    //on supprime tout les éléments présent au début

    for (let i = 0; i < NbLvl; i++) {
        btn[i] = document.createElement("button");
        let j = i+1;
        btn[i].id = j;
        btn[i].textContent = j.toString();
        btn[i].onclick = function () {
            btnid = this.id
            warpLvl()
        }
        document.getElementById("menulvl").appendChild(btn[i]);
    }
    //ajoute un nombre de boutons correspondant a NbLvl qui mènent au niveau correspondant

    btnRetour.textContent = "retour";
    btnRetour.style.backgroundColor = '#345153';
    btnRetour.style.borderColor ='#345153';
    btnRetour.onclick = function () {
        removeAllChildNodes(document.getElementById('menulvl'));
        document.getElementById("menu").appendChild(btnCampagne);
        document.getElementById("sectionScore").appendChild(score);
        document.getElementById("description").appendChild(textDescription);
        document.getElementById("menuHistoire").appendChild(histoire);

    }
    document.getElementById("menulvl").appendChild(btnRetour);
    //créer et ajoute le bouton retour à la suite
}

function warpLvl() {
    let niveau = "level-" + btnid + "/lvl" + btnid + ".html"
    window.location.href = niveau;
}//fonction pour acceder au niveau selon le bouton

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}//fonction pour supprimer tout les enfants d'un élément

var bool = false;

function connexionPage() {

    if (bool === false) {
        document.getElementById('pageConnexion').style.display = "block";
        document.getElementById('boutonconnexion').textContent = "quitter";
        bool = true;
    }
    else {
        document.getElementById('pageConnexion').style.display = "none";
        document.getElementById('boutonconnexion').textContent = "blabla";  
        //btnconnexion.disabled = "disabled";  
        bool = false;
    }
}//fonction pour afficher/cacher la page de connexion