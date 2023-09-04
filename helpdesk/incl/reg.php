<main>
    <div class="container">
        <div class="my_profil">
            <?php        
                if(isset($_POST['reg'])){
                    
                    // ПЕРЕМЕННЫЕ
                    $furstname=$_POST['furstname'];
                    $surname=$_POST['surname'];
                    $email=$_POST['email'];
                    $level=$_POST['level'];
                    $pass=$_POST['pass'];
                    $pass2=$_POST['pass2'];
                    $date=date('Y-m-d');
                    
                    // echo $furstname.'<br>';
                    // echo $surname.'<br>';
                    // echo $email.'<br>';
                    // echo $pass_md5.'<br>';
                    // echo $level;    

                    // FURSTNAME
                    if(empty($furstname)){
                        $error_furst='<div class="error">Укажите Имя</div>';
                    }

                    // SURNAME
                    if(empty($surname)){
                        $error_sur='<div class="error">Укажите Фамилию</div>';
                    }

                    // EMAIL
                    if(empty($email)){
                        $error_email='Укажите email';
                    }else{
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $error_email='Неккоретный email';
                        }else{
                            $query="SELECT * FROM helpdesk_users WHERE email='$email'";
                            $result=$link->query($query);
                            $num=$result->num_rows;
                            if($num){
                                $error_email='Email занят';
                            }
                        }
                    }

                    // PASSWORD
                    $how = strlen($pass);
                    // echo $how;
                    if ($how <= 4){    
                        $error_pass='<div class="error">Мин кол-во символов 5</div>';
                    }

                    if($pass != $pass2){
                        $error_pass2='<div class="error">Пароли не совподают</div>';
                    }
                
                    // шифрование
                    $pass_md5=md5($pass);
                    // echo $pass_md5;

                    if(empty($error_furst && $error_sur && $error_email && $error_pass && $error_pass2)){
                        // запись в бд
                        $query="INSERT INTO helpdesk_users (furstname, surname, email, password, date, level)
                        VALUE ('$furstname', '$surname', '$email', '$pass_md5', '$date', '$level')";
                        $link->query($query);
                        echo '<div class="status_green">Вы зарегистрированы</div>';

                    }else{echo '<div class="status_red">Ошибка</div>'; }
                }
            ?>
            <form name="reg" method="POST" class="reg_form">            
                <div class="mp_blok_reg_form">
                    <input type="text" name="furstname" placeholder="Имя" value="<?php echo $furstname; ?>">
                </div>
                <span class="error"> <?php echo $error_furst ?></span>

                <div class="mp_blok_reg_form">
                    <input type="text" name="surname" placeholder="Фамилия" value="<?php echo $surname; ?>">
                </div>
                <span class="error"> <?php echo $error_sur ?></span>

                <div class="mp_blok_reg_form">
                    <input type="text" name="email" placeholder="email" value="<?php echo $email; ?>">
                </div>
                <div class="mp_blok_reg_form">
                    <select name="level">
                        <option value="1">Сотрудник</option>
                        <option value="2">Исполнитель</option>
                        <option value="3">Админ</option>
                    </select>
                </div>
                <span class="error"> <?php echo $error_email ?></span>

                <div class="mp_blok_reg_form">
                    <input type="password" name="pass" placeholder="пароль">
                </div>
                <span class="error"> <?php echo $error_pass ?></span>

                <div class="mp_blok_reg_form">
                    <input type="password" name="pass2" placeholder="подтвердите пароль">
                </div>
                <span class="error"> <?php echo $error_pass2 ?></span>

                <div class="mp_blok_reg_form_submit">
                    <input type="submit" name="reg" value="Зарегистрироваться">
                </div>
            </form>        
        </div>
    </div>
</main>