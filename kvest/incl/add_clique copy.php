1.1	index.php
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
                echo $row['fio'];
                $_SESSION['uid']=$uid;
                echo '<script>document.location.href="?"</script>';
            }
        }
    ?>    
    <div>
        <?php
        
            
            if(isset($_SESSION['uid'])){
                echo $user['level'].' <a href="?do=exit"> Выйти </a>';
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
            echo $user_id;
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
1.2	add_clique.php
<?php if($user_level == 5){?>
<section class="section_add_task">
    <div class="container">
        <div class="add_task">
            <div class="wrap_add_task">
                <div class="wrap_add_task_h3">
                    <h3 class="add_task_h3">
                        Добавление клика на сайт
                    </h3>
                </div>
                <?php
                
                if(isset($_POST['add_clique'])){
                    $name = $_POST['name'];
                    $site_link = $_POST['link'];
                    $points = $_POST['points'];
                    $time = $_POST['time'];    
                    $public = $_POST['public'];  
                    $date = time();
                    if(empty($name && $site_link && $points && $time)){
                        $error = 'Заполните все поля';
                    }else{
                        $link->query("INSERT INTO clique (name, link, points, time, date, public, deleted) 
                        VALUES ('$name','$site_link','$points','$time', '$date', '$public', '0')");
                        echo '<script>document.location.href="?page=admin_cliques"</script>';       
                    }      
                }   
                
                ?>
                <form class="add_task_form" name="add_clique" method="POST"> 
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Наименование</div>
                        <input type="text" class="input_task" name="name">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Ссылка(url)</div>
                        <input type="text" class="input_task" name="link">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Баллы</div>
                        <input type="text" class="input_task" name="points">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Время</div>
                        <input type="number" class="input_task" name="time" placeholder="В секундах">
                    </div>
                    <div class="wrap_input_task form_toggle">
                        <div class="form_toggle-item item-1">
                            <input id="fid-1" type="radio" name="public" value="0" value="off">
                            <label for="fid-1">Не показывать</label>
                        </div>
                        <div class="form_toggle-item item-2">
                            <input id="fid-2" type="radio" name="public" value="1" value="on" checked>
                            <label for="fid-2">Показывать</label>
                        </div>
                    </div>
                    <div class="report_error"> <?php echo $error ?> </div>
                    <button class="finish_exercise" name="add_clique">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?}?>
1.3	add_exercise.php
<?php if($user_level == 5){?>
<section class="section_add_task">
    <div class="container">
        <div class="add_task">
            <div class="wrap_add_task">
                <div class="wrap_add_task_h3">
                    <h3 class="add_task_h3">
                        Добавление задания
                    </h3>
                </div>
                <?php                
                    if(isset($_POST['add_task'])){
                        $name = $_POST['name'];
                        $description = $_POST['description'];
                        $points = $_POST['points'];
                        $time = $_POST['time'];
                        $public = $_POST['public'];
                         // screenshot
                        $file_name=$_FILES['img']['name'];
                        echo $file_name;
                        $screenshot='img/exercise/'.time().$_FILES['img']['name'];
                        move_uploaded_file($_FILES['img']['tmp_name'], $screenshot);
        
                        if(empty($name && $description && $points && $time)){
                            $error = 'Заполните все поля';
                        }else{
                            $link->query("INSERT INTO exercise (name, description, screenshot, points, time, public, deleted) 
                            VALUES ('$name','$description', '$screenshot', '$points','$time','$public', '0')");
                            echo '<script>document.location.href="?page=admin_exercise"</script>';      
                        }
                    }   
                ?>
                <form class="add_task_form" method="POST" name="add_task" enctype="multipart/form-data"> 
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Наименование</div>
                        <input type="text" class="input_task" name="name" maxlength="70">
                    </div>
                    <div class="wrap_textarea_task">
                        <div class="textarea_name">Описание</div>
                        <textarea id="" rows="10" class="textarea" name="description"></textarea>
                    </div>
                    <div class="wrap_add_scrin">
                        <div class="add_scrin">
                            Вставьте скриншот
                            <img src="img/add-img.svg" alt="" >
                        </div>
                        <input type="file" class="input_file" name="img">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Баллы</div>
                        <input type="number" class="input_task" name="points">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Время</div>
                        <input type="number" class="input_task" name="time" placeholder="В минутах">
                    </div>
                    <div class="wrap_input_task form_toggle">
                        <div class="form_toggle-item item-1">
                            <input id="fid-1" type="radio" name="public" value="0" value="off">
                            <label for="fid-1">Не показывать</label>
                        </div>
                        <div class="form_toggle-item item-2">
                            <input id="fid-2" type="radio" name="public" value="1" value="on" checked>
                            <label for="fid-2">Показывать</label>
                        </div>
                    </div>
                    <div class="report_error"> <?php echo $error ?> </div>
                    <button class="finish_exercise" name="add_task">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?}?>
1.4	add_tovar.php
<?php 
if($user_level == 5){
    ?>
<section class="section_add_task">
    <div class="container">
        <div class="add_task">
            <div class="wrap_add_task">
                <div class="wrap_add_task_h3">
                    <h3 class="add_task_h3">
                        Добавление товара
                    </h3>
                </div>
                <?php                
                    if(isset($_POST['add_tovar'])){
                        $name = $_POST['name'];
                        $points = $_POST['points'];
                        // $public = $_POST['public'];
                        // screenshot
                        $file_name=$_FILES['img']['name'];
                        echo $file_name;
                        $screenshot='img/tovar/tovar'.time().$_FILES['img']['name'];
                        move_uploaded_file($_FILES['img']['tmp_name'], $screenshot);
        
                        if(empty($name && $points)){
                            $error = 'Заполните все поля';
                        }else{
                            $link->query("INSERT INTO tovar (name, img, points, deleted) 
                            VALUES ('$name', '$screenshot', '$points', '0')");
                            echo '<script>document.location.href="?page=store"</script>';        
                        }                                
                    }         
                ?>
                <form class="add_task_form" method="POST" name="add_tovar" enctype="multipart/form-data"> 
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Наименование</div>
                        <input type="text" class="input_task" name="name">
                    </div>
                    <div class="wrap_add_scrin">
                        <div class="add_scrin">
                            Вставьте фото
                            <img src="img/add-img.svg" alt="" >
                        </div>
                        <input type="file" class="input_file" name="img">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Баллы</div>
                        <input type="number" class="input_task" name="points">
                    </div>
                    <!-- <div class="wrap_input_task form_toggle">
                        <div class="form_toggle-item item-1">
                            <input id="fid-1" type="radio" name="public" value="0" value="off">
                            <label for="fid-1">Не показывать</label>
                        </div>
                        <div class="form_toggle-item item-2">
                            <input id="fid-2" type="radio" name="public" value="1" value="on" checked>
                            <label for="fid-2">Показывать</label>
                        </div>
                    </div> -->
                    <div class="report_error"> <?php echo $error ?> </div>
                    <button class="finish_exercise" name="add_tovar">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?
}
?>
1.5	admin_cliques.php
<?php if($user_level == 5){?>
<section class="section_tasks">
    <div class="container">
        <h1 class="h1_task_admin">Клики</h1>
        <div class="h1_add">
        <a class="add" href="?page=add_clique">
            Добавить клик
            <img src="img/plus.svg" alt="">
        </a>
        </div>
        <div class="wrap_tasks">            
            <?php                
                $sql = "SELECT * FROM clique WHERE deleted='0' ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($clique = $result->fetch()){
            ?>
            <div class="task admin_task">
                <div class="task_left">
                    <div class="task_name">
                        <?php echo $clique['name']?> 
                    </div>
                    <div class="time_view">
                        <div class="view">
                            <?php echo $clique['time']?> сек
                            <img src="img/icon-v.svg" alt="">
                        </div>
                        <div>
                            <div class="point_admin2">1Б</div>
                        </div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point_admin"><?php echo $clique['points']?>&nbsp;Б</div>
                    <a href="<?php echo $clique['link']?>" class="more">Перейти</a>
                    <a href="?page=edit_clique&id=<?php echo $clique['id'] ?>" class="cliques-edit">
                        <img src="img/icon-edit.png" alt="">
                    </a>
                </div>
            </div>
            <?php
                }
            ?>
            <!-- <div class="task admin_task">
                <div>
                    <div class="task_name">
                        Название сайта
                    </div>
                    <div class="time_view">
                        <div class="view">
                            66
                            <img src="img/icon-v.svg" alt="">
                        </div>
                        <div>
                            <div class="point_admin2">1Б</div>
                        </div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point_admin">1Б</div>
                    <a href="?" class="more">Перейти</a>
                    <a href="?" class="cliques-edit"><img src="img/icon-edit.png" alt=""></a>
                </div>
            </div> -->
        </div>        
        <div class="pagination_wrap">
            <div class="wrap_help">
                <a href="?" class="btn-pagin1">Назад</a>
            </div>
            <div class="pagination_only">
                <a href="?" class="btn-pagin2 pagin_this">1</a>
                <a href="?" class="btn-pagin2">2</a>
                <a href="?" class="btn-pagin2">3</a>
                <a href="?" class="btn-pagin2">4</a>
                <a href="?" class="btn-pagin2">155</a>
            </div>
            <div class="wrap_help">
                <a href="?" class="btn-pagin1">Вперед</a>
            </div>
        </div>
    </div>
</section>
<?}?>
1.6	admin_exercise.php
<?php if($user_level == 5){?>
<section class="section_tasks">
    <div class="container">
        <h1 class="h1_task_admin">Задания</h1>
        <div class="h1_add">
            <a class="add" href="?page=add_tovar">
                Добавить товар
                <img src="img/plus.svg" alt="">
            </a>
        </div>
        <div class="menu">
            <div class="btn-menu-flex"> 
                <?php
                    if($user_level == 5){
                ?>
                        <a href="?page=admin_exercise" class="btn-menu">Admin задания</a>
                        <a href="?page=check_tasks" class="btn-menu">Проверка заданий</a>
                        <a href="?page=checked_task" class="btn-menu">Задания на проверке</a>
                <?php 
                    }
                ?>
            </div>            
        </div>
        <div class="wrap_tasks">
            <?php                
                $sql = "SELECT * FROM exercise WHERE deleted='0' ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($exercise = $result->fetch()){
            ?>
            <div class="task admin_task">
                <div class="admin_task_item">
                    <div class="task_name">
                        <? echo $exercise['name']?>
                    </div>
                    <div class="time_view">
                        <div>
                            <div class="point_admin2"><? echo $exercise['points']?>&nbsp;Б</div>
                        </div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point_admin"><? echo $exercise['points']?>&nbsp;Б</div>
                    <a href="?page=unique_exercise&id=<? echo $exercise['id']?>" class="more">Перейти</a>
                    <a href="?page=edit_exercise&id=<?php echo $exercise['id']?>" class="cliques-edit">
                        <img src="img/icon-edit.png" alt="">
                    </a>
                </div>
            </div>
            <? } ?>
            <!-- <div class="task admin_task">
                <div>
                    <div class="task_name">
                        Наименование задания
                    </div>
                    <div class="time_view">
                        <div class="view">
                            66
                            <img src="img/icon-v.svg" alt="">
                        </div>
                        <div>
                            <div class="point_admin2">1Б</div>
                        </div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point_admin">1Б</div>
                    <a href="?" class="more">Перейти</a>
                    <a href="?" class="delete">Удалить</a>
                </div>
            </div> -->
        </div>
    </div>
</section>
<?}?>
1.7	admin_orders.php
<?php if($user_level == 5){?>
<?php
    if(isset($_GET['accept_id'])){
        $accept_id = $_GET['accept_id'];
        $link->query("UPDATE users_tovar SET status = '2' WHERE id_tovar = $accept_id");
        echo '<script>document.location.href="?page=admin_orders"</script>';  
    }
?>
<section class="section_tasks">
    <div class="container">
        <div class="h1_add">
            <h1 class="h1_task_admin">Заказы</h1>
        </div>
        <div class="wrap_tasks">
            <?php                
                $sql = "SELECT * FROM users_tovar ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($users_tovar = $result->fetch()){
                    $id_tovar = $users_tovar['id_tovar'];
                    $id_user = $users_tovar['id_user'];
                    $tov_status = $users_tovar['status'];
                    $tov_status2 = $users_tovar['status'];
                    $tov_date = $users_tovar['date'];
            ?>
                <div class="order_item">
                    <div class="order_name">
                        <?php
                            $sql2 = "SELECT * FROM tovar WHERE id=$id_tovar";
                            $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                            $tovar = $result2->fetch();
                            echo $tovar['name'];
                            $tov_points = $tovar['points'];
                        ?>
                    </div>
                    <div class="order_data">
                        <div class="order_contacts">
                            <?php
                                $sql3 = "SELECT * FROM users WHERE id=$id_user";
                                $result3 = $link->query($sql3, PDO::FETCH_ASSOC);
                                $user_name = $result3->fetch();
                            ?>
                            <p>ФИО:  <? echo $user_name['fio']; ?></p>
                            <p>Почта:  <? echo $user_name['mail']; ?></p>
                            <p>Телефон:  <? echo $user_name['phone']; ?></p>
                        </div>
                        <div class="order_status">
                            <?php 
                                if($tov_status == 1){
                                    $tov_status = '<div class="order_status_item yellow">Ожидает отправки</div>';
                                }elseif($tov_status == 2){
                                    $tov_status = '<div class="order_status_item yellow2">Товар отправлен</div>';
                                }elseif($tov_status == 3){
                                    $tov_status = '<div class="order_status_item green">Товар получен</div>';
                                }else{
                                    echo "erorr";
                                }
                                echo $tov_status;
                            ?>
                            
                        </div>
                    </div>
                    <div class="order_bottom">
                        <div class="order_bottom_left">
                            <div class="order_view">
                                <a class="view_exercise" href="?page=orders_view&id=<?echo $id_tovar?>"> Просмотр </a>
                            </div>
                            <div class="order_points">
                                <?php echo $tov_points.' Б'; ?>
                            </div>
                        </div>
                        <div class="order_bottom_right">
                            
                            <?php 
                                if($tov_status2 == 1){
                            ?>
                                <div class="order_bottom_btn">
                                    <a href="?page=admin_orders&accept_id=<?echo $id_tovar?>" class="order_bottom_btn">Товар отправлен</a>
                                </div>
                            <?php
                                }
                            ?>  
                               
                        </div>
                    </div>
                </div>
            <?
                }
            ?>            
        </div>
    </div>
</section>
<?}?>
1.8	check_tasks_view.php
<?php
    if(isset($_GET['id'])){
    $get_id = $_GET['id'];
    $sql = "SELECT * FROM exercise WHERE id=$get_id";
    $result = $link->query($sql, PDO::FETCH_ASSOC);
    $exercise = $result->fetch()
?>
<?php
    if(isset($_POST['exercise_report'])){
        $screenshot = $_POST['screenshot'];
        $report_link = $_POST['report_link'];
         // screenshot
         $file_name=$_FILES['img']['name'];
         echo $file_name;
         $screenshot='img/exercise'.time().$_FILES['img']['name'];
         move_uploaded_file($_FILES['img']['tmp_name'], $screenshot);
        $link->query("INSERT INTO users_exercise (id_exercise, id_user, screenshot, link, status) 
        VALUES ('$get_id','$user_id','$screenshot', '$report_link', '1')");
        echo '<script>document.location.href="?"</script>';            
    }
?>
<section class="section_unique_exercise">
    <div class="container">
        <div class="unique_exercise">
            <div class="exercise_name_wrap">
                <h2 class="exercise_name"><?echo $exercise['name']?></h2>
                <!-- <p class="exercise_description">Описание описание описание описание описание описание описание описание описание описание </p> -->
                <div class="time_view">
                    <div class="time"><?echo $exercise['time']?> мин</div>
                    <div>
                        <div class="point_unique_quest"><?echo $exercise['points']?>&nbsp;Б</div>
                    </div>
                </div>
            </div>
            <p class="exercise_text">
                <?echo $exercise['description']?>
            </p>
            <div class="wrap_exercise">
                <img src="<?echo $exercise['screenshot']?>" alt="">
                
                
                    <div class="exercise_report">
                        <h3 class="report_h3">
                            Отчет задания
                        </h3>
                        <form class="exercise_form" method="POST" name="exercise_report" enctype="multipart/form-data"> 
                            <?php
                            if(isset($_GET['id'])){
                                $get_id = $_GET['id'];
                                $sql = "SELECT * FROM users_exercise WHERE id_exercise=$get_id";
                                $result = $link->query($sql, PDO::FETCH_ASSOC);
                                $task = $result->fetch();
                            ?>
                            <div class="wrap_add_scrin">
                                <div class="add_scrin">
                                    <img src="<? echo $task['screenshot']?>" alt="">
                                </div>
                            </div>
                            <div class="wrap_input_url">
                                <div class="inp_url_name">Ссылка(url)</div>
                                <input type="text" class="input_url" name="report_link" value="<? echo $task['link']?>">
                            </div>
                            <? } ?>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>
<?
    }
?>
1.9	check_tasks.php
<?php if($user_level == 5){?>
<?php
    
    if(isset($_GET['accept_id'])){
        $accept_id = $_GET['accept_id'];
        $sql7 = "SELECT * FROM exercise WHERE id=$accept_id";
        $result7 = $link->query($sql7, PDO::FETCH_ASSOC);
        $exer_tr = $result7->fetch();
        $exer_points = $exer_tr['points'];
        
        $sql8 = "SELECT * FROM users_exercise WHERE id_exercise = $accept_id";
        $result8 = $link->query($sql8, PDO::FETCH_ASSOC);
        $exer_user = $result8->fetch();
        $exer_id_user = $exer_user['id_user'];
        // Обновление статуса в юзер задания
        // status = 1 отправил задание
        // status = 2 задание принято 
        // status = 3 задание откланено
        $link->query("UPDATE users_exercise SET status = '2' WHERE id_exercise = $accept_id");
        // Добавление транзакции
        // поле type в таблице transactions
        // 1 клик
        // 2 задание
        // 3 товар
        $date = time();
        $link->query("INSERT INTO transactions (type, id_name, id_user, date, balanse) 
        VALUES ('2','$accept_id','$exer_id_user', '$date', '$exer_points')");
        echo '<script>document.location.href="?page=check_tasks "</script>';  
    }
    if(isset($_GET['reject_id'])){
        $reject_id = $_GET['reject_id'];
        // status = 1 отправил задание
        // status = 2 задание принято 
        // status = 3 задание откланено
        $link->query("UPDATE users_exercise SET status = '3' WHERE id_exercise = $reject_id");
        echo '<script>document.location.href="?page=check_tasks "</script>';  
    }
?>
<section class="section_tasks">
    <div class="container">
        <h1 class="h1_task_admin">Проверка заданий</h1>
        <div class="menu">
            <div class="btn-menu-flex"> 
                <?php
                    if($user_level == 5){
                ?>
                        <a href="?page=admin_exercise" class="btn-menu">Admin задания</a>
                        <a href="?page=check_tasks" class="btn-menu">Проверка заданий</a>
                        <a href="?page=checked_task" class="btn-menu">Задания на проверке</a>
                <?php 
                    }
                ?>
            </div>            
        </div>
        <div class="wrap_tasks">
            <?php                
                $sql = "SELECT * FROM users_exercise WHERE status = '1' ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($users_exercise = $result->fetch()){
                    $id_exercise = $users_exercise['id_exercise'];
                    $id_user = $users_exercise['id_user'];
                    $screenshot = $users_exercise['screenshot'];
                    $report_link = $users_exercise['link'];
                    // echo $id_exercise, $id_user, $screenshot, $report_link;
            ?>
                <div class="task admin_task">
                    <div class="admin_task_item">
                        <div class="task_name">
                            <?php
                                $sql2 = "SELECT * FROM exercise WHERE id=$id_exercise";
                                $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                                $exercise = $result2->fetch();
                                echo $exercise['name'];
                            ?>
                        </div>
                        <div class="fulfilled_by">
                            Выполнил: <br>
                            <?php
                                $sql3 = "SELECT * FROM users WHERE id=$id_user";
                                $result3 = $link->query($sql3, PDO::FETCH_ASSOC);
                                $user_name = $result3->fetch();
                                echo $user_name['fio'];
                            ?>
                        </div>
                        <div class="time_view">
                            <div class="view">
                                <a class="view_exercise" href="?page=check_tasks_view&id=<?echo $id_exercise?>"> Просмотр </a>
                            </div>
                            <div class="time">
                                <?php
                                    $sql4 = "SELECT * FROM exercise WHERE id=$id_exercise";
                                    $result4 = $link->query($sql4, PDO::FETCH_ASSOC);
                                    $exercise = $result4->fetch();
                                    echo $exercise['time'].' мин';
                                ?>
                            </div>
                            <div>
                                <div class="point_admin2">
                                <?php
                                    $sql5 = "SELECT * FROM exercise WHERE id=$id_exercise";
                                    $result5 = $link->query($sql5, PDO::FETCH_ASSOC);
                                    $exercise = $result5->fetch();
                                    echo $exercise['points'];
                                    echo ' Б';
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="point_start">
                        <div class="point_admin">
                            <?php
                                $sql6 = "SELECT * FROM exercise WHERE id=$id_exercise";
                                $result6 = $link->query($sql6, PDO::FETCH_ASSOC);
                                $exercise = $result6->fetch();
                                echo $exercise['points'];
                                echo ' Б';
                            ?>
                        </div>
                        <a href="?page=check_tasks&accept_id=<?echo $id_exercise?>" class="more">Принять</a>
                        <a href="?page=check_tasks&reject_id=<?echo $id_exercise?>" class="delete">Отклонить</a>
                    </div>
                    
                </div>
            <?
                }
            ?>
            <!-- <div class="task admin_task">
                <div>
                    <div class="task_name">
                        Наименование задания
                    </div>
                    <div class="fulfilled_by">
                        Выполнил: <br>
                        Иванов Иван Иванович
                    </div>
                    <div class="time_view">
                        <div class="view">
                            66
                            <img src="img/icon-v.svg" alt="">
                        </div>
                        <div class="time">5 мин</div>
                        <div>
                            <div class="point_admin2">1Б</div>
                        </div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point_admin">1Б</div>
                    <a href="?" class="more">Принять</a>
                    <a href="?" class="delete">Отклонить</a>
                </div>
            </div>   -->
        </div>
    </div>
</section>
<?}?>
1.10	checked_task.php
<?php
?>
<section class="section_tasks">
    <div class="container">
        <h1 class="h1_task_admin">Задания на пароверке</h1>
        <div class="menu">
            <div class="btn-menu-flex"> 
                <?php
                    if($user_level == 5){
                ?>
                        <a href="?page=admin_exercise" class="btn-menu">Admin задания</a>
                        <a href="?page=check_tasks" class="btn-menu">Проверка заданий</a>
                        <a href="?page=checked_task" class="btn-menu">Задания на проверке</a>
                <?php 
                    }
                ?>
            </div>
        </div>
        <div class="wrap_tasks">
            <?php                
                $sql = "SELECT * FROM users_exercise WHERE id_user = $user_id ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($users_exercise = $result->fetch()){
                    $id_exercise = $users_exercise['id_exercise'];
                    // $id_user = $users_exercise['id_user'];
                    // $screenshot = $users_exercise['screenshot'];
                    // $report_link = $users_exercise['link'];
                    // echo $id_exercise, $id_user, $screenshot, $report_link;
            ?>
                <div class="task admin_task">
                    <div class="admin_task_item">
                        <div class="task_name">
                            <?php
                                $sql2 = "SELECT * FROM exercise WHERE id=$id_exercise";
                                $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                                $exercise = $result2->fetch();
                                echo $exercise['name'];
                            ?>
                        </div>
                        
                        <div class="time_view">
                            <div class="view">
                                <a class="view_exercise" href="?page=check_tasks_view&id=<?echo $id_exercise?>"> Просмотр </a>
                            </div>
                            <div class="time">
                                <?php
                                    $sql4 = "SELECT * FROM exercise WHERE id=$id_exercise";
                                    $result4 = $link->query($sql4, PDO::FETCH_ASSOC);
                                    $exercise = $result4->fetch();
                                    echo $exercise['time'].' мин';
                                ?>
                            </div>
                            <div>
                                <div class="point_admin2">
                                <?php
                                    $sql5 = "SELECT * FROM exercise WHERE id=$id_exercise";
                                    $result5 = $link->query($sql5, PDO::FETCH_ASSOC);
                                    $exercise = $result5->fetch();
                                    echo $exercise['points'];
                                    echo ' Б';
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="point_start">
                        <div class="point_admin">
                            <?php
                                $sql6 = "SELECT * FROM users_exercise WHERE id_exercise = $id_exercise";
                                $result6 = $link->query($sql6, PDO::FETCH_ASSOC);
                                $exercise = $result6->fetch();
                                $status = $exercise['status'];
                                
                                if($status == 1){
                                    echo '<div class="yellow">Проверяется</div>';
                                }elseif($status == 2){
                                    echo 'Выполнено';
                                }elseif($status == 3){
                                    echo '<div class="red">Отклонено</div>';
                                }else{
                                    echo 'error';
                                }
                            ?>
                        </div>
                    </div>
                    
                </div>
            <?
                }
            ?>
            <!-- <div class="task admin_task">
                <div>
                    <div class="task_name">
                        Наименование задания
                    </div>
                    <div class="fulfilled_by">
                        Выполнил: <br>
                        Иванов Иван Иванович
                    </div>
                    <div class="time_view">
                        <div class="view">
                            66
                            <img src="img/icon-v.svg" alt="">
                        </div>
                        <div class="time">5 мин</div>
                        <div>
                            <div class="point_admin2">1Б</div>
                        </div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point_admin">1Б</div>
                    <a href="?" class="more">Принять</a>
                    <a href="?" class="delete">Отклонить</a>
                </div>
            </div>   -->
        </div>
    </div>
</section>
1.11	cliques.php
<section class="section_tasks">
    <div class="container">
        <div class="menu">
            <div>
                <h1 class="h1_cliques">Клики</h1>  
                <p class="p-description">Для прохождения клика, необходимо не закрывать сайт в течении нескольких секунд</p>
            </div>
            <div class="btn-menu-flex"> 
                <?php
                    if($user_level == 5){
                ?>
                        <a href="?page=admin_cliques" class="btn-menu">Admin клик</a>
                <?php 
                    }
                ?>
            </div>
           
        </div>
        
        
        <div class="wrap_tasks">
            
            <?php            
                function getIp() {
                  $keys = [
                    'HTTP_CLIENT_IP',
                    'HTTP_X_FORWARDED_FOR',
                    'REMOTE_ADDR'
                  ];
                  foreach ($keys as $key) {
                    if (!empty($_SERVER[$key])) {
                      $ip = trim(end(explode(',', $_SERVER[$key])));
                      if (filter_var($ip, FILTER_VALIDATE_IP)) {
                        return $ip;
                      }
                    }
                  }
                }
                
                $user_ip = getIp();
                // выведем IP клиента на экран
                // echo 'ip = ' . $user_ip;            
            
                if(isset($_GET['click'])){
                    $token = $_GET['click'];
                    
                    $sql = "SELECT * FROM users_clique WHERE token='$token'";
                    $result = $link->query($sql, PDO::FETCH_ASSOC);
                    $id_clique = $result->fetch();
                    $clique_id = $id_clique['id_clique'];
                    $sql = "SELECT * FROM clique WHERE id='$clique_id'";
                    $result = $link->query($sql, PDO::FETCH_ASSOC);
                    $points_clique = $result->fetch();
                    $clique_points = $points_clique['points'];
                    // Добавление транзакции
                    // поле type в таблице transactions
                    // 1 клик
                    // 2 задание
                    // 3 товар
                    $date = time();
                    $link->query("INSERT INTO transactions (type, id_name, id_user, date, balanse) 
                    VALUES ('1','$clique_id','$user_id', '$date', '$clique_points')");
                    $link->query("UPDATE users_clique SET status='1' WHERE token='$token'");
                    $link->query("UPDATE users_clique SET token='0' WHERE token='$token'");
                   
                    
                    
                    echo '<script>document.location.href="?page=cliques"</script>';
                }
            
                if(isset($_POST['click'])){
                    $click_id = $_POST['click_id'];
                    $sql = "SELECT * FROM clique WHERE id = $click_id";
                    $result = $link -> query($sql, PDO::FETCH_ASSOC);
                    $click = $result -> fetch();
                    $now = time();
                    //создается рандомный зашифрованный код
                        $rand = rand(111111, 999999);
                        $token = md5($rand);
                    // echo $token;
                    // сохдается запись, что пользователь нажал на кнопку. там будет временный токен
                    $sql = "INSERT INTO users_clique (id_clique, id_user, date, ip, token, status) 
                        VALUES ('$click_id','$user_id','$now','$user_ip','$token','0')";
                    $link -> query($sql);
                    echo '<script>document.location.href="'.$click['link'].'?click='.$token.'"</script>';
                }
                //выбираем клики, которые предназначены на этот день
                
                // определяем реальное время
                
                // определяем начало сегодняшнего дня 00:00
                $today=strtotime(date("d-m-Y"));
                // определяем конец сегодняшнего дня 24:59
                $tomorrow=$today+86400;
                // echo $tomorrow;
                // убрал с запроса sql AND date >= $today AND date < $tomorrow для диплома
            
                $sql = "SELECT * FROM clique WHERE public='1' AND deleted='0'  ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($clique = $result->fetch()){
                    $click_id = $clique['id'];
                    // нужно сркыть пройденные клики
                    $sql2="SELECT * FROM users_clique WHERE id_user = '$user_id' AND id_clique = '$click_id'";
                    $result2=$link->query($sql2, PDO::FETCH_ASSOC);
                    $num=$result2->fetch();
                    // echo $num;
                    if($num == 0){
                        // нужно вывести с ошибкой, если уже использовался данный  ip
                        $sql3="SELECT * FROM users_clique WHERE ip = '$user_ip' AND id_clique = '$click_id'";
                        $result3=$link->query($sql3, PDO::FETCH_ASSOC);
                        $num=$result3->fetch();
                        if($num==0){
                        ?>
                            <div class="task">
                                <div class="task_item">
                                    <div class="task_name">
                                        <?php echo $clique['name']?> 
                                    </div>
                                    <div class="time_view">
                                        <div class="time"><?php echo $clique['time']?> сек</div>
                                    </div>
                                </div>
                                <div class="point_start">
                                    <div class="point"><?php echo $clique['points']?>&nbsp;Б</div>
                                    
                                    <!-- <button name="click" class="start">Перейти</button> -->
                                    <form method="POST" name="click">
                                        <input type="hidden" name="click_id" value="<?php echo $clique['id']?>">
                                        <input type="submit" class="start" name="click" value="Перейти">
                                    </form>                        
                                </div>
                            </div>
                        <?php
                        }else{
                            echo'
                            <div class="task">
                                <div class="task_item">
                                    <div class="task_name">
                                        '.$clique['name'].' 
                                    </div>
                                    <div class="time_view">
                                        <div class="time">'.$clique['time'].'сек</div>
                                    </div>
                                </div>
                                <div class="point_start">
                                    <div class="point">'.$clique['points'].'&nbsp;Б</div>
                                    
                                    <!-- <button name="click" class="start">Перейти</button> -->
                                    <form>
                                        <input type="hidden" value="">
                                        
                                    </form>                        
                                </div>
                                
                                <div>(можете нажать с другого устройства)</div>
                            </div>
                            ';
                          
                        }
                    }else{
                        // echo 'Вы не дождались';
                    }
                // $sql2 = "SELECT * FROM clique WHERE date >= $today AND date < $tomorrow";
                // $result2 = $link -> query($sql2, PDO::FETCH_ASSOC);
                // while($click = $result2 -> fetch()){
                //     $click_id = $click['id'];
                //     // нужно сркыть пройденные клики
                //     $query1="SELECT * FROM users_clique WHERE id_user = '$user_id' AND id_clique = '$click_id'";
                //     $result1=$link->query($query1);
                //     $num=$result1->num_rows;
                //     if($num==0)
                //     {
                //         // нужно вывести с ошибкой, если уже использовался данный  ip
                //         $query1="SELECT * FROM users_clique WHERE ip = '$user_ip' AND id_click = '$click_id'";
                //         $result1=$link->query($query1);
                //         $num=$result1->num_rows;
                //         if($num==0)
                //         {
                //             echo'<br>
                //                 <form method="POST" name="click">
                //                     <input type="hidden" name="click_id" value="'.$click['id'].'">
                //                     <input type="submit" name="click" value="'.$click['text'].'">
                //                 </form>
                //             ';
                //         }else{
                //             echo'<br>
                //                 <style>
                //                     .no_button{
                //                         background:orange;
                //                     }
                //                     .no_button:hover{
                //                         cursor: not-allowed
                //                     }
                //                 </style>
                //                 <input class="no_button" type="submit" value="'.$click['text'].'">
                //                 (можете нажать с другого устройства)
                //             ';
                //         }                        
                //     }
                //     // нужно вывести с ошибкой мол не дождался окончания времени                    
                // }
                ?>
            <!-- <form name="click" method="POST"> -->
                
            <!-- </form> -->
            
            <?php
            }
            ?>

            <!-- <div class="task">
                <div>
                    <div class="task_name">
                        Название сайта 
                    </div>
                    <div class="time_view">
                        <div class="time">20 сек</div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point">1Б</div>
                    <a href="?" class="start">Перейти</a>
                </div>
            </div> -->
        </div>
    </div>
</section>
1.12	connect.php
<?php
try{
    $link = new PDO('mysql:host=localhost; dbname=z195; charset=utf8;', 'z195', 'U6fMS4_hx6Pnab!', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // echo "good";
} catch (PDOException $e) {
    echo $e;
    // echo "<br><b><h2>no connect!</h2></b>";
}
?>
1.13	edit_clique.php
<?php if($user_level == 5){?>
<?php
    if(isset($_GET['id'])){
    $get_id = $_GET['id'];
    $sql = "SELECT * FROM clique WHERE id=$get_id";
    $result = $link->query($sql, PDO::FETCH_ASSOC);
    $clique = $result->fetch();
?>
<?php
    if(isset($_POST['edit_clique'])){
        $name = $_POST['name'];
        $site_link = $_POST['link'];
        $points = $_POST['points'];
        $time = $_POST['time'];    
        $public = $_POST['public'];  
        $link->query("UPDATE clique SET name='$name', link='$site_link', points='$points', time='$time', public='$public' WHERE id=$get_id");
        echo '<script>document.location.href="?page=admin_cliques"</script>';            
    }  
    if(isset($_GET['delete'])){
        $link->query("UPDATE clique SET deleted='1' WHERE id=$get_id");
        echo '<script>document.location.href="?page=admin_cliques"</script>';  
    }
?>
<section class="section_add_task">
    <div class="container">
        <div class="add_task">
            <div class="wrap_add_task">
                <div class="wrap_add_task_h3">
                    <h3 class="add_task_h3">
                        Редактирование клика
                    </h3>
                </div>
                <form class="add_task_form" name="edit_clique" method="POST"> 
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Наименование</div>
                        <input type="text" class="input_task" name="name" value="<?php echo $clique['name']?>">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Ссылка(url)</div>
                        <input type="text" class="input_task" name="link" value="<?php echo $clique['link']?>">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Баллы</div>
                        <input type="text" class="input_task" name="points" value="<?php echo $clique['points']?>">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Время</div>
                        <input type="number" class="input_task" name="time" placeholder="В секундах" value="<?php echo $clique['time']?>">
                    </div>
                    <div class="wrap_input_task form_toggle">
                        <div class="form_toggle-item item-1">
                            <input id="fid-1" type="radio" name="public" value="0" value="off">
                            <label for="fid-1">Не показывать</label>
                        </div>
                        <div class="form_toggle-item item-2">
                            <input id="fid-2" type="radio" name="public" value="1" value="on" checked>
                            <label for="fid-2">Показывать</label>
                        </div>
                    </div>
                    <button class="finish_exercise" name="edit_clique">Сохранить</button>
                    
                    <div class="wrap_input_task">
                        <a href="?page=edit_clique&id=<?php echo $get_id ?>&delete" class="delete">Удалить</a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</section>
<?php
    }
?>
<?}?>
1.14	edit_exercise.php
<?php if($user_level == 5){?>
<?php
    if(isset($_GET['id'])){
    $get_id = $_GET['id'];
    $sql = "SELECT * FROM exercise WHERE id=$get_id";
    $result = $link->query($sql, PDO::FETCH_ASSOC);
    $exercise = $result->fetch()
?>
<?php
    if(isset($_POST['edit_task'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $points = $_POST['points'];
        $time = $_POST['time'];   
        $public = $_POST['public']; 
        // screenshot
        $file_name=$_FILES['img']['name'];
        // echo $file_name.'___';
        $screenshot='img/exercise/'.time().$_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], $screenshot);
        if($file_name == 0){
            $sql = "SELECT * FROM exercise WHERE id=$get_id";
            $result = $link->query($sql, PDO::FETCH_ASSOC);
            $exercise_ = $result->fetch();
            $screenshot = $exercise_['screenshot'];
        }
        // echo $screenshot;
        $link->query("UPDATE exercise SET name='$name', description='$description', screenshot='$screenshot', points='$points', time='$time', public='$public' WHERE id=$get_id");
        echo '<script>document.location.href="?page=admin_exercise"</script>';            
    }  
    if(isset($_GET['delete'])){
        $link->query("UPDATE exercise SET deleted='1' WHERE id=$get_id");
        echo '<script>document.location.href="?page=admin_exercise"</script>';  
    }
?>
<section class="section_add_task">
    <div class="container">
        <div class="add_task">
            <div class="wrap_add_task">
                <div class="wrap_add_task_h3">
                    <h3 class="add_task_h3">
                        Редактирование задания
                    </h3>
                </div>
                <form class="add_task_form" method="POST" name="edit_task" enctype="multipart/form-data"> 
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Наименование</div>
                        <input type="text" class="input_task" name="name" value="<?echo $exercise['name']?>">
                    </div>
                    <div class="wrap_textarea_task">
                        <div class="textarea_name">Описание</div>
                        <textarea id="" rows="10" class="textarea" name="description"><?echo $exercise['description']?></textarea>
                    </div>
                    <div class="wrap_add_scrin">
                        <div class="add_scrin">
                            Вставьте скриншот
                            <img src="<?echo $exercise['screenshot']?>" alt="" >
                        </div>
                        <input type="file" class="input_file" name="img">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Баллы</div>
                        <input type="number" class="input_task" name="points" value="<?echo $exercise['points']?>">
                    </div>
                    <div class="wrap_input_task">
                        <div class="inp_add_name">Время</div>
                        <input type="number" class="input_task" name="time" placeholder="В секундах" value="<?echo $exercise['time']?>">
                    </div>
                    <div class="wrap_input_task form_toggle">
                        <div class="form_toggle-item item-1">
                            <input id="fid-1" type="radio" name="public" value="0" value="off">
                            <label for="fid-1">Не показывать</label>
                        </div>
                        <div class="form_toggle-item item-2">
                            <input id="fid-2" type="radio" name="public" value="1" value="on" checked>
                            <label for="fid-2">Показывать</label>
                        </div>
                    </div>
                    
                    <button class="finish_exercise" name="edit_task">Сохранить</button>
                    <div class="wrap_input_task">
                        <a href="?page=edit_exercise&id=<?php echo $get_id ?>&delete" class="delete">Удалить</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
    } 
?>
<?}?>
1.15	exercises.php
<section class="section_tasks">
    <div class="container">
        <div class="menu">
            <div>
                <h1 class="h1_exercises">Задания</h1>    
            </div>
            <div class="btn-menu-flex"> 
                <?php
                    if($user_level == 5){
                ?>
                        <a href="?page=admin_exercise" class="btn-menu">Admin задания</a>
                        <a href="?page=check_tasks" class="btn-menu">Проверка заданий</a>
                        <a href="?page=checked_task" class="btn-menu">Задания на проверке</a>
                <?php 
                    }elseif($user_level < 5){
                ?>
                        <a href="?page=checked_task" class="btn-menu">Задания на проверке</a>
                <?php
                    }
                ?>
            </div>
            
        </div>
        
                    
        <div class="wrap_tasks">
            <?php            
                $sql = "SELECT * FROM exercise WHERE public = '1' AND deleted = '0' ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($exercise = $result->fetch()){
                    $id_exer = $exercise['id'];
                    
                    $sql2 = "SELECT * FROM users_exercise WHERE id_exercise = $id_exer";
                    $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                    $check_user = $result2->fetch();
                    $id_user = $check_user['id_user'];
                    // echo $qwe.'_';
                    // echo $user_id;
                    // echo $id_ex;
                    // echo $id_exer.' - id_exer; <br>';
                    // echo $id_user.' - id_user; <br>';
                    // echo $user_id.' - user_id; <br><br>';
                    
                    if($id_user == $user_id){
                    
                        
                    }else{
            ?>
                        <div class="task">
                            
                            <div class="task_item">
                                <div class="task_name">
                                    <? echo $exercise['name']?><br>
                                </div>
                                <div class="time_view">
                                    <div class="time"><? echo $exercise['time']?> мин</div>
                                </div>
                            </div>
                            <div class="point_start">
                                <div class="point"><? echo $exercise['points']?>&nbsp;Б</div>
                                <a href="?page=unique_exercise&id=<? echo $exercise['id']?>" class="start">Приступить</a>
                            </div>
                        </div>
            <?php
                        
                    }
                } 
            ?>
            
            <!-- <div class="task">
                <div>
                    <div class="task_name">
                        Наименование задания
                    </div>
                    <div class="time_view">
                        <div class="view">
                            776
                            <img src="img/icon-v.svg" alt="">
                        </div>
                        <div class="time">5 мин</div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point">4Б</div>
                    <a href="?page=unique_exercise" class="start">Приступить</a>
                </div>
            </div>   -->
        </div>
    </div>
</section>
1.16	footer.php
<footer class="footer"> 
    <div class="container">
        <nav class="nav3">
            <div>
                <a href="?">
                    <img class="logo-img" src="img/logo.svg" alt="">
                </a>
            </div>
            <div class="links"> 
                <a target="_blanck"  href="https://vk.com/club193817950" class="link1">
                    <img src="img/vk.png" alt="">
                </a>
                <a target="_blanck" href="https://t.me/joinchat/Q7LLCrt5ENJMYnlR" class="link2">
                    <img src="img/telegramm.png" alt="">
                </a>
            </div>
            <div class="empty-div"></div>
        </nav>
    </div>
</footer>
1.17	header.php
<header class="header"> 
    <div class="container">
        <div class="wrap_menu_window">
            <div id="menu_window" class="menu_window">
                <div class="flex_wrap">
                    <a href="" class="close">
                        <img src="img/burger2.svg" alt="">
                    </a>
                </div>
                <div class="flex_wrap">
                    <a class="user2" href="?">
                        <img class="user-img" src="img/user2.svg" alt="">
                        <?php echo $user_fio;?>
                    </a>
                </div>
                <div class="flex_wrap">
                    <a class="points2" href="?page=transactions">
                        <img class="points-img2" src="img/wallet2.svg" alt="">
                        <?php
                            $sql = "SELECT SUM(balanse) AS balanse FROM transactions WHERE id_user = $user_id AND (type = 1 OR type = 2)";
                            $result = $link->query($sql, PDO::FETCH_ASSOC);
                            $points = $result->fetch();
                            $balanse_1 = $points['balanse'];
                            if($balanse_1 == 0){
                                $balanse_1 = 0;
                            }
                            $sql = "SELECT SUM(balanse) AS balanse FROM transactions WHERE id_user = $user_id AND type = 3";
                            $result = $link->query($sql, PDO::FETCH_ASSOC);
                            $points = $result->fetch();
                            $balanse_2 = $points['balanse'];
                            if($balanse_2 == 0){
                                $balanse_2 = 0;
                            }
                            
                            $balanse = $balanse_1 - $balanse_2;
                            echo $balanse.' баллов';
                        ?>
                    </a>
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="https://club.z-go.ru/?p=profile">В клуб</a>
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=store">Товары</a> 
                </div>
                
                <div class="flex_wrap">
                    <a class="to_club2" class="nav2_item" href="?page=exercises">Задания</a>
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=cliques">Клики</a>
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=check_tasks">Проверка заданий</a>
                </div>
                <div class="flex_wrap">
                    
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=admin_cliques">Admin клик</a>  
                </div>    
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=admin_cliques">Admin </a>  
                </div>          
            </div>
        </div>
        <nav class="nav">
            <div>
                <a href="?">
                    <img class="logo-img" src="img/logo.svg" alt="">
                </a>
            </div>
            <div><a class="to_club" href="https://club.z-go.ru/?p=profile">В клуб</a></div>
            <div><a class="to_club" href="?page=store">Товары</a> </div>
            
            <div class="right_nav">
                <div class="points">
                    <a class="points" href="?page=transactions">
                        <img class="points-img" src="img/wallet.svg" alt="">
                        <?php
                            $sql = "SELECT SUM(balanse) AS balanse FROM transactions WHERE id_user = $user_id AND (type = 1 OR type = 2)";
                            $result = $link->query($sql, PDO::FETCH_ASSOC);
                            $points = $result->fetch();
                            $balanse_1 = $points['balanse'];
                            if($balanse_1 == 0){
                                $balanse_1 = 0;
                            }
                            $sql = "SELECT SUM(balanse) AS balanse FROM transactions WHERE id_user = $user_id AND type = 3";
                            $result = $link->query($sql, PDO::FETCH_ASSOC);
                            $points = $result->fetch();
                            $balanse_2 = $points['balanse'];
                            if($balanse_2 == 0){
                                $balanse_2 = 0;
                            }
                            
                            $balanse = $balanse_1 - $balanse_2;
                            echo $balanse.' баллов';
                        ?>
                    </a>
                </div>
                <div class="user" href="?">
                    <img class="user-img" src="img/user.svg" alt="">
                    <?php echo $user_fio;?>
                </div>
            </div>
            <a href="#menu_window" class="menu-burger">
                <img src="img/burger.svg" alt="">
            </a>
        </nav>
    </div>
</header>

1.18	nav2.php

<?php
    if($user_level == 5){
?>
    <section class="nav_section">
        <div class="container">
            <nav class="nav2">
                <!-- <a href="?page=quests">Квесты</a> -->
                <a class="nav2_item" href="?page=exercises">Задания</a>
                <a href="?page=cliques">Клики</a>
            </nav>
        </div>
        <div class="container">
            <nav class="nav2">
                <!-- <a href="?page=check_tasks">Проверка заданий</a>
                <a href="?page=checked_task">Задания на проверке</a> -->
                <!-- <a href="?page=admin_quests">Admin квест</a> -->
                <!-- <a href="?page=admin_exercise">Admin задания</a>
                <a href="?page=admin_cliques">Admin клик</a>             -->
                <!-- <a href="?page=add_exercise">Добавление задания</a> -->
            </nav>
            
        </div>
    </section>
<?php
    }else{
        if($user_level < 5){    
?>
    <section class="nav_section">
        <div class="container">
            <nav class="nav2">
                <!-- <a href="?page=quests">Квесты</a> -->                
                <!-- <a href="?page=checked_task">Задания на проверке</a> -->
                <a href="?page=exercises">Задания</a>
                <a href="?page=cliques">Клики</a>
            </nav>
        </div>
    </section>
<?  
        } 
    }
?>
1.19	orders_view.php
<?php
    if(isset($_GET['id'])){
        $get_id = $_GET['id'];
?>
<section class="section_store">
    <div class="container">
        <div class="wrap_store">
            <?php            
                $sql = "SELECT * FROM tovar WHERE id = $get_id";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                $tovar = $result->fetch()
            ?>                
            <div class="product">
                <div class="product_item">
                    <div class="product_name">
                        <? echo $tovar['name']?>
                    </div>
                    <div class="product_img">
                        <img src="<? echo $tovar['img']?>" alt="">                            
                    </div>
                </div>
                <div class="point_start point_store">
                    <div class="point"><? echo $tovar['points']?> Б</div>   
                </div>
            </div>
        </div>
    </div>
</section>
<?}?>
1.20	orders.php
<?php if($user_level < 5){?>
<?php
    if(isset($_GET['accept_id'])){
        $accept_id = $_GET['accept_id'];
        $link->query("UPDATE users_tovar SET status = '3' WHERE id_tovar = $accept_id");
        echo '<script>document.location.href="?page=orders"</script>';  
    }
?>
<section class="section_tasks">
    <div class="container">
        <div class="h1_add">
            <h1 class="h1_task_admin">Заказы</h1>
        </div>
        <div class="wrap_tasks">
            <?php                
                $sql = "SELECT * FROM users_tovar WHERE id_user = $user_id ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($users_tovar = $result->fetch()){
                    $id_tovar = $users_tovar['id_tovar'];
                    $id_user = $users_tovar['id_user'];
                    $tov_status = $users_tovar['status'];
                    $tov_status2 = $users_tovar['status'];
                    $tov_date = $users_tovar['date'];
                    $sql2 = "SELECT * FROM tovar WHERE id=$id_tovar";
                    $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                    $tovar = $result2->fetch();
            ?>            
                <div class="product">
                    <div class="product_item">
                        <div class="product_name">
                            <?php echo $tovar['name']; ?>
                        </div>
                        <div class="product_img">
                            
                            <img src="<? echo $tovar['img']?>" alt="">                            
                        </div>
                    </div>
                    <div class="point_start point_store">
                        <div class="point"><? echo $tovar['points']?> Б</div>
                    </div>
                    <div class="order_status order_status2">
                        <?php 
                            if($tov_status == 1){
                                $tov_status = '<div class="order_status_item yellow">Ожидает отправки</div>';
                            }elseif($tov_status == 2){
                                $tov_status = '<div class="order_status_item yellow2">Товар отправлен</div>';
                            }elseif($tov_status == 3){
                                $tov_status = '<div class="order_status_item green">Товар получен</div>';
                            }else{
                                echo "erorr";
                            }
                            echo $tov_status;
                        ?>
                    </div>
                    <?php 
                        if($tov_status2 == 2){
                    ?>
                        <div class="order_bottom_btn">
                            <a href="?page=admin_orders&accept_id=<?echo $id_tovar?>" class="order_bottom_btn">Товар получен</a>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            <?
                } 
            ?>        
        </div>
    </div>
</section>
<?
}?>

1.21	store.php
<?php
    if(isset($_GET['buy'])){
        $buy_id = $_GET['buy'];
        $sql = "SELECT SUM(balanse) AS balanse FROM transactions WHERE id_user = $user_id AND (type = 1 OR type = 2)";
        $result = $link->query($sql, PDO::FETCH_ASSOC);
        $points = $result->fetch();
        $balanse_1 = $points['balanse'];
        if($balanse_1 == 0){
            $balanse_1 = 0;
        }
        $sql = "SELECT SUM(balanse) AS balanse FROM transactions WHERE id_user = $user_id AND type = 3";
        $result = $link->query($sql, PDO::FETCH_ASSOC);
        $points = $result->fetch();
        $balanse_2 = $points['balanse'];
        if($balanse_2 == 0){
            $balanse_2 = 0;
        }
        // наш баланс
        $balanse = $balanse_1 - $balanse_2;
        $sql = "SELECT * FROM tovar WHERE id=$buy_id";
        $result = $link->query($sql, PDO::FETCH_ASSOC);
        $tov_tr = $result->fetch();
        $tov_points = $tov_tr['points'];
        if($tov_points <= $balanse){
            $date = time();
            // Добавление в юзер_товар
            $link->query("INSERT INTO users_tovar (id_tovar, id_user, status, date) 
            VALUES ('$buy_id','$user_id', '1', '$date')");
            // обнавление товара (убирает показ)
            $link->query("UPDATE tovar SET deleted='1'WHERE id=$buy_id");
            // Добавление транзакции
            // поле type в таблице transactions
            // 1 клик
            // 2 задание
            // 3 товар
            $link->query("INSERT INTO transactions (type, id_name, id_user, date, balanse) 
            VALUES ('3','$buy_id','$user_id', '$date', '$tov_points')");
            
            echo '<script>document.location.href="?page=store"</script>';
        }else{
            echo "<script>
                    alert('Недостаточно баллов')
                </script>";
        }
        
        
    }
    
    
    if(isset($_GET['delete'])){
        if($user_level == 5){
            $del_tov = $_GET['delete'];
            $link->query("UPDATE tovar SET deleted='1' WHERE id=$del_tov");
            echo '<script>document.location.href="?page=store"</script>';  
        }
    } 
?>
<section class="section_store">
    <div class="container">
        <h1 class="h1_exercises">
            Товары
        </h1>
        
        <?php
            if($user_level == 5){
        ?>
            <div class="h1_add">
                <a class="add" href="?page=add_tovar">
                    Добавить товар
                    <img src="img/plus.svg" alt="">
                </a>
            </div>
        <?}?>
        <div class="menu">
            <div class="btn-menu-flex"> 
                <?php
                    if($user_level == 5){
                ?>
                        <a href="?page=admin_orders" class="btn-menu">Заказы</a>
                <?php 
                    }elseif($user_level < 5){
                ?>
                        <a href="?page=orders" class="btn-menu">Заказы</a>
                <?php
                    }
                ?>
            </div>
        </div>
    
        <!-- <h1 class="h1_exercises">Товары</h1> -->
        <div class="wrap_store">
            <?php            
                $sql = "SELECT * FROM tovar WHERE deleted='0' ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($tovar = $result->fetch()){
                $tovar_id = $tovar['id'];
            ?>                
                <div class="product">
                    <div class="product_item">
                        <div class="product_name">
                            <? echo $tovar['name']?>
                        </div>
                        <div class="product_img">
                            <img src="<? echo $tovar['img']?>" alt="">                            
                        </div>
                    </div>
                    <div class="point_start point_store">
                        <div class="point"><? echo $tovar['points']?> Б</div>
                        <a href="?page=store&buy=<?php echo $tovar_id?>" class="start">Купить</a>
                    </div>
                    <?php if($user_level == 5){?>
                    <div class="point_start_del">
                        <a href="?page=store&delete=<?php echo $tovar_id ?>" class="delete">Удалить</a>
                    </div>
                    <? } ?>
                        
                    
                </div>
            <?
                } 
            ?>      
        
            <!-- <div class="product">
                <div>
                    <div class="product_name">
                        Наименование задания
                    </div>
                    <div class="product_img">
                        img
                    </div>
                </div>
                <div class="point_start">
                    <div class="point">4 Б</div>
                    <a href="?page=unique_exercise" class="start">Купить</a>
                </div>
            </div> -->
        </div>
    </div>
</section>
1.22	transactions.php
<section class="section_transactions">
    <div class="container">
        <h1 class="h1_exercises">Транзакции</h1>
        <div class="wrap_transactions">
            <div class="transactions tr_header">
                <div class="transaction_item tr_item_name">
                    <div class="transactions_name">
                        Наименование
                    </div>
                </div>
                <div class="transaction_item tr_item_date">
                    <div class="transactions_date">
                        Дата
                    </div>
                </div>
                <div class="transaction_item tr_item_points">
                    <div class="transactions_points">
                        Баллы
                    </div>
                </div>
                <!-- <div class="transactions_name">
                    Наименование задания
                </div> -->
            </div> 
            
            <!-- php code -->
            <?php            
                $sql = "SELECT * FROM transactions WHERE id_user = $user_id ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($transactions = $result->fetch()){
                    $tr_type = $transactions['type'];
                    $tr_name = $transactions['id_name'];
                    $tr_date = $transactions['date'];
                    $tr_date1 = date('d.m.Y', $tr_date);
                    $tr_date2 = date('H:i', $tr_date);
                    // поле type в таблице transactions
                    // 1 клик
                    // 2 задание
                    // 3 товар
                    if($tr_type == 1){
                        $sql2 = "SELECT * FROM clique WHERE id = $tr_name";
                        $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                        $clique = $result2->fetch();
                        $tr_points = $clique['points'];
                        $tr_name  = $clique['name'];
                    }elseif($tr_type == 2){
                        $sql3 = "SELECT * FROM exercise WHERE id = $tr_name";
                        $result3 = $link->query($sql3, PDO::FETCH_ASSOC);
                        $exercise = $result3->fetch();
                        $tr_points = $exercise['points'];
                        $tr_name  = $exercise['name'];
                    }elseif($tr_type == 3){
                        $sql4 = "SELECT * FROM tovar WHERE id = $tr_name";
                        $result4 = $link->query($sql4, PDO::FETCH_ASSOC);
                        $tovar = $result4->fetch();
                        $tr_points = $tovar['points'];
                        $tr_name  = $tovar['name'];
                    }else{
                        $tr_points = 'error transactions.php';
                    }
                    if($tr_type == 1){
                        $transaction_type = '<div class="green">+ '.$tr_points.'</div>';
                    }elseif($tr_type == 2){
                        $transaction_type = '<div class="green">+ '.$tr_points.'</div>';
                    }elseif($tr_type == 3){
                        $transaction_type = '<div class="red">- '.$tr_points.'</div>';
                    }else{
                        $transaction_type = 'error';
                    }
                
                // $sql = "SELECT * FROM users_exercise WHERE id_exercise=$id_exer";
                // $result = $link->query($sql, PDO::FETCH_ASSOC);
                // $check_user = $result->fetch();
                // $id_user = $check_user['id_user'];
                
            ?>                
                <div class="transactions">
                    <div class="transaction_item tr_item_name">
                        <div class="transactions_name tr_size">
                            <? echo $tr_name?>
                        </div>
                    </div>
                    <div class="transaction_item tr_item_date">
                        <div class="transactions_date tr_size">
                            <? echo $tr_date1?><br>
                            <? echo $tr_date2?>
                        </div>
                    </div>
                    <div class="transaction_item tr_item_points">
                        <div class="transactions_points tr_size ">
                            <? echo $transaction_type ?>
                        </div>
                    </div>
                </div>  
            <? 
                } 
            ?>
            <!-- <div class="transactions">
                <div class="transactions_name">
                    Наименование
                </div>
                <div class="transactions_date">
                    11.11.1111
                </div>
                <div class="transactions_points">
                    + 47
                </div>
                <div class="transactions_name">
                    Наименование задания
                </div>
            </div> -->
        </div>
    </div>
</section>

1.23	unique_exercise.php
<?php
    if(isset($_GET['id'])){
    $get_id = $_GET['id'];
    $sql = "SELECT * FROM exercise WHERE id=$get_id";
    $result = $link->query($sql, PDO::FETCH_ASSOC);
    $exercise = $result->fetch()
?>
<?php
    if(isset($_POST['exercise_report'])){
        $report_link = $_POST['report_link'];
        $screenshot = 0;
         // screenshot
         $file_name=$_FILES['img']['name'];
        //  echo $file_name;
        $screenshot='img/exercise/report/'.time().$_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], $screenshot);
        // echo $report_link;
        // echo $screenshot;
        if($report_link == NULL){
            $error = 'Пустое поле';
        }else{
            $link->query("INSERT INTO users_exercise (id_exercise, id_user, screenshot, link, status) 
            VALUES ('$get_id','$user_id','$screenshot', '$report_link', '1')");
            echo '<script>document.location.href="?"</script>';
        } 
    }
?>
<section class="section_unique_exercise">
    <div class="container">
        <div class="unique_exercise">
            <div class="exercise_name_wrap">
                <h2 class="exercise_name"><?echo $exercise['name']?></h2>
                <!-- <p class="exercise_description">Описание описание описание описание описание описание описание описание описание описание </p> -->
                <div class="time_view">
                    <div class="time"><?echo $exercise['time']?> мин</div>
                    <div>
                        <div class="point_unique_quest"><?echo $exercise['points']?>&nbsp;Б</div>
                    </div>
                </div>
            </div>
            <p class="exercise_text">
                <?echo $exercise['description']?>
            </p>
            <div class="wrap_exercise">
                <img src="<?echo $exercise['screenshot']?>" alt="">
                
                
                    <div class="exercise_report">
                        <h3 class="report_h3">
                            Отчет задания
                        </h3>
                        <form class="exercise_form" method="POST" name="exercise_report" enctype="multipart/form-data"> 
                            <div class="wrap_add_scrin">
                                <div class="add_scrin">
                                    Вставьте скриншот
                                    <img src="img/add-img.svg" alt="">
                                </div>
                                <input type="file" class="input_file" name="img">
                            </div>
                            <div class="wrap_input_url">
                                <div class="inp_url_name">Ссылка(url)</div>
                                <input type="url" class="input_url" name="report_link">
                            </div>
                            <div class="report_error"> <?php echo $error ?> </div>
                                <input type="submit" class="finish_exercise" name="exercise_report" value="Отправить">
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>
<?
    }
?>
