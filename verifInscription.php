<?php 

//On récupère les données de connexion à la base de données
require_once('config.php');

//On se connecte à la base de données bdd.sql
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

//On vérifie si la connexion a réussi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//On vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //On récupère les valeurs du formulaire
    $email = $_POST["email"];
    $mot_de_passe = $_POST["password"];

    //On vérifie si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE email = '$email' AND password = '$mot_de_passe'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        //On démarre une session pour stocker les informations de l'utilisateur
        session_start();
        $_SESSION["email"] = $email;

        //On redirige vers la page d'accueil
        header("Location: accueil.php");
        exit();

    } else {

        //On affiche un message d'erreur
        $error_message = "Adresse e-mail ou mot de passe incorrect";
    }
}

// Hachage du mot de passe 'mot_de_passe' (à faire avant l'insertion dans la base de données) 
$mot_de_passe_hache = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

// Insertion dans la table 'utilisateurs'
$req = $bdd->prepare('INSERT INTO utilisateurs(id_user, nom, email, mot_de_passe) VALUES(:id_user, :nom, :email, :mot_de_passe)');

$req->execute(array(
    'id_user' => $id_user,
    'nom' => $nom,
    'email' => $email,
    'mot_de_passe' => $mot_de_passe_hache,
    ));

// Vérification du mot de passe
$isPasswordCorrect = password_verify($_POST['mot_de_passe'], $resultat['mot_de_passe']);

if (!$isPasswordCorrect) {
    echo 'Mauvais identifiant ou mot de passe !';
}
else {
    session_start();
    $_SESSION['id_user'] = $resultat['id_user'];
    $_SESSION['nom'] = $resultat['nom'];
    header('Location: accueil.php');
}



        
?>