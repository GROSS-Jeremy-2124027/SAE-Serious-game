const NbLvl = 4;
var btn = [];
var btnid;
var btnCampagne;
var btnMulti;
var btnRetour = document.createElement("button")
var btnconnexion


function menuLvl() {
    btnMulti = document.getElementById("boutonMulti");
    btnCampagne  = document.getElementById("boutonJouer");
    score = document.getElementById('scores');
    textDescription = document.getElementById('textDescription');
    score = document.getElementById("scores");
    textDescription = document.getElementById("textDescription");
    removeAllChildNodes(document.getElementById('menu'));
    removeAllChildNodes(document.getElementById('description'));
    removeAllChildNodes(document.getElementById('sectionScore'));

    for (let i = 0; i < NbLvl; i++) {
        btn[i] = document.createElement("button");
        let j = i+1;
        btn[i].id = j;
        btn[i].textContent = j.toString();
        btn[i].onclick = function () {
            btnid = this.id
            warpLvl()
        }
        document.getElementById("menu").appendChild(btn[i]);
    }
    btnRetour.textContent = "retour";
    btnRetour.onclick = function () {
        removeAllChildNodes(document.getElementById('menu'));
        document.getElementById("menu").appendChild(btnCampagne);
        document.getElementById("sectionScore").appendChild(score);
        document.getElementById("description").appendChild(textDescription);

    }
    document.getElementById("menu").appendChild(btnRetour);
}

function warpLvl() {
    let niveau = "level-" + btnid + "/lvl" + btnid + ".html"
    window.location.href = niveau;
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function connexionPage() {
    document.getElementById('connexion').innerHTML='<object type="text/html" data="connexion.html" width="436" height="700"></object>';
}

function boutonCroix() {
    btnconnexion = document.getElementById('btnconnexion')
    removeAllChildNodes(document.getElementById('connexion'));
}