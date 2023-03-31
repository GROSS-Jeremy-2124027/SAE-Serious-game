<?php
namespace Modele;


class AccesUtilisateur {

    protected $accesDonnees = null;

    public function __construct($accesDonnees){
        $this->accesDonnees = $accesDonnees;
    }

    public function connexion($login, $password) {
        // Si clic sur le bouton se connecter
        if (isset($_POST["login"])) {

            $mot_de_passe_hash = "SELECT mot_de_passe FROM `utilisateur` WHERE identifiant = '" . $login . "'";
            $string = $this->accesDonnees->run($mot_de_passe_hash);
            $sql = " SELECT * FROM `utilisateur` WHERE identifiant = '" . $login . "'";

            $user = $this->accesDonnees->run($sql);


            $_SESSION['connecter'] = false;
            // Si l'utilisateur existe
            if (count($user) > 0) {
                if (password_verify($password, $string[0]["mot_de_passe"])) {
                    // On récupère l'identifiant et le mot de passe de l'utilisateur
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
                    // Envoi de la requête
                    echo "<script> alert('Vous êtes connecté" . " " . $_SESSION["login"] . "'); </script>";
                    echo "<script>window.parent.document.getElementById('htmlpage').style.display = 'none';</script>";
                    echo "<script type='text/javascript'>window.parent.document.getElementById('boutonconnexion').textContent = 'Se déconnecter';</script>";
                    $_SESSION['connecter'] = true;
                }
            } else {
                echo "<script> alert('Identifiant invalide'); </script>";
            }

        }
    }

    public function inscription() {
        // Si clic sur le bouton s'inscrire
        if (isset($_POST["signup"])) {

            // On récupère l'identifiant et le mot de passe de l'utilisateur
            $username = $_POST["username"];
            $password = $_POST["password"];
            $passwordConfirm = $_POST["confirmPassword"];

            // Vérification des critères du mot de passe
            $has_uppercase = false;
            $has_digit = false;
            $has_special_char = false;

            // On parcourt chaque caractère du mot de passe
            for ($i = 0; $i < strlen($password); $i++) {
                $char = $password[$i];

                if (ctype_upper($char)) {
                    $has_uppercase = true;
                }

                if (ctype_digit($char)) {
                    $has_digit = true;
                }

                if (!ctype_alnum($char)) {
                    $has_special_char = true;
                }
            }

            // Affichage des erreurs si il manque un critère
            if (strlen($password) < 8) {
                echo "<script> alert('Le mot de passe doit comporter au moins 8 caractères'); </script>";
            }

            if (strlen($username) > 10) {
                echo "<script> alert('Le pseudo est trop long'); </script>";
            }

            if (!$has_uppercase) {
                echo "<script> alert('Le mot de passe doit comporter au moins une majuscule'); </script>";
            }

            if (!$has_digit) {
                echo "<script> alert('Le mot de passe doit comporter au moins un chiffre'); </script>";
            }

            if (!$has_special_char) {
                echo "<script> alert('Le mot de passe doit comporter au moins un caractère spécial'); </script>";
            }

            if ($password !== $passwordConfirm) {
                echo "<script> alert('Les mots de passe ne correspondent pas'); </script>";
            }

            // Si tout les critères sont remplis
            if (strlen($password) >= 8 && strlen($username) <= 10 && $has_uppercase && $has_digit && $has_special_char && ($password === $passwordConfirm)) {

                $hash = password_hash($password, PASSWORD_BCRYPT);
                // Envoi de la requête

                $verification = "SELECT identifiant FROM `utilisateur` WHERE identifiant = '" . $_POST["username"] . "' ";
                $user = $this->accesDonnees->run($verification);

                if (count($user) < 1) {
                    $sql = "INSERT INTO `utilisateur`(`identifiant`, `mot_de_passe`) 
                VALUES ('$username', '$hash')";
                    $insert = $this->accesDonnees->runInsert($sql);
                    if ($insert) {
                        echo "<script> alert('Nouveau compte créé ! Veuillez vous connecter à l\'aide de vos identifiants'); </script>";
                        echo "<script>window.parent.document.getElementById('htmlpage').style.display = 'none';</script>";
                    }
                } else {
                    echo "<script> alert('Pseudo déjà existant'); </script>";
                }


            }
        }
    }

    public function connexionAdmin() {
        // Si clic sur le bouton se connecter
        if (isset($_POST["loginAdmin"])) {
            session_start();
            // On récupère l'identifiant et le mot de passe de l'utilisateur
            $_SESSION['username'] = $_POST["username"];
            $_SESSION['password'] = $_POST["password"];

            $mot_de_passe_hash = "SELECT mot_de_passe FROM `admin` WHERE identifiant = '".$_SESSION["username"]."'";
            $string = $this->accesDonnees->run($mot_de_passe_hash);
            $sql = " SELECT * FROM `admin` WHERE identifiant = '".$_SESSION["username"]."'";

            $user = $this->accesDonnees->run($sql);

            // Si l'utilisateur existe
            if (count($user) > 0) {
                if (password_verify($_SESSION['password'], $string[0]["mot_de_passe"])) {
                    // Envoi de la requête
                    echo "<script> alert('Vous êtes connecté" . " " . $_SESSION["username"] . "'); </script>";
                    echo "<script>window.parent.document.getElementById('htmlpage').style.display = 'none';</script>";
                    echo "<script type='text/javascript'>window.parent.document.getElementById('boutonAdministrateur').textContent = 'Se déconnecter';</script>";
                    set_url();
                }
            }
            else {
                echo "<script> alert('Identifiant invalide'); </script>";
                session_abort();
            }
        }
    }
}