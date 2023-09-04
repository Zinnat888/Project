<section class="section_transactions">
    <div class="container">
        <h1 class="h1_exercises">Транзакции</h1>
        <div class="wrap_transactions">
            <div class="transactions tr_header">
                <div class="transaction_item tr_item_name">
                    <div class="transactions_name">
                        Наименование
                    </div>
                </div>
                <div class="transaction_item tr_item_date">
                    <div class="transactions_date">
                        Дата
                    </div>
                </div>
                <div class="transaction_item tr_item_points">
                    <div class="transactions_points">
                        Баллы
                    </div>
                </div>
                <!-- <div class="transactions_name">
                    Наименование задания
                </div> -->
            </div> 
            
            <!-- php code -->
            <?php            
                $sql = "SELECT * FROM transactions WHERE id_user = $user_id ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($transactions = $result->fetch()){
                    $tr_type = $transactions['type'];
                    $tr_name = $transactions['id_name'];
                    $tr_date = $transactions['date'];
                    $tr_date1 = date('d.m.Y', $tr_date);
                    $tr_date2 = date('H:i', $tr_date);
                    // поле type в таблице transactions
                    // 1 клик
                    // 2 задание
                    // 3 товар
                    if($tr_type == 1){
                        $sql2 = "SELECT * FROM clique WHERE id = $tr_name";
                        $result2 = $link->query($sql2, PDO::FETCH_ASSOC);
                        $clique = $result2->fetch();
                        $tr_points = $clique['points'];
                        $tr_name  = $clique['name'];
                    }elseif($tr_type == 2){
                        $sql3 = "SELECT * FROM exercise WHERE id = $tr_name";
                        $result3 = $link->query($sql3, PDO::FETCH_ASSOC);
                        $exercise = $result3->fetch();
                        $tr_points = $exercise['points'];
                        $tr_name  = $exercise['name'];
                    }elseif($tr_type == 3){
                        $sql4 = "SELECT * FROM tovar WHERE id = $tr_name";
                        $result4 = $link->query($sql4, PDO::FETCH_ASSOC);
                        $tovar = $result4->fetch();
                        $tr_points = $tovar['points'];
                        $tr_name  = $tovar['name'];
                    }else{
                        $tr_points = 'error transactions.php';
                    }

                    if($tr_type == 1){
                        $transaction_type = '<div class="green">+ '.$tr_points.'</div>';
                    }elseif($tr_type == 2){
                        $transaction_type = '<div class="green">+ '.$tr_points.'</div>';
                    }elseif($tr_type == 3){
                        $transaction_type = '<div class="red">- '.$tr_points.'</div>';
                    }else{
                        $transaction_type = 'error';
                    }
                
                // $sql = "SELECT * FROM users_exercise WHERE id_exercise=$id_exer";
                // $result = $link->query($sql, PDO::FETCH_ASSOC);
                // $check_user = $result->fetch();
                // $id_user = $check_user['id_user'];
                
            ?>                
                <div class="transactions">
                    <div class="transaction_item tr_item_name">
                        <div class="transactions_name tr_size">
                            <? echo $tr_name?>
                        </div>
                    </div>
                    <div class="transaction_item tr_item_date">
                        <div class="transactions_date tr_size">
                            <? echo $tr_date1?><br>
                            <? echo $tr_date2?>
                        </div>
                    </div>
                    <div class="transaction_item tr_item_points">
                        <div class="transactions_points tr_size ">
                            <? echo $transaction_type ?>
                        </div>
                    </div>
                </div>  
            <? 
                } 
            ?>

            <!-- <div class="transactions">
                <div class="transactions_name">
                    Наименование
                </div>
                <div class="transactions_date">
                    11.11.1111
                </div>
                <div class="transactions_points">
                    + 47
                </div>
                <div class="transactions_name">
                    Наименование задания
                </div>
            </div> -->
        </div>
    </div>
</section>
