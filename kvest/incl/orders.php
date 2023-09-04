<?php if($user_level < 5){?>
<?php
    if(isset($_GET['accept_id'])){
        $accept_id = $_GET['accept_id'];
        $link->query("UPDATE users_tovar SET status = '3' WHERE id_tovar = $accept_id");
        echo '<script>document.location.href="?page=orders"</script>';  
    }
?>
<section class="section_tasks">
    <div class="container">
        <div class="h1_add">
            <h1 class="h1_task_admin">Заказы</h1>
        </div>
        <div class="wrap_tasks">
            <?php                
                $sql = "SELECT * FROM users_tovar WHERE id_user = $user_id ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($users_tovar = $result->fetch()){
                    $id_tovar = $users_tovar['id_tovar'];
                    $id_user = $users_tovar['id_user'];
                    $tov_status = $users_tovar['status'];
                    $tov_status2 = $users_tovar['status'];
                    $tov_date = $users_tovar['date'];

                    $sql2 = "SELECT * FROM tovar WHERE id=$id_tovar";
                    $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                    $tovar = $result2->fetch();
            ?>            
                <div class="product">
                    <div class="product_item">
                        <div class="product_name">
                            <?php echo $tovar['name']; ?>
                        </div>
                        <div class="product_img">
                            
                            <img src="<? echo $tovar['img']?>" alt="">                            
                        </div>
                    </div>
                    <div class="point_start point_store">
                        <div class="point"><? echo $tovar['points']?> Б</div>
                    </div>
                    <div class="order_status order_status2">
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
                    <?php 
                        if($tov_status2 == 2){
                    ?>
                        <div class="order_bottom_btn">
                            <a href="?page=orders&accept_id=<?echo $id_tovar?>" class="order_bottom_btn">Товар получен</a>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            <?
                } 
            ?>        
        </div>
    </div>
</section>
<?
}?>

