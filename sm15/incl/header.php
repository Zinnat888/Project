<header>
        <div class="header">
            <div class="header_menu">
                <div class="header_menu_section">
                    <div class="header_menu_nav">
                        <?php
                            if(isset($_SESSION['uid'])){
                                echo '                                    
                                    <div class="header_menu_section_user">
                                        <a href="?p=personal_area">
                                            '.$user['furstname'].'
                                            '.$user['surname'].' 
                                        </a>
                                    </div>                                    
                                ';
                            }else{
                                echo '';
                            }
                        ?> 
                    </div>
                    
                    <div class="header_menu_nav">                        
                        <div class="header_menu_name">
                            <a href="index.php">
                                <b>HELP DESK</b>
                            </a>
                        </div>                        
                    </div>

                    <div class="header_menu_nav">
                        <div class="header_menu_login"> 
                            <?php
                                if(isset($_SESSION['uid'])){
                                    echo '                           
                                        <a href="?do=exit">                                 
                                            Выйти
                                        </a>                                                                        
                                    ';
                                }else{
                                    echo '';
                                }
                            ?> 
                        </div>  
                    </div>
                </div>                
            </div>
        </div>
    </header>