class Menu {
    NbLvl = 4;
    btn = [];
    btnid;
    btnRetour = document.createElement("button");
    aide = document.createElement("p");

    
    menuLvl() {
        let btnCampagne = document.getElementById("boutonJouer");
        let textDescription = document.getElementById('textDescription');
        let score = document.getElementById('scores');
        let histoire = document.getElementById('histoire');
        //on récupère tout les éléments présent au début
    
        this.removeAllChildNodes(document.getElementById('menu'));
        this.removeAllChildNodes(document.getElementById('description'));
        this.removeAllChildNodes(document.getElementById('menuHistoire'));
        this.removeAllChildNodes(document.getElementById('sectionScore'));
        //on supprime tout les éléments présent au début
    
        this.aide.textContent = "Vous êtes sur le point d'entrer dans le vaisseau. Utilisez les touches directionnelles de votre clavier pour accéder au différentes machines du vaisseau. Positionnez vous sur une machine et appuyez sur la barre d'espace pour répondre aux questions. Si vous avez la bonne réponse, vous pourrez continuer votre aventure ! Taper aide si vous en avez besoin, le chatbot vous donnera un indice.";
        document.getElementById("menulvl").appendChild(this.aide);
    
    
        for (let i = 0; i < this.NbLvl; i++) {
            this.btn[i] = document.createElement("button");
            let j = i+1;
            this.btn[i].id = j;
            this.btn[i].textContent = j.toString();
            this.btn[i].onclick = function () {
                menu.warpLvl(this.id)
            }
            document.getElementById("menulvl").appendChild(this.btn[i]);
        }
        //ajoute un nombre de boutons correspondant a NbLvl qui mènent au niveau correspondant
    
        this.btnRetour.textContent = "retour";
        this.btnRetour.style.backgroundColor = '#345153';
        this.btnRetour.style.borderColor ='#345153';
        this.btnRetour.onclick = function () {
            let menu2 = new Menu();
            menu2.removeAllChildNodes(document.getElementById('menulvl'));
            document.getElementById("menu").appendChild(btnCampagne);
            document.getElementById("sectionScore").appendChild(score);
            document.getElementById("description").appendChild(textDescription);
            document.getElementById("menuHistoire").appendChild(histoire);
    
        }
        document.getElementById("menulvl").appendChild(this.btnRetour);
        //créer et ajoute le bouton retour à la suite
    }

    warpLvl(id) {
        let niveau = "Levels/level-" + id + "/"
        window.location.href = niveau;
    }//fonction pour acceder au niveau selon le bouton
    
    removeAllChildNodes(parent) {
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }
    }//fonction pour supprimer tout les enfants d'un élément
}
class Page {
    veutDeconnecte = false;
    bool = false;


    connexionPage() {
        if (document.getElementById('boutonconnexion').textContent == 'Se déconnecter') {  //si le client est connecté normalement
            this.veutDeconnecte = true;
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
                console.log(document.getElementById('htmlpage').style)
            }
            else {
                window.document.getElementById('htmlpage').style.display = "none";
                if (this.veutDeconnecte) { //si le client veut se déconnecter
                    document.getElementById('formConnexion').removeChild(document.getElementById('btnDeconnexion'));
                    document.getElementById('formConnexion').removeChild(document.getElementById('pDeconnexion'));
                    document.getElementById('boutonconnexion').textContent = "Se déconnecter";
                    this.veutDeconnecte = false;
                }
                else {
                    document.getElementById('boutonconnexion').textContent = "Se connecter / S'inscrire";
                }
            }
        }//fonction pour afficher/cacher la page de connexion
     }



    administrateurPage() {

        if (this.bool === false) {
            document.getElementById('pageAdmin').style.display = "block";
            document.getElementById('boutonAdministrateur').textContent = "quitter";
            this.bool = true;
            document.getElementById('htmlpage').style.display = "none"
            document.getElementById('boutonconnexion').textContent = "Se connecter / S'inscrire";
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
            this.bool = false;
        }
    }//fonction pour afficher/cacher la page de connexion administrateur
}

const menu = new Menu();
const page = new Page();