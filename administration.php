<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="../site.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body>
    <section id="inscription">
        <div class="login-box">
            <form method="post">
                <h4 style="margin-top: 10px;">BARKA DA ZUWA</h4>
                <span class="circle two"></span>
                <div class="input-box">
                    <span class="icon"><i class="ri-mail-line"></i></span>
                    <input type="email" required name="emaili">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="ri-lock-line"></i></span>
                    <input type="password" required name="passw">
                    <label>Mot de passe</label>
                    
                </div>
                <input type="submit" class="btn" value="Ajouter" style="margin-left: 115px;" name="ajouter">
            </form>
        </div>
    </section>
    <?PHP 
        if(isset($_POST["ajouter"])){
            $email = $_POST["emaili"];
            $pass = $_POST["passw"];
            

            if(!empty($email)  && !empty($pass)) {
                require_once'connect.php';
                $date = date('Y-m-d');
                var_dump($date);
                $sqlState = $pdo->prepare('INSERT INTO utilisataire VALUES(null,?,?,?)');
                $sqlState->execute([$email,$pass,$date]);
                echo'AJOUTER AVEC SUCCES';
            }
        }
    ?>
    
</body>
</html>