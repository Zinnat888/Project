<?php if($user_level == 5){?>
<section class="section_tasks">
    <div class="container">
        <h1 class="h1_task_admin">Клики</h1>
        <div class="h1_add">
        <a class="add" href="?page=add_clique">
            Добавить клик
            <img src="img/plus.svg" alt="">
        </a>
        </div>
        <div class="wrap_tasks">            
            <?php                
                $sql = "SELECT * FROM clique WHERE deleted='0' ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($clique = $result->fetch()){
            ?>
            <div class="task admin_task">
                <div class="task_left">
                    <div class="task_name">
                        <?php echo $clique['name']?> 
                    </div>
                    <div class="time_view">
                        <div class="view">
                            <?php echo $clique['time']?> сек
                            <img src="img/icon-v.svg" alt="">
                        </div>
                        <div>
                            <div class="point_admin2">1Б</div>
                        </div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point_admin"><?php echo $clique['points']?>&nbsp;Б</div>
                    <a href="<?php echo $clique['link']?>" class="more">Перейти</a>
                    <a href="?page=edit_clique&id=<?php echo $clique['id'] ?>" class="cliques-edit">
                        <img src="img/icon-edit.png" alt="">
                    </a>
                </div>
            </div>
            <?php
                }
            ?>
            <!-- <div class="task admin_task">
                <div>
                    <div class="task_name">
                        Название сайта
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
                    <a href="?" class="cliques-edit"><img src="img/icon-edit.png" alt=""></a>
                </div>
            </div> -->
        </div>
        
        <!-- <div class="pagination_wrap">
            <div class="wrap_help">
                <a href="?" class="btn-pagin1">Назад</a>
            </div>
            <div class="pagination_only">
                <a href="?" class="btn-pagin2 pagin_this">1</a>
                <a href="?" class="btn-pagin2">2</a>
                <a href="?" class="btn-pagin2">3</a>
                <a href="?" class="btn-pagin2">4</a>
                <a href="?" class="btn-pagin2">155</a>
            </div>
            <div class="wrap_help">
                <a href="?" class="btn-pagin1">Вперед</a>
            </div>
        </div> -->
    </div>
</section>
<?}?>