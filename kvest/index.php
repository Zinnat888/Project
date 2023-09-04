<?php
    session_start();
    include('incl/connect.php');
    if(isset($_SESSION['uid'])){
        $sql = "SELECT * FROM users WHERE id='{$_SESSION['uid']}'";
        $result = $link->query($sql, PDO::FETCH_ASSOC);
        $user=$result->fetch();
    } 
    if($_REQUEST['do']=="exit"){
        session_unset();
        echo '<script>document.location.href="?"</script>';
    }
    $user_id=$user['id'];
    $user_fio=$user['fio'];
    $user_level=$user['level'];

    // $a = time();
    // echo date('d.m.Y H:i:s', $a);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pautina</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_header.css">
    <link rel="stylesheet" href="css/style_nav2.css">
    <link rel="stylesheet" href="css/style_store.css">
    <link rel="stylesheet" href="css/style_tasks.css">
    <link rel="stylesheet" href="css/style_transactions.css">
    <link rel="stylesheet" href="css/style_footer.css">
    <link rel="stylesheet" href="css/style_admin_tasks.css">
    <link rel="stylesheet" href="css/style_admin_orders.css">
    <link rel="stylesheet" href="css/style_unique_quest.css">
    <link rel="stylesheet" href="css/style_unique_exercise.css">
    <link rel="stylesheet" href="css/style_add_task.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        
        
        if(isset($_GET['auth'])){
            
            $id_= $_GET['auth'];
            
            $sql = "SELECT * FROM users WHERE id='$id_'";
            $result = $link->query($sql, PDO::FETCH_ASSOC);
            $y = 0;
            while($x = $result -> fetch()){
                $y++;
            }
            if($y==0){
                $error_pass='Неверный логин или пароль';
            }
            if(empty($error_pass)){
                $sql = "SELECT * FROM users WHERE id='$id_'";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                $row=$result->fetch();
                $uid=$row['id'];
                // echo $row['fio'];
                $_SESSION['uid']=$uid;
                echo '<script>document.location.href="?"</script>';
            }
        }
    ?>    

    <div>
        <?php
        
            
            if(isset($_SESSION['uid'])){
            }else{ echo '
                <div>
                    Admin
                    <a href="?auth=26">Войти</a>
                </div>
                <div>
                    User    
                    <a href="?auth=195">Войти</a>
                </div>
                <div>
                    User2    
                    <a href="?auth=196">Войти</a>
                </div>'
                ;}
            // echo $user_id;
        ?>
    </div>

    <?php
        include('incl/header.php');
        include('incl/nav2.php');
    ?>

    <main>
        <?php
            if(isset($_GET['page'])){
                if($_GET['page']=='add_clique'){
                    include('incl/add_clique.php');
                }
                if($_GET['page']=='add_exercise'){
                    include('incl/add_exercise.php');
                }
                // if($_GET['page']=='add_quest'){
                //     include('incl/add_quest.php');
                // }
                if($_GET['page']=='add_tovar'){
                    include('incl/add_tovar.php');
                }

                // ADMIN--------
                if($_GET['page']=='admin_cliques'){
                    include('incl/admin_cliques.php');
                }
                if($_GET['page']=='admin_exercise'){
                    include('incl/admin_exercise.php');
                }
                if($_GET['page']=='admin_orders'){
                    include('incl/admin_orders.php');
                }
                // if($_GET['page']=='admin_quests'){
                //     include('incl/admin_quests.php');
                // }

                // -----------
                if($_GET['page']=='check_tasks_view'){
                    include('incl/check_tasks_view.php');
                }
                if($_GET['page']=='check_tasks'){
                    include('incl/check_tasks.php');
                }
                if($_GET['page']=='checked_task'){
                    include('incl/checked_task.php');
                }
                if($_GET['page']=='cliques'){
                    include('incl/cliques.php');
                }
                if($_GET['page']=='edit_clique'){
                    include('incl/edit_clique.php');
                }
                if($_GET['page']=='edit_exercise'){
                    include('incl/edit_exercise.php');
                }
                if($_GET['page']=='exercises'){
                    include('incl/exercises.php');
                }
                if($_GET['page']=='orders_view'){
                    include('incl/orders_view.php');
                }
                if($_GET['page']=='orders'){
                    include('incl/orders.php');
                }
                // if($_GET['page']=='quests'){
                //     include('incl/quests.php');
                // }
                if($_GET['page']=='store'){
                    include('incl/store.php');
                }
                if($_GET['page']=='transactions'){
                    include('incl/transactions.php');
                }
                if($_GET['page']=='unique_exercise'){
                    include('incl/unique_exercise.php');
                }
                if($_GET['page']=='unique_quest'){
                    include('incl/unique_quest.php');
                }                
            }
            else{
                include('incl/exercises.php');
            }
        ?>
    </main>

    <?php
        include('incl/footer.php');
    ?>
</body>
</html>
