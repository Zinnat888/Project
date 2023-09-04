<?php if($user_level == 5){?>
<section class="section_tasks">
    <div class="container">
        <h1 class="h1_task_admin">Задания</h1>
        <div class="h1_add">
            <a class="add" href="?page=add_exercise">
                Добавить задание
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