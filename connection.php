  $date = date('Y-m-d H:i:s');
                var_dump($date);
                $sqlstate = $pdo->prepare('INSERT INTO contact VALUES(null,?,?,?,?,?)');
                $sqlstate->execute([$nom2,$email2,$mes2,$phone2,$date]);
                
                