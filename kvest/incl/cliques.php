<section class="section_tasks">
    <div class="container">
        <div class="menu">
            <div>
                <h1 class="h1_cliques">Клики</h1>  
                <p class="p-description">Для прохождения клика, необходимо не закрывать сайт в течении нескольких секунд</p>
            </div>
            <div class="btn-menu-flex"> 
                <?php
                    if($user_level == 5){
                ?>
                        <a href="?page=admin_cliques" class="btn-menu">Admin клик</a>
                <?php 
                    }
                ?>
            </div>
           
        </div>
        
        
        <div class="wrap_tasks">
            
            <?php            
                function getIp() {
                  $keys = [
                    'HTTP_CLIENT_IP',
                    'HTTP_X_FORWARDED_FOR',
                    'REMOTE_ADDR'
                  ];
                  foreach ($keys as $key) {
                    if (!empty($_SERVER[$key])) {
                      $ip = trim(end(explode(',', $_SERVER[$key])));
                      if (filter_var($ip, FILTER_VALIDATE_IP)) {
                        return $ip;
                      }
                    }
                  }
                }
                
                $user_ip = getIp();
                // выведем IP клиента на экран
                // echo 'ip = ' . $user_ip;            
            
                if(isset($_GET['click'])){
                    $token = $_GET['click'];
                    
                    $sql = "SELECT * FROM users_clique WHERE token='$token'";
                    $result = $link->query($sql, PDO::FETCH_ASSOC);
                    $id_clique = $result->fetch();
                    $clique_id = $id_clique['id_clique'];

                    $sql = "SELECT * FROM clique WHERE id='$clique_id'";
                    $result = $link->query($sql, PDO::FETCH_ASSOC);
                    $points_clique = $result->fetch();
                    $clique_points = $points_clique['points'];

                    // Добавление транзакции
                    // поле type в таблице transactions
                    // 1 клик
                    // 2 задание
                    // 3 товар
                    $date = time();
                    $link->query("INSERT INTO transactions (type, id_name, id_user, date, balanse) 
                    VALUES ('1','$clique_id','$user_id', '$date', '$clique_points')");

                    $link->query("UPDATE users_clique SET status='1' WHERE token='$token'");
                    $link->query("UPDATE users_clique SET token='0' WHERE token='$token'");
                   
                    
                    
                    echo '<script>document.location.href="?page=cliques"</script>';
                }
            
                if(isset($_POST['click'])){
                    $click_id = $_POST['click_id'];
                    $sql = "SELECT * FROM clique WHERE id = $click_id";
                    $result = $link -> query($sql, PDO::FETCH_ASSOC);
                    $click = $result -> fetch();
                    $now = time();
                    //создается рандомный зашифрованный код
                        $rand = rand(111111, 999999);
                        $token = md5($rand);
                    // echo $token;
                    // сохдается запись, что пользователь нажал на кнопку. там будет временный токен
                    $sql = "INSERT INTO users_clique (id_clique, id_user, date, ip, token, status) 
                        VALUES ('$click_id','$user_id','$now','$user_ip','$token','0')";
                    $link -> query($sql);
                    echo '<script>document.location.href="'.$click['link'].'?click='.$token.'"</script>';
                }
                //выбираем клики, которые предназначены на этот день
                
                // определяем реальное время
                
                // определяем начало сегодняшнего дня 00:00
                $today=strtotime(date("d-m-Y"));
                // определяем конец сегодняшнего дня 24:59
                $tomorrow=$today+86400;
                // echo $tomorrow;
                // убрал с запроса sql AND date >= $today AND date < $tomorrow для диплома

            
                $sql = "SELECT * FROM clique WHERE public='1' AND deleted='0'  ORDER BY id DESC";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                while($clique = $result->fetch()){
                    $click_id = $clique['id'];

                    // нужно сркыть пройденные клики
                    $sql2="SELECT * FROM users_clique WHERE id_user = '$user_id' AND id_clique = '$click_id'";
                    $result2=$link->query($sql2, PDO::FETCH_ASSOC);
                    $num=$result2->fetch();
                    // echo $num;
                    if($num == 0){
                        // нужно вывести с ошибкой, если уже использовался данный  ip
                        $sql3="SELECT * FROM users_clique WHERE ip = '$user_ip' AND id_clique = '$click_id'";
                        $result3=$link->query($sql3, PDO::FETCH_ASSOC);
                        $num=$result3->fetch();
                        if($num==0){
                        ?>
                            <div class="task">
                                <div class="task_item">
                                    <div class="task_name">
                                        <?php echo $clique['name']?> 
                                    </div>
                                    <div class="time_view">
                                        <div class="time"><?php echo $clique['time']?> сек</div>
                                    </div>
                                </div>
                                <div class="point_start">
                                    <div class="point"><?php echo $clique['points']?>&nbsp;Б</div>
                                    
                                    <!-- <button name="click" class="start">Перейти</button> -->
                                    <form method="POST" name="click">
                                        <input type="hidden" name="click_id" value="<?php echo $clique['id']?>">
                                        <input type="submit" class="start" name="click" value="Перейти">
                                    </form>                        
                                </div>
                            </div>

                        <?php
                        }else{
                            echo'
                            <div class="task">
                                <div class="task_item">
                                    <div class="task_name">
                                        '.$clique['name'].' 
                                    </div>
                                    <div class="time_view">
                                        <div class="time">'.$clique['time'].'сек</div>
                                    </div>
                                </div>
                                <div class="point_start">
                                    <div class="point">'.$clique['points'].'&nbsp;Б</div>
                                    
                                    <!-- <button name="click" class="start">Перейти</button> -->
                                    <form>
                                        <input type="hidden" value="">
                                        
                                    </form>                        
                                </div>
                                
                                <div style="max-width: 130px; margin: 10px 0px;" >                                    	
                                    <button disabled style="color:black; padding:5px;"> Нажмите с другого устройства</button>
                                </div>
                            </div>
                            ';
                          
                        }
                    }else{
                        // echo 'Вы не дождались';
                    }

                // $sql2 = "SELECT * FROM clique WHERE date >= $today AND date < $tomorrow";
                // $result2 = $link -> query($sql2, PDO::FETCH_ASSOC);
                // while($click = $result2 -> fetch()){
                //     $click_id = $click['id'];
                //     // нужно сркыть пройденные клики
                //     $query1="SELECT * FROM users_clique WHERE id_user = '$user_id' AND id_clique = '$click_id'";
                //     $result1=$link->query($query1);
                //     $num=$result1->num_rows;
                //     if($num==0)
                //     {
                //         // нужно вывести с ошибкой, если уже использовался данный  ip
                //         $query1="SELECT * FROM users_clique WHERE ip = '$user_ip' AND id_click = '$click_id'";
                //         $result1=$link->query($query1);
                //         $num=$result1->num_rows;
                //         if($num==0)
                //         {
                //             echo'<br>
                //                 <form method="POST" name="click">
                //                     <input type="hidden" name="click_id" value="'.$click['id'].'">
                //                     <input type="submit" name="click" value="'.$click['text'].'">
                //                 </form>
                //             ';
                //         }else{
                //             echo'<br>
                //                 <style>
                //                     .no_button{
                //                         background:orange;
                //                     }
                //                     .no_button:hover{
                //                         cursor: not-allowed
                //                     }
                //                 </style>
                //                 <input class="no_button" type="submit" value="'.$click['text'].'">
                //                 (можете нажать с другого устройства)
                //             ';
                //         }                        
                //     }
                //     // нужно вывести с ошибкой мол не дождался окончания времени                    
                // }
                ?>
            <!-- <form name="click" method="POST"> -->
                
            <!-- </form> -->
            

            <?php
            }
            ?>



            <!-- <div class="task">
                <div>
                    <div class="task_name">
                        Название сайта 
                    </div>
                    <div class="time_view">
                        <div class="time">20 сек</div>
                    </div>
                </div>
                <div class="point_start">
                    <div class="point">1Б</div>
                    <a href="?" class="start">Перейти</a>
                </div>
            </div> -->
        </div>
    </div>
</section>