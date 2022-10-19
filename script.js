const NbLvl = 20;
var btn = [];
var btnid;

function menuLvl() {
    removeAllChildNodes(document.getElementById('menu'))
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