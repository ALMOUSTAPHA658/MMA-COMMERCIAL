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
    <section id="inscription" style="margin-top:0px">
        <div class="login-box">
            <form method="post">
                <h4 style="margin-top: 10px;">Connexion</h4>
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
                <input type="submit" class="btn" value="connexion" style="margin-left: 100px;" name="connexion">
            </form>
        </div>
    </section>
    <?PHP 
        if(isset($_POST["connexion"])){
            $emaili = $_POST["emaili"];
            $passw = $_POST["passw"];
            

            if(!empty($emaili)  && !empty($passw)) {
                require_once'connect.php';
                $sqlState = $pdo->prepare('SELECT * FROM utilisataire 
                                                    WHERE login=?
                                                    AND passeword=?');
                $sqlState->execute([$emaili,$passw]);
                var_dump($sqlState->rowCount());
                if($sqlState->rowCount() >= 1) {
                    session_start();
                    $_SESSION['utilisataire'] = $sqlState->fetch();
                    header('location:admin\admin.php');
                }  else {
                    echo 'email ou mot de passe incorrect';
                }
                
                
                
            } else {

            }
        }
    ?>
    
</body>
</html>