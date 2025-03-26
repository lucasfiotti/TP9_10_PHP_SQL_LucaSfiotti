<?php
require('../Model/pdo.php');
$nouvelle_matiere = $dbPDO->prepare("INSERT INTO matiere (id, lib) VALUES (NULL, :libelle)");
$nouvelle_matiere->execute([
    'libelle' => $_POST['lib']
]) or die(print_r($nouvelle_matiere->errorInfo()));
echo "<br>La matiere $_POST[lib] a bien été ajoutée.<br>";
?>
<a href="../index.php">
    <button type="button">Retour à l'accueil</button>
</a>