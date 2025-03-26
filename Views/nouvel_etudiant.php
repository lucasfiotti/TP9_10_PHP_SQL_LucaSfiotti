<?php
require('../Model/pdo.php');
$nouvel_etudiant = $dbPDO->prepare("INSERT INTO etudiants (id, prenom, nom, classe_id) VALUES (NULL, :prenom, :nom, :classeID)");
$nouvel_etudiant->execute([
    'prenom' => $_POST['prenom'],
    'nom' => $_POST['nom'],
    'classeID' => $_POST['classe']
]) or die(print_r($nouvel_etudiant->errorInfo()));
echo "<br>L'étudiant $_POST[prenom] $_POST[nom] de la classe $_POST[classe] a bien été ajouté.<br>";
?>
<a href="../index.php">
    <button type="button">Retour à l'accueil</button>
</a>