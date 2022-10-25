const NbLvl = 20;
var btn = [];
var btnid;
var btnCampagne;
var btnMulti;
var btnRetour = document.createElement("button")

function menuLvl() {
    btnMulti = document.getElementById("boutonMulti");
    btnCampagne  = document.getElementById("boutonJouer")
    removeAllChildNodes(document.getElementById('menu'));
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
    btnRetour.textContent = "retour";
    btnRetour.onclick = function () {
        removeAllChildNodes(document.getElementById('menulvl'));
        document.getElementById("menu").appendChild(btnCampagne);
        document.getElementById("menu").appendChild(btnMulti);
    }

    document.getElementById("menulvl").appendChild(btnRetour);
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