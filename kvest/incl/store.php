<?php
    if(isset($_GET['buy'])){
        $buy_id = $_GET['buy'];

        $sql = "SELECT SUM(balanse) AS balanse FROM transactions WHERE id_user = $user_id AND (type = 1 OR type = 2)";
        $result = $link->query($sql, PDO::FETCH_ASSOC);
        $points = $result->fetch();
        $balanse_1 = $points['balanse'];
        if($balanse_1 == 0){
            $balanse_1 = 0;
        }

        $sql = "SELECT SUM(balanse) AS balanse FROM transactions WHERE id_user = $user_id AND type = 3";
        $result = $link->query($sql, PDO::FETCH_ASSOC);
        $points = $result->fetch();
        $balanse_2 = $points['balanse'];
        if($balanse_2 == 0){
            $balanse_2 = 0;
        }
        // наш баланс
        $balanse = $balanse_1 - $balanse_2;

        $sql = "SELECT * FROM tovar WHERE id=$buy_id";
        $result = $link->query($sql, PDO::FETCH_ASSOC);
        $tov_tr = $result->fetch();
        $tov_points = $tov_tr['points'];

        if($tov_points <= $balanse){
            $date = time();

            // Добавление в юзер_товар
            $link->query("INSERT INTO users_tovar (id_tovar, id_user, status, date) 
            VALUES ('$buy_id','$user_id', '1', '$date')");

            // обнавление товара (убирает показ)
            $link->query("UPDATE tovar SET deleted='1'WHERE id=$buy_id");

            // Добавление транзакции
            // поле type в таблице transactions
            // 1 клик
            // 2 задание
            // 3 товар
            $link->query("INSERT INTO transactions (type, id_name, id_user, date, balanse) 
            VALUES ('3','$buy_id','$user_id', '$date', '$tov_points')");

            
            echo '<script>document.location.href="?page=store"</script>';
        }else{
            echo "<script>
                    alert('Недостаточно баллов')
                </script>";
        }
        
        
    }
    
    
    if(isset($_GET['delete'])){
        if($user_level == 5){
            $del_tov = $_GET['delete'];
            $link->query("UPDATE tovar SET deleted='1' WHERE id=$del_tov");
            echo '<script>document.location.href="?page=store"</script>';  
        }
    } 
?>
<section class="section_store">
    <div class="container">
        <h1 class="h1_exercises">
            Товары
        </h1>
        
        <?php
            if($user_level == 5){
        ?>
            <div class="h1_add">
                <a class="add" href="?page=add_tovar">
                    Добавить товар
                    <img src="img/plus.svg" alt="">
                </a>
            </div>
        <?}?>
        <div class="menu">
            <div class="btn-menu-flex"> 
                <?php
                    if($user_level == 5){
                ?>
                        <a href="?page=admin_orders" class="btn-menu">Заказы</a>
                <?php 
                    }elseif($user_level < 5){
                ?>
                        <a href="?page=orders" class="btn-menu">Заказы</a>
                <?php
                    }
                ?>
            </div>
        </div>
    
        <!-- <h1 class="h1_exercises">Товары</h1> -->
        <div class="wrap_store">
            <?php            
                $sql = "SELECT * FROM tovar WHERE deleted='0' ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($tovar = $result->fetch()){
                $tovar_id = $tovar['id'];
            ?>                
                <div class="product">
                    <div class="product_item">
                        <div class="product_name">
                            <? echo $tovar['name']?>
                        </div>
                        <div class="product_img">
                            <img src="<? echo $tovar['img']?>" alt="">                            
                        </div>
                    </div>
                    <div class="point_start point_store">
                        <div class="point"><? echo $tovar['points']?> Б</div>
                        <a href="?page=store&buy=<?php echo $tovar_id?>" class="start">Купить</a>
                    </div>
                    <?php if($user_level == 5){?>
                    <div class="point_start_del">
                        <a href="?page=store&delete=<?php echo $tovar_id ?>" class="delete">Удалить</a>
                    </div>
                    <? } ?>
                        
                    
                </div>
            <?
                } 
            ?>      
        
            <!-- <div class="product">
                <div>
                    <div class="product_name">
                        Наименование задания
                    </div>
                    <div class="product_img">
                        img
                    </div>
                </div>
                <div class="point_start">
                    <div class="point">4 Б</div>
                    <a href="?page=unique_exercise" class="start">Купить</a>
                </div>
            </div> -->

        </div>
    </div>
</section>