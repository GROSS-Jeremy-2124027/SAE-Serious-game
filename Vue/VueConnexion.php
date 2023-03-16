<!DOCTYPE html>
<html lang="fr" id="connexion">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Network Park </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../CSS/styleConnexion.css">
</head>
<body>
<div class="container">
    <div class="forms">
        <div class="form login" id="partie1">
            <span class="title">Connexion</span>

            <form action="login.php" method="post">
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
                    <input type="submit" name="login" value="Se connecter" onclick="connection()">
                </div>
            </form>
            <div class="login-signup">
                    <span class="text">Pas de compte ?
                        <a href="#" class="text signup-link">Inscrivez-vous</a>
                    </span>
            </div>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="form signup" id="partie2">
            <span class="title">Inscription</span>

            <form action="signup.php" method="post">
                <div class="input-field">
                    <input type="text" name="username" placeholder="Entrez votre nom" required>
                    <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" class="password" id="createPassword" placeholder="Entrez votre mot de passe" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                <div class="input-field">
                    <input type="password" name ="confirmPassword" class="password" id="confirmPassword" placeholder="Confirmez votre mot de passe" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                <p id="erreur"></p>
                <div class="input-field button">
                    <input type="submit" name="signup" value="S'inscrire" onclick="signup()">
                </div>
            </form>

            <div class="login-signup">
                    <span class="text"> Vous avez déjà un compte?
                        <a href="#" class="text login-link"> Connectez-vous </a>
                    </span>
            </div>
        </div>
    </div>
</div>

<script src="../JS/connexion.js"></script>
<script src="../JS/mainScript.js"></script>
</body>
</html>