<main>
    <div class="container">
        <div class="personal_area">
            <div class="personal_area_head">
                Личный кабинет
            </div>
        </div>
        <div class="personal_area_body">
            <?php
                if($user['level']==1){
            ?>

            <a href="?p=list">
                <div class="personal_area_dr-b_blok">
                    Список исполнителей и сотрудников                        
                </div>                    
            </a>
            
            <a href="?p=reg">
                <div class="personal_area_dr-b_blok">
                    Регистрация пользователя                        
                </div>                    
            </a>
            <?php
                }
            ?>
            
            <a href="?p=profile">
                <div class="personal_area_dr-b_blok">
                    Мой профиль                        
                </div>
            </a>           
           
            
        </div>
        
    </div>
</main>
