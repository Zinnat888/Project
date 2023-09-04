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