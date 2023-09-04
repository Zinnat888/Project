<?php
    if(isset($_POST['auth'])){

        // переменные;
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $pass_md5=md5($pass);

        // EMAIL
        if(empty($email)){
            $error_email='Укажите email';
        }else{
            // регулярка
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_email='Некорректный email';
            }else{
                //проверка на email
                // $query="SELECT * FROM helpdesk_users WHERE email='$email' ";
                // $result=$link->query($query);
                // $num=$result->num_rows; 
                // if(!$num){
                //     echo '<a href="?page=reg">Зарегистрироваться</a>';
                // }
            } 
        }

        // пароль
        if(empty($pass)){
            $error_pass='Введите пароль';
        }else{
            $query="SELECT * FROM helpdesk_users WHERE email='$email' AND password='$pass_md5'";
            $result=$link->query($query);
            $num=$result->num_rows; 
            if($num==0){
                $error_pass='Неверный логин или пароль';
            }
        }    
        
        if(empty($error_email && $error_pass)){
            $row=$result->fetch_assoc();
            $uid=$row['id'];
            $_SESSION['uid']=$uid;
            echo '<script>document.location.href="?"</script>';
        }
        
    }
?>
<main>
    <div class="container">
        <div class="form">
            <div class="form_title">
                <span> Вход в систему </span>
            </div>

            <form method="POST" name="auth">
                <div class="form_auth_box">
                    <div class="f_a_b_blok">
                        <span> Email </span>
                        <div class="form_auth_el">
                            <input type="text" name="email">
                        </div>
                        <span class="error"> <?php echo $error_email; ?></span>
                    </div>
                    <div class="f_a_b_blok">
                        <span> Password </span>
                        <div class="form_auth_el">
                            <input type="password" name="pass">
                        </div>
                        <span class="error"> <?php echo $error_pass; ?> </span>
                    </div>
                    <div class="f_a_b_blok">
                        <div class="form_auth_el_submit">
                            <input type="submit" name="auth" value="Войти">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</main>
<?php
    
?>