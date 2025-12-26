<?php
session_start();
require_once "../config/database.php";
$conn = getConnection();
if(isset($_POST["submit"])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $classe = $_POST['classe'];
    $date_naissance = $_POST['date_naissance'];
    if(empty($nom || $nom)){
        $_SESSION['errors'] = ["invalid nom"];
        header('location: ./ajouter_etudiant.php');
        exit();
    }
    if(empty($prenom)){
        $_SESSION['errors'] = ["invalid prenom"];
        header('location: ./ajouter_etudiant.php');
        exit();
    }
    if(empty($email)){
        $_SESSION['errors'] = ["invalid email"];
        header('location: ./ajouter_etudiant.php');
        exit();
    }
        // $sql = "SELECT email FROM etudiants;";
        // $stmt = $conn->prepare($sql);
        // $stmt->execute();
        // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // foreach ($results as $result) {
        //     echo $result["email"] . " " . $email . "<br>";
        //     if($result == $email){
        //         echo "work" . "<br>";
        //         $_SESSION['errors'] = "invalid email";
        //         header('location: ./ajouter_etudiant.php');
        //         exit();
        //     }
        // }
    
    if(empty($telephone)){
        $_SESSION['errors'] = ["invalid telephone"];
        header('location: ./ajouter_etudiant.php');
        exit();
    }
    if(empty($date_naissance)){
        $_SESSION['errors'] = ["invalid date"];
        header('location: ./ajouter_etudiant.php');
        exit();
    }

    $sql = "INSERT INTO etudiants (nom , prenom , email , classe , date_naissance)
            VALUES (:nom , :prenom , :email , :classe , :date_naissance);";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":nom" => $nom,
        ":prenom"=> $prenom,
        ":email"=> $email,
        ":classe"=> $classe,
        ":date_naissance"=> $date_naissance
    ]);
    header('location: ./ajouter_etudiant.php');
    exit();


}