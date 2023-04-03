<?php
namespace Vue;


include_once "Vue.php";

/**
 * Classe représentant la vue Accueil
 */
class VueAccueil extends Vue
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->title = 'NetworkPark | Accueil';
        $this->content = '<div id="etoile"></div>
        <div id="etoile2"></div>
        <div id="etoile3"></div>
        <header>
            <div>
                <button class="boutonAdministrateur" id="boutonAdministrateur" onclick="{page.administrateurPage()}">
                    Administrateur
                </button>
                <div id="pageAdmin">
                    <object id="htmlpageAdmin" type="text/html" width="375px" height="400">
                        <form id="form-connexion-admin" method="post">
                            <span id="connexion-inscription">
                                Connexion
                            </span>
                            <div class="champs-saisie">
                                <input type="text" name="loginAdmin" placeholder="Entrez votre nom" required>
                                <i class="uil uil-envelope icon"></i>
                            </div>
                            <div class="champs-saisie">
                                <input type="password" name="passwordAdmin" class="password" placeholder="Entrez votre mot de passe" required>
                                <i class="uil uil-lock icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>
                            <div class="bouton-connexion">
                                <input type="submit" name="loginAdminButton" value="Se connecter">
                            </div>
                        </form>
                    </object>
                </div>
            </div>
            <div id="connexionDiv">
                <button class="boutonConnexion" id="boutonconnexion" name="boutonConnexion" onclick="{page.connexionPage()}">
                    Se connecter / S\'inscrire
                </button>
                <div id="pageConnexion">
                    <form method="post" id="formDeconnexion">
                        <p id="pDeconnexion">Voulez-vous vraiment vous déconnecter ?</p>
                        <button id="btnDeconnexion" name="btnDeconnexion">Oui</button>
                    </form>
                    <object id="htmlpage" type="text/html" width="390" height="500">
                        <form id="form-connexion" method="post">
                            <span id="connexion-inscription">
                                Connexion
                            </span>
                            <div class="champs-saisie">
                                <input type="text" name="login" placeholder="Entrez votre nom" required>
                                <i class="uil uil-envelope icon"></i>
                            </div>
                            <div class="champs-saisie">
                                <input type="password" name="password" class="password" placeholder="Entrez votre mot de passe" required>
                                <i class="uil uil-lock icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>
                            <div class="bouton-connexion">
                                <input type="submit" name="loginButton" value="Se connecter">
                            </div>
                            <span class="text">Pas de compte ?
                                <a href="#" onclick="afficherInscription()" signup-link">Inscrivez-vous</a>
                            </span>
                        </form>
                        <form id="form-inscription" method="post">
                            <span id="connexion-inscription">
                                Inscription
                            </span>
                            <div class="champs-saisie">
                                <input type="text" name="login" placeholder="Entrez votre nom" required>
                                <i class="uil uil-envelope icon"></i>
                            </div>
                            <div class="champs-saisie">
                                <input type="password" name="password" class="password" placeholder="Entrez votre mot de passe" required>
                                <i class="uil uil-lock icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>
                            <div class="bouton-inscription">
                                <input type="submit" name="signupButton" value="S\'inscrire">
                            </div>
                            <span class="text">Vous avez déja un compte ?
                                <a href="#" onclick="afficherConnexion()" signup-link">Connectez-vous</a>
                            </span>
                        </form>
                    </object>
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
                <ul>
                ' . $presenter->getMeilleursScoresHTML() . '
                </ul>
            </div>
        </div>';
    }
}