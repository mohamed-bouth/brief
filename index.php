<?php 
require_once "./config/database.php";
$conn = getConnection();
$sql = "SELECT e.id , e.nom , e.prenom , e.email , e.classe , COUNT(n.matiere) AS nb_notes , AVG(n.note) AS moyenne , MIN(n.note) AS max , MAX(n.note) AS min FROM etudiants e 
        left JOIN notes n 
        ON e.id = n.etudiant_id
        GROUP BY e.nom , e.prenom , e.email , e.classe;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($results);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>TP 1h30 — TODO: Liste des étudiants</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1>TP 1h30 — TODO: Implémenter la liste des étudiants</h1>
    <p class="text-muted">Consigne courte : remplacez ce fichier par votre code PHP en 1h30.</p>

    <h5>Checklist Debriefing</h5>
    <ul>
      <li>TODO: inclure <code>database.php</code> et obtenir une connexion PDO.</li>
      <li>TODO: récupérer et afficher la table des étudiants (ID, nom, email, classe).</li>
      <li>TODO: afficher le nombre de notes et la moyenne par étudiant.</li>
      <li>TODO: afficher un message si <code>?success</code> ou <code>?error</code> est présent.</li>
    </ul>

   
  </div>
</body>
</html> 


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion École - Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>📚 Gestion des Étudiants et Notes</h1>
        
        <div class="mb-3">
            <a href="etudiants/ajouter_etudiant.php" class="btn btn-primary">➕ Nouvel Étudiant</a>
            <a href="notes/ajouter_note.php" class="btn btn-success">📝 Ajouter une Note</a>
        </div>
        
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom Complet</th>
                    <th>Email</th>
                    <th>Classe</th>
                    <th>Nb Notes</th>
                    <th>Moyenne</th>
                    <th>Min/Max</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <?php foreach ($results as $user) { ?>

            <tbody>
                <tr>
                    <td><?= $user["id"] ?></td>
                    <td><?=  $user["nom"] . " " . $user["prenom"]?></td>
                    <td><?=  $user["email"] ?></td>
                    <td><?= $user["classe"] ?></td>
                    <td><?=  $user["nb_notes"] ?></td>
                    <td><?=  $user["moyenne"] ?></td>
                    <td><?= $user["min"] . "/" . $user["max"] ?></td>
                    <td>
                       
                        <a href="etudiants/ajouter_etudiant.php?id=<?= $user["id"] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <form method="POST" action="etudiants/supprimer_etudiant.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $user["id"] ?>">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet étudiant ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>

                <?php
                }
                ?>

                <!-- <tr>
                    <td>2</td>
                    <td>Martin Claire</td>
                    <td>claire.martin@example.com</td>
                    <td>Première S</td>
                    <td>2</td>
                    <td>12.50</td>
                    <td>10 / 15</td>
                    <td>
                        
                        <a href="etudiants/ajouter_etudiant.php?id=2" class="btn btn-sm btn-warning">Modifier</a>
                        <form method="POST" action="etudiants/supprimer_etudiant.php" style="display:inline;">
                            <input type="hidden" name="id" value="2">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet étudiant ?');">Supprimer</button>
                        </form>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
</body>
</html>