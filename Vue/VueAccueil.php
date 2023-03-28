<?php

include_once "Vue.php";

class VueAccueil extends Vue{
    public function __construct($layout){
        parent::__construct($layout);

        $this->title = 'NetworkPark | Accueil';
        $this->content = '<div id="etoile"></div>
        <div id="etoile2"></div>
        <div id="etoile3"></div>
        <header>
            <div>
                <button class="boutonAdministrateur" onclick="page.administrateurPage()" id="boutonAdministrateur">
                    Administrateur
                </button>
                <div id="pageAdmin">
                    <object id="htmlpageAdmin" type="text/html" data="formAdmin.php" width="436" height="500"></object>
                </div>
            </div>
            <div>
                <button class="boutonConnexion" onclick="page.connexionPage()" id="boutonconnexion" name="boutonConnexion">
                    Se connecter / S\'inscrire
                </button>
                <div id="pageConnexion" >
                    <form method="post" id="formConnexion"></form>
                    <object id="htmlpage" type="text/html" data="Vue/VueConnexion.php" width="436" height="500"></object>
                </div>
            </div>
        </header>
        <h1>
            Network Park
        </h1>
        <div class="section" id="sectionMenu">
            <div id="description">
                <p id="textDescription">
                    Network Park est un serious game pour tout apprendre sur les Réseaux informatique !
                    Apprenez à résoudre des tâches d\'adressage IP, les différents modèles (TCP/UDP, OSI, IP)...
                </p>
            </div>
        
            <div id="menuHistoire">
                <div id="histoire">
                    <h2 id="titreHistoire">
                        Histoire
                    </h2>
                    <div id="histoire-image-text">
                        <img id="imgAlien" src="https://cdn.discordapp.com/attachments/1085925058301677579/1085925109526708235/alien.png" alt="Image de l\'Alien">
                        <p id="textHistoire">
                            Je suis Bloop l\'extraterrestre, spaceTrooper. Un vaisseau a été percuté par un astéroïde et maintenant
                            plusieurs personnes sont bloquées dans plusieurs pièces du vaisseau. Chaque niveau correspond à une pièce
                            du vaisseau. Mon objectif est de résoudre des tâches pour parvenir à libérer ces personnes.
                        </p>
                    </div>
                </div>
            </div>
        
            <div id="menu">
                <button class="boutonJouer" onclick="menu.menuLvl()" id="boutonJouer">
                    Commencer
                </button>
            </div>
            <a id="menulvl">
            </a>
        </div>
        <div class="section" id="sectionScore">
            <div id="scores">
                <h2>
                    Meilleurs joueurs :
                </h2>
                <ul>';

        /*// Affichage des meilleurs scores
for ($i = 0; $i < count($result); $i++) {
    ?>
    <li>
        <?php
            echo $result[$i]['identifiant'] . " : " . $result[$i]['Sommes'] . "<br>";
        ?>
    </li>

    <?php
}*/
    }
}