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