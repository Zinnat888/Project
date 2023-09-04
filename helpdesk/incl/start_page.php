<main>
    <div class="container">
        <?php
            if($user['level']==3){
                include('incl/level_3.php');
            }
        ?>

        <?php
            if($user['level']==2){
                include('incl/level_2.php');
            }
        ?>

        <?php
            if($user['level']==1){
            
            include('incl/level_1.php');
            }
        ?>
    </div>
</main>
