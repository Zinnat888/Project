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