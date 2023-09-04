<?php        
    if(isset($_POST['edit'])){
        
        // ПЕРЕМЕННЫЕ
        
        $furstname=$_POST['furstname'];
        $surname=$_POST['surname'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $pass_md5=md5($pass);
        // echo $furstname.'<br>';
        // echo $surname.'<br>';
        // echo $email.'<br>';
        // echo $pass_md5.'<br>';

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

        // IMG
        $file_name=$_FILES['img']['name'];
        echo $file_name;
        $route='img/'.time().$_FILES['img']['name'];

        move_uploaded_file($_FILES['img']['tmp_name'], $route);
        

        // запись в бд
        $user_id=$user['id'];
        $query= "UPDATE helpdesk_users SET furstname='$furstname', surname='$surname', 
        email='$email', password='$pass_md5', img='$route' WHERE id=$user_id";  
        $link->query($query);

        echo '<script>document.location.href="?p=profile"</script>';
    }
?>
<main>
    <div class="container">
        <div class="my_profil">
            <form name="edit" method="POST" class="edit_form" enctype="multipart/form-data">  
                <div class="mp_blok_edit_form">
                    <input type="file" name="img">
                </div>          
                <div class="mp_blok_edit_form">
                    <input type="text" name="furstname" placeholder="Имя" value="<?php echo $user['furstname']; ?>" >
                </div>

                <div class="mp_blok_edit_form">
                    <input type="text" name="surname" placeholder="Фамилия" value="<?php echo $user['surname']; ?>" >
                </div>

                <div class="mp_blok_edit_form">
                    <input type="text" name="email" placeholder="email" value="<?php echo $user['email']; ?>" >
                    
                </div>
                <span class="error"> <?php echo $error_email ?></span>
                <div class="mp_blok_edit_form">
                    <input type="password" name="pass" placeholder="пароль">
                </div>

                <div class="mp_blok_edit_form">
                    <input type="password" placeholder="подтвердите пароль">
                </div>

                <div class="mp_blok_edit_form_submit">
                    <input type="submit" name="edit" value="Сохранить">
                </div>
            </form>
        </div>
    </div>
</main>