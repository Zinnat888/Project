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