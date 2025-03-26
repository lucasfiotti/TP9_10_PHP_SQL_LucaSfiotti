<?php
require('Model/pdo.php');
?>
<h1>Ajout de Matière</h1>
<form action="Views/nouvelle_matiere.php" method="post">
    <label>Libellé :</label>
    <input type="text" name="lib" required />
    <button type="submit">Valider</button>
</form>
<h1>Ajout d'étudiants</h1>
<form action="Views/nouvel_etudiant.php" method="post">
    <label>Prénom :</label>
    <input type="text" name="prenom" required />
    <br>
    <br>
    <label>Nom :</label>
    <input type="text" name="nom" required />
    <br>
    <br>
    <label for="choix-classe">Choisissez la classe de l'étudiant:</label>
    <select name="classe" required>
        <option value="">--Choisissez une classe--</option>
        <?php
        $classes = $dbPDO->prepare("SELECT * FROM classes");
        $classes->execute();
        foreach ($classes as $classe) { ?>
            <option value="<?php echo htmlspecialchars($classe['id']); ?>">
                <?php echo htmlspecialchars($classe['id']) ."-". htmlspecialchars($classe['libelle']); ?>
            </option>
        <?php } ?>
    </select>
    <br>
    <button type="submit">Valider</button>
</form>
<h1>Liste des Étudiants</h1>
<ul>
    <?php
    $etudiants = $dbPDO->prepare("SELECT * FROM etudiants");
    $etudiants->execute();
    foreach ($etudiants as $etudiant) { ?>
        <li><?php echo htmlspecialchars($etudiant['prenom']) . " " . htmlspecialchars($etudiant['nom']); ?></li>
    <?php } ?>
</ul>
<br>
<h1>Liste des Classes</h1>
<ul>
    <?php
    $classes = $dbPDO->prepare("SELECT * FROM classes");
    $classes->execute();
    foreach ($classes as $classe) { ?>
        <li><?php echo htmlspecialchars($classe['libelle']); ?></li>
    <?php } ?>
</ul>
<br>
<h1>Liste des Professeurs</h1>
<ul>
    <?php
    $profs = $dbPDO->prepare("SELECT * FROM professeurs INNER JOIN classes ON professeurs.id_classe = classes.id INNER JOIN matiere ON professeurs.id_matiere = matiere.id");
    $profs->execute();
    foreach ($profs as $professeurs) { ?>
        <li><?php echo htmlspecialchars($professeurs['prenom']) . " " . htmlspecialchars($professeurs['nom']) . ", prof de " . htmlspecialchars($professeurs['lib']) . " travaillant pour la classe : " . htmlspecialchars($professeurs['libelle']); ?></li>
    <?php } ?>
</ul>
<br>
<!--j'ai fait une liste des matières aussi parce que je trouvais ça plus clair-->
<h1>Liste des Matières</h1>
<ul>
    <?php
    $matieres = $dbPDO->prepare("SELECT * FROM matiere");
    $matieres->execute();
    foreach ($matieres as $matiere) { ?>
        <li><?php echo htmlspecialchars($matiere['lib']); ?></li>
    <?php } ?>
    <?php
    $ajout_matiere = $dbPDO->prepare("INSERT INTO matiere (id, lib) VALUES (:id, :libelle)");
    $ajout_matiere->execute([
        'id' => "5",
        'libelle' => "Programmation"
    ]) or die(print_r($ajout_matiere->errorInfo()));
    ?>
</ul>