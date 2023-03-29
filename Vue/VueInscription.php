<?php
namespace Vue;

class VueInscription extends Vue {
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->content = '
        <div class="container">
            <div class="forms">
                <div class="form login" id="partie1">
                    <span class="title">Administrateur</span>
        
                    <form action="loginAdmin.php" method="post">
                        <div class="input-field">
                            <input type="text" name="username" placeholder="Entrez votre nom" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" class="password" placeholder="Entrez votre mot de passe" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                        <p id="erreurConnection"></p>
                        <div class="input-field button">
                            <input type="submit" name="loginAdmin" value="Se connecter">
                        </div>
                    </form>
                </div>
            </div>
        </div>';
    }
}
?>

