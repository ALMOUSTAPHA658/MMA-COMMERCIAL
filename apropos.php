<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>apropos</title>
    <link rel="stylesheet" href="site.css">
</head>

<body>
    <script>
    function captureDiv() {
        const element = document.querySelector(".cart-content");
        alert("MERCI POUR VOTRE COMMANDE")
        html2canvas(element, {
            scrollY: -window.scrollY,
            useCORS: true
        }).then(canvas => {
        //    Télécharger automatiquement l’image
            const link = document.createElement("a");
            link.download = "capture-div.png";
            link.href = canvas.toDataURL("image/png");
            link.click();
        });
    }
</script>
<script>
   const imgData = canvas.toDataURL('image/png');
        fetch('upload.php', {
            method: 'POST',
            body: JSON.stringify({ image: imgData }),
            headers: {
                'Content-Type': 'application/json'
            }
            .then(res => res.text())
            .then(data => {
                console.log('Réponse du serveur :', data);
            })
        })
</script>
<?php
// Lire les données JSON
$data = json_decode(file_get_contents("php://input"), true);

// Extraire l'image base64
if (isset($data['image'])) {
    $image = $data['image'];

    // Nettoyer la chaîne base64
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageData = base64_decode($image);

    // Nom du fichier
    $fileName = 'capture_' . time() . '.png';

    // Sauvegarde dans un dossier
    file_put_contents('captures/' . $fileName, $imageData);

    // (Optionnel) Enregistrement du nom de fichier dans une base de données
    // Exemple MySQL avec PDO :
    /*
    $pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'user', 'password');
    $stmt = $pdo->prepare("INSERT INTO captures (filename) VALUES (?)");
    $stmt->execute([$fileName]);
    */

    echo "Image sauvegardée avec succès.";
} else {
    echo "Aucune image reçue.";
}
?>
<?php
// upload.php

// Connexion à la BDD
$host = 'localhost';
$dbname = 'mmacommercial';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les données JSON
$data = json_decode(file_get_contents("php://input"));

// Insérer dans la BDD
    $stmt = $pdo->prepare("INSERT INTO captures (image_data) VALUES (:img)");
    $stmt->bindParam(':img', $image, PDO::PARAM_LOB);
?>

if (!empty($data->image)) {
    $base64 = $data->image;

    // Nettoyage
    $base64 = str_replace('data:image/png;base64,', '', $base64);
    $base64 = str_replace(' ', '+', $base64);
    $image = base64_decode($base64);

    if ($image === false) {
        die("Erreur lors du décodage de l'image.");
    }

    

    $stmt = $pdo->prepare("INSERT INTO captures (filename) VALUES (?)");
    $stmt->execute([$fileName]);

    if ($stmt->execute()) {
        echo "Image enregistrée avec succès.";
    } else {
        echo "Erreur SQL.";
    }
} else {
    echo "Aucune image reçue.";
}
?>

if (isset($data['image'])) {
    $image = $data['image'];

    // Nettoyer la chaîne base64
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageData = base64_decode($image);

    // Nom du fichier
    $fileName = 'capture_' . time() . '.png';

    // Sauvegarde dans un dossier
    file_put_contents('captures/' . $fileName, $imageData);

    // (Optionnel) Enregistrement du nom de fichier dans une base de données
    // Exemple MySQL avec PDO :
    
    $pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'user', 'password');
    $stmt = $pdo->prepare("INSERT INTO captures (filename) VALUES (?)");
    $stmt->execute([$fileName]);
    

    echo "Image sauvegardée avec succès.";
} else {
    echo "Aucune image reçue.";
}
?>

$stmt = $pdo->prepare("INSERT INTO captures (image) VALUES (:image)");
$stmt->bindParam(':image', $decodedData, PDO::PARAM_LOB);


</body>
</html>
<script>
function envoyerDiv() {
  const contenu = document.getElementById('maDivScrollable').innerHTML;

  fetch('http://localhost:5000/envoyer-email', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ html: contenu })
  })
  .then(res => res.text())
  .then(data => alert(data))
  .catch(err => console.error(err));
}
</script>

from flask import Flask, request
import smtplib
from email.mime.text import MIMEText

app = Flask(__name__)

@app.route('/envoyer-email', methods=['POST'])
def envoyer_email():
    data = request.get_json()
    html_content = data.get('html', '')

    msg = MIMEText(html_content, 'html')
    msg['Subject'] = 'Contenu du div scrollable'
    msg['From'] = 'ton.email@example.com'
    msg['To'] = 'destinataire@example.com'
    try:
        with smtplib.SMTP('smtp.gmail.com', 587) as server:
            server.starttls()
            server.login('ton.email@example.com', 'TON_MOT_DE_PASSE')
            server.send_message(msg)
        return 'Email envoyé avec succès !'
    except Exception as e:
        print(e)
        return 'Erreur lors de l’envoi', 500
if __name__ == '__main__':
    app.run(debug=True)