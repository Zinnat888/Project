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