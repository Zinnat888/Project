<?php if($user_level == 5){?>
<?php
    if(isset($_GET['accept_id'])){
        $accept_id = $_GET['accept_id'];
        $link->query("UPDATE users_tovar SET status = '2' WHERE id_tovar = $accept_id");
        echo '<script>document.location.href="?page=admin_orders"</script>';  
    }
?>
<section class="section_tasks">
    <div class="container">
        <div class="h1_add">
            <h1 class="h1_task_admin">Заказы</h1>
        </div>
        <div class="wrap_tasks">
            <?php                
                $sql = "SELECT * FROM users_tovar ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($users_tovar = $result->fetch()){
                    $id_tovar = $users_tovar['id_tovar'];
                    $id_user = $users_tovar['id_user'];
                    $tov_status = $users_tovar['status'];
                    $tov_status2 = $users_tovar['status'];
                    $tov_date = $users_tovar['date'];
            ?>
                <div class="order_item">
                    <div class="order_name">
                        <?php
                            $sql2 = "SELECT * FROM tovar WHERE id=$id_tovar";
                            $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                            $tovar = $result2->fetch();
                            echo $tovar['name'];
                            $tov_points = $tovar['points'];
                        ?>
                    </div>
                    <div class="order_data">
                        <div class="order_contacts">
                            <?php
                                $sql3 = "SELECT * FROM users WHERE id=$id_user";
                                $result3 = $link->query($sql3, PDO::FETCH_ASSOC);
                                $user_name = $result3->fetch();
                            ?>
                            <p>ФИО:  <? echo $user_name['fio']; ?></p>
                            <p>Почта:  <? echo $user_name['mail']; ?></p>
                            <p>Телефон:  <? echo $user_name['phone']; ?></p>
                        </div>
                        <div class="order_status">
                            <?php 
                                if($tov_status == 1){
                                    $tov_status = '<div class="order_status_item yellow">Ожидает отправки</div>';
                                }elseif($tov_status == 2){
                                    $tov_status = '<div class="order_status_item yellow2">Товар отправлен</div>';
                                }elseif($tov_status == 3){
                                    $tov_status = '<div class="order_status_item green">Товар получен</div>';
                                }else{
                                    echo "erorr";
                                }
                                echo $tov_status;
                            ?>
                            
                        </div>
                    </div>
                    <div class="order_bottom">
                        <div class="order_bottom_left">
                            <div class="order_view">
                                <a class="view_exercise" href="?page=orders_view&id=<?echo $id_tovar?>"> Просмотр </a>
                            </div>
                            <div class="order_points">
                                <?php echo $tov_points.' Б'; ?>
                            </div>
                        </div>
                        <div class="order_bottom_right">
                            
                            <?php 
                                if($tov_status2 == 1){
                            ?>
                                <div class="order_bottom_btn">
                                    <a href="?page=admin_orders&accept_id=<?echo $id_tovar?>" class="order_bottom_btn">Товар отправлен</a>
                                </div>
                            <?php
                                }
                            ?>  
                               
                        </div>
                    </div>
                </div>
            <?
                }
            ?>            
        </div>
    </div>
</section>
<?}?>

