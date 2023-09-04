<main>
    <div class="container">
        <div class="my_profil">
            <div class="my_profil_blok">
                <?php echo '<img src="'.$user['img'].'">'?>
            </div>
            <div class="my_profil_blok">
                ID: <?php echo $user['id']; ?>
            </div>
            <div class="my_profil_blok">
                Имя: <?php echo $user['furstname']; ?>
            </div>
            <div class="my_profil_blok">
                Фамилия: <?php echo $user['surname']; ?>
            </div>
            <div class="my_profil_blok">
                email: <?php echo $user['email']; ?>
            </div>
            <div class="my_profil_blok">
                Дата регистрации: <?php echo $user['date']; ?>
            </div>
            <a href="?p=edit">
                <div class="my_profil_blok_edit">
                    Редактировать
                </div>
            </a>        
        </div>
    </div>
</main>


