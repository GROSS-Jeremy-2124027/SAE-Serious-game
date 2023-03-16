var NbLvl = 4;
var btn = [];
var btnid;
var btnCampagne;
var btnRetour = document.createElement("button")
var aide = document.createElement("p")



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

    aide.textContent = "Vous êtes sur le point d'entrer dans le vaisseau. Utilisez les touches directionnelles de votre clavier pour accéder au différentes machines du vaisseau. Positionnez vous sur une machine et appuyez sur la barre d'espace pour répondre aux questions. Si vous avez la bonne réponse, vous pourrez continuer votre aventure ! Taper aide si vous en avez besoin, le chatbot vous donnera un indice.";
    document.getElementById("menulvl").appendChild(aide);


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
    let niveau = "Levels/level-" + btnid + "/"
    window.location.href = niveau;
}//fonction pour acceder au niveau selon le bouton

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}//fonction pour supprimer tout les enfants d'un élément

var veutDeconnecte = false;

function connexionPage() {
    if (document.getElementById('boutonconnexion').textContent == 'Se déconnecter') {  //si le client est connecté normalement
        veutDeconnecte = true;
        var paragraph = document.createElement('p');
        paragraph.textContent = "Voulez-vous vraiment vous déconnecter ?"
        paragraph.id = "pDeconnexion"
        var bouton = document.createElement('button')
        bouton.id = 'btnDeconnexion'
        bouton.textContent = "Oui"
        bouton.name = 'btnDeconnexion'
        bouton.onclick = function () {
            document.getElementById('pageConnexion').removeChild(paragraph);
            document.getElementById('pageConnexion').removeChild(bouton);
            document.getElementById('boutonconnexion').textContent = "Se connecter / S'inscrire";
            window.location.href = window.location.href
        }
        document.getElementById('formConnexion').appendChild(paragraph)
        document.getElementById('formConnexion').appendChild(bouton)
        document.getElementById('boutonconnexion').textContent = "quitter";
    }
    else { //si le client est pas connecté
        if (document.getElementById('boutonconnexion').textContent == 'Se connecter / S\'inscrire') {  // si le texte précédant n'était pas "quitter"
            document.getElementById('htmlpage').style.display = "block";
            document.getElementById('boutonconnexion').textContent = "quitter";
            document.getElementById('pageAdmin').style.display = "none";
            document.getElementById('boutonAdministrateur').textContent = "Administrateur";
            bool = false;
        }
        else {
            window.document.getElementById('htmlpage').style.display = "none";
            if (veutDeconnecte) { //si le client veut se déconnecter
                document.getElementById('formConnexion').removeChild(document.getElementById('btnDeconnexion'));
                document.getElementById('formConnexion').removeChild(document.getElementById('pDeconnexion'));
                document.getElementById('boutonconnexion').textContent = "Se déconnecter";
                veutDeconnecte = false;
            }
            else {
                document.getElementById('boutonconnexion').textContent = "Se connecter / S'inscrire";
            }
        }
    }

}//fonction pour afficher/cacher la page de connexion

var bool = false;

function administrateurPage() {

    if (bool === false) {
        document.getElementById('pageAdmin').style.display = "block";
        document.getElementById('boutonAdministrateur').textContent = "quitter";
        bool = true;
        document.getElementById('htmlpage').style.display = "none"
        if (estConnecte) {
            document.getElementById('boutonconnexion').textContent = "Se déconnecter";
        }
        else {
            document.getElementById('boutonconnexion').textContent = "Se connecter / S'inscrire";
        }
    }
    else {
        document.getElementById('pageAdmin').style.display = "none";
        document.getElementById('boutonAdministrateur').textContent = "Administrateur";
        bool = false;
    }
}//fonction pour afficher/cacher la page de connexion administrateur


