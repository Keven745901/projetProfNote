<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
</head>
<body>
    <form method="GET" action="index.php">
        <?php
        require 'connexion.php';
        ?>
        <input type="text" name="txtlogin" placeholder="Login" required="required">
        <br>
        <input type="password" name="txtmdp" placeholder="Mot de passe" required="required">
        <br><br>
        <input type="submit" name="btnconnexion" value="Connexion">
        <br><br>
        
    </form>
</body>
</html>