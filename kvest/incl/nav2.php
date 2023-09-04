
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