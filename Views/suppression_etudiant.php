<?php
require('../Model/pdo.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $verif = $dbPDO->prepare("SELECT * FROM etudiants WHERE id = :id");
    $verif->execute(['id' => $id]);
    $etudiant = $verif->fetch();

    if ($etudiant) {
        $delete = $dbPDO->prepare("DELETE FROM etudiants WHERE id = :id");
        if ($delete->execute(['id' => $id])) {
            echo "<p>Suppression de l'étudiant réussie.</p>";
        } else {
            echo "<p>Erreur lors de la suppression.</p>";
        }
    } else {
        echo "<p>Étudiant introuvable.</p>";
    }
} else {
    echo "<p>ID de l'étudiant non fourni.</p>";
}
?>

<a href="../index.php">
    <button type="button">Retour à l'accueil</button>
</a>
