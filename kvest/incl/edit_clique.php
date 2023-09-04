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