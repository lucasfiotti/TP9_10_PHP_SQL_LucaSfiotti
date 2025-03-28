<?php
require('../Model/pdo.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de l'étudiant introuvable.");
}

$id = $_GET['id'];

$req = $dbPDO->prepare("SELECT * FROM etudiants WHERE id = :id");
$req->execute(['id' => $id]);
$etudiant = $req->fetch();

if (!$etudiant) {
    die("Étudiant introuvable.");
}

$classes = $dbPDO->prepare("SELECT * FROM classes");
$classes->execute();
?>

<h1>Modifier l'étudiant</h1>
<form action="modif_etudiant.php?id=<?php echo $id; ?>" method="post">
    <label>Prénom :</label>
    <input type="text" name="prenom" value="<?php echo htmlspecialchars($etudiant['prenom']); ?>" required />
    <br><br>
    
    <label>Nom :</label>
    <input type="text" name="nom" value="<?php echo htmlspecialchars($etudiant['nom']); ?>" required />
    <br><br>

    <label>Classe :</label>
    <select name="classe" required>
        <?php
        foreach ($classes as $classe) {
            $selected = ($classe['id'] == $etudiant['classe_id']) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($classe['id']) . '" ' . $selected . '>' . htmlspecialchars($classe['libelle']) . '</option>';
        }
        ?>
    </select>
    <br><br>

    <button type="submit">Enregistrer les modifications</button>
</form>

<a href="../index.php">
    <button type="button">Retour à l'accueil</button>
</a>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update = $dbPDO->prepare("UPDATE etudiants SET prenom = :prenom, nom = :nom, classe_id = :classe WHERE id = :id");
    $update->execute([
        'prenom' => $_POST['prenom'],
        'nom' => $_POST['nom'],
        'classe' => $_POST['classe'],
        'id' => $id
    ]) or die(print_r($update->errorInfo()));

    echo "<br>Modification réussie !";
}
?>
