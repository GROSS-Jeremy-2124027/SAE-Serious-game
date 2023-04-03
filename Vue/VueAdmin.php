<?php

namespace Vue;

class VueAdmin extends Vue
{
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        $this->content .= '<div id="etoile"></div>
                            <div id="etoile2"></div>
                            <div id="etoile3"></div>
                            <div>
                                <a href="../index.php">
                                   <button class="boutonRetour">
                                        Retour 
                                    </button>
                                </a>
                            </div>
                            
                            <section>
                            <h1>
                                Administrateur
                            </h1>
                            <h2>
                                Informations
                            </h2>
                            <p>
                                Pour modifier les questions et réponses il suffit de mettre l\'id correspondant à la question dans la première case
                                puis remplir les autres case comme vous le souhaitez.
                            </p>
                            <table>
                            <tr>
                            <th>Identifiant</th>
                            <th>Tuple question</th>
                            <th>Indice</th>
                            <th>Bonne réponse</th>
                            <th>Mauvaise réponse 1</th>
                            <th>Mauvaise réponse 2</th>
                            <th>Mauvaise réponse 3</th>
                            </tr>
                            ';

        $this->content .= $presenter->getAllQuestionsHTML();

        $this->content .= '</table></section>';

        $this->content .= '<section>
        <form method="post">
            <div class="affichage">
                <h3>
                    Identifiant
                </h3>
                <input type="text" name="identifiant" id="">
            </div>
            <div class="affichage">
                <h3>
                    Question 
                </h3>
                <input type="text" name="question" id="">
            </div>
            <div class="affichage">
                <h3>
                    Indice
                </h3>
                <input type="text" name="indice" id="">
            </div>
            <div class="affichage">
                <h3>
                    Bonne réponse
                </h3>
                <input type="text" name="bonneReponse" id="">
            </div>
            <div class="affichage">
                <h3>
                    Mauvaise Réponse 1
                </h3>
                <input type="text" name="mauvaiseReponse" id="">
            </div>
            <div class="affichage">
                <h3>
                    Mauvaise Réponse 2
                </h3>
                <input type="text" name="mauvaiseReponse2" id="">
            </div>
            <div class="affichage">
                <h3>
                    Mauvaise Réponse 3
                </h3>
                <input type="text" name="mauvaiseReponse3" id="">
            </div>
            <div class="affichage">
                <button class="boutonValider" value="valider" name="valider">Valider</button>
            </div>
        </form>
    </section>';
    }
}