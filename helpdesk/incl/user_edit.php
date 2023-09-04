<main>
    <div class="container">
        <div class="my_profil">
            <?php
            if (isset($_GET['id'])) {
                $user_id = $_GET['id'];
                $query="SELECT * FROM helpdesk_users WHERE id=$user_id ";
                $result=$link->query($query);
                $user_2=$result->fetch_assoc();

             
            ?>
                <div class="my_profil_blok">
                    <?php echo '<img src="'.$user_2['img'].'">'?>
                </div>
                <div class="my_profil_blok">
                    ID: <?php echo $user_2['id']; ?>
                </div>
                <div class="my_profil_blok">
                    Имя: <?php echo $user_2['furstname']; ?>
                </div>
                <div class="my_profil_blok">
                    Фамилия: <?php echo $user_2['surname']; ?>
                </div>
                <div class="my_profil_blok">
                    email: <?php echo $user_2['email']; ?>
                </div>
                <div class="my_profil_blok">
                    Дата регистрации: <?php echo $user_2['date']; ?>
                </div>
                <a href="?p=edit">
                    <div class="status_red">
                        <a href="?p=user_edit&id=<?php echo $user_id?>&delete">Удалить пользователя</a>
                    </div>
                </a> 
               <?php
               
                }
                
                if(isset($_GET['delete'])){
                    $query2="DELETE FROM helpdesk_users WHERE id=$user_id";
                    $link->query($query2);
                    echo '<script>document.location.href="?"</script>';
                }
               
               
               ?>        
        </div>
    </div>
</main>