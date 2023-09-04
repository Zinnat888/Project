<header class="header"> 
    <div class="container">

        <div class="wrap_menu_window">
            <div id="menu_window" class="menu_window">
                <div class="flex_wrap">
                    <a href="" class="close">
                        <img src="img/burger2.svg" alt="">
                    </a>
                </div>
                <div class="flex_wrap">
                    <a class="user2" href="?">
                        <img class="user-img" src="img/user2.svg" alt="">
                        <?php echo $user_fio;?>
                    </a>
                    
                </div>
              
                <div class="flex_wrap">
                    <a class="points2" href="?page=transactions">
                        <img class="points-img2" src="img/wallet2.svg" alt="">
                        <?php
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
                            
                            $balanse = $balanse_1 - $balanse_2;
                            echo $balanse.' баллов';
                        ?>
                    </a>
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="https://club.z-go.ru/?p=profile">В клуб</a>
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=store">Товары</a> 
                </div>
                
                <div class="flex_wrap">
                    <a class="to_club2" class="nav2_item" href="?page=exercises">Задания</a>
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=cliques">Клики</a>
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=check_tasks">Проверка заданий</a>
                </div>
                <div class="flex_wrap">
                    
                </div>
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=admin_cliques">Admin клик</a>  
                </div>    
                <div class="flex_wrap">
                    <a class="to_club2" href="?page=admin_cliques">Admin </a>  
                </div>          
            </div>
        </div>

        <nav class="nav">
            <div>
                <a href="?">
                    <img class="logo-img" src="img/logo.svg" alt="">
                </a>
            </div>

            <div><a class="to_club" href="https://club.z-go.ru/?p=profile">В клуб</a></div>

            <div><a class="to_club" href="?page=store">Товары</a> </div>

            

            <div class="right_nav">
                <div class="points">
                    <a class="points" href="?page=transactions">
                        <img class="points-img" src="img/wallet.svg" alt="">
                        <?php

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
                            
                            $balanse = $balanse_1 - $balanse_2;
                            echo $balanse.' баллов';
                        ?>
                    </a>
                </div>
                <div class="user" href="?">
                    <img class="user-img" src="img/user.svg" alt="">
                    <?php echo $user_fio;?>
                </div>
                
            </div>  

            <a href="#menu_window" class="menu-burger">
                <img src="img/burger.svg" alt="">
            </a>
        </nav>
        <div style="text-align:right; ">
            <?php
                if(isset($_SESSION['uid'])){
                    echo ' <a href="?do=exit"> Выйти </a>';
                }
            ?>
        </div>
    </div>
    
</header>

