<?php

    require_once("composants/header.php");

    if (!empty($_POST)) {

        if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                echo "<h2 class='error'>Ce n'est pas une adresse e-mail valide</h2>";
            } else {
                require_once("composants/database.php");

                $sql = "SELECT * FROM users WHERE email = :email";
                $query = $db->prepare($sql);
                $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                $query->execute();
                
                $user = $query->fetch();

                if (!$user) {
                    echo "<h2 class='error'>Erreur lors de la tentative de connexion</h2>";
                } else {
                    $password_hashed = hash('sha256', $_POST["password"]);

                    if ($password_hashed !== $user["password"]) {
                        echo "<h2 class='error'>L'adresse e-mail et/ou le mot de passe sont incorrects</h2>";
                    } else {
                        session_start();

                        $_SESSION = [
                            "id" => $user["id"],
                            "lastname" => $user["lastname"],
                            "firstname" => $user["firstname"],
                            "email" => $user["email"],
                            "birthday" => $user["birthday"],
                            "country" => $user["country"],
                            "city" => $user["city"]
                        ];

                        header("Location: fil-actualite.php");
                        exit();
                    }
                }
            }
        }
    }
?>

<div class="container-index">
    <div class="index">
        <h1 class="title">Social Connect</h1>
        <p class="text">Avec Social Connect, partagez et restez en contact avec votre entourage.</p>
    </div>
    <form method="POST" class="form-account">
        <div class="bloc-form">
            <input type="email" name="email" placeholder="Adresse e-mail" required>
        </div>
        <div class="bloc-form">
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>
        <div class="bloc-form">
            <button type="submit" class="btn-login">Connexion</button>
        </div>
        <hr class="separator">
        <div class="bloc-form">
            <button class="btn-create" onClick="window.location.href = 'inscription.php'">Créer un compte</button>
        </div>
    </form>
</div>
