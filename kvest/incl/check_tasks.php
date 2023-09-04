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