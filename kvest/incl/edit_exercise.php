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