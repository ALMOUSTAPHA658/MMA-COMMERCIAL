

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="site.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
    <section id="CONTACT">
        <div class="conteiner">
            <div class="form">
                <div class="contact-info">
                    <h3 class="title1">Prenons contact</h3>
                    <p class="text1">Nous sommes à votre disposition</p>
                    <div class="info">
                        <div class="information">
                            <i class="ri-mail-line icon"></i>
                            <p>almoustaphamoussamoustapha@gmail.com</p>
                        </div>
                        <div class="information2">
                            <a style="color: gold;" href="https://wa.me/0022798896369"><i class="ri-whatsapp-line icon"></i></a>
                            <p>+227 98 89 63 69</p>
                        </div>
                        <div class="information3">
                            <i class="ri-phone-line icon"></i>
                            <p>+227 98 89 63 69</p>
                        </div>
                        <div class="information3">
                            <i class="ri-map-pin-line"></i>
                            <p>Quartier Nouveau Marché de Niamey pres de la banque Atlantique</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <span class="circle one"></span>
                    <span class="circle two"></span>
                    <span class="circle tree"></span>
                    <span class="circle forth"></span>
                    <form method="post">
                        <h3 class="title">CONTACTEZ-NOUS</h3>
                        <div class="input-conteiner ">
                            <input type="text" name="nom" class="input1" required>
                            <label for="">Nom d'utilisateur</label>
                            <span>Nom d'utilisateur</span>
                        </div>
                        <div class="input-conteiner">
                            <input type="email" name="email" class="input1">
                            <label for="">Email</label>
                            <span>Email</span>
                        </div>
                        <div class="input-conteiner textarea ">
                            <input type="tel" name="phone" class="input1"  required>
                            <label for="">téléphone</label>
                            <span>Téléphone</span>
                        </div>
                        <div class="input-conteiner ">
                            <textarea type="text" name="message" class="input1"  required></textarea>
                            <label class="lab" for="">Message</label>
                            <span>Message</span>
                        </div>
                        <input type="submit" value="Envoyez" class="btn" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?PHP 
        if(isset($_POST["submit"])){
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $tel = $_POST["phone"];
            $mes = $_POST["message"];

            if(!empty($nom)  && !empty($tel) && !empty($mes)) {
                require_once'connect.php';
                $date = date('Y-m-d');
                var_dump($date);
                $sqlState = $pdo->prepare('INSERT INTO contact VALUES(null,?,?,?,?,?)');
                $sqlState->execute([$nom,$email,$tel,$mes, $date]);
                echo'MERCI DE NOUS CONTACTEZ';
            }
        }
    ?>
    <script src="hh.js"></script>
</body>