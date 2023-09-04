<main>            
    <div class="container">
        <form class="search" method="POST" name="search_emplyee">  
            <input type="search" name="text">
            <input type="submit" name="search_emplyee" value="Поиск">
        </form>
        <?php                
            if(isset($_POST['search_emplyee'])){
                $text=$_POST['text'];
                // echo $text;
            }          
        ?>
        <table class="tb">
            <caption>Список сотрудников</caption>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Имя</td>
                    <td>Фамилия</td>    
                    <td>DATE</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    $query="SELECT * FROM helpdesk_users WHERE level=3 AND (surname LIKE '%".$text."%' OR furstname LIKE '%".$text."%') ";
                    $result=$link->query($query);
                    while($user=$result->fetch_assoc()){
                        echo '<tr onclick=\'window.location.href="?p=user_edit&id='.$user['id'].'"\'>';
                        echo '
                            <td>'.$user['id'].'</td>
                            <td>'.$user['furstname'].'</td>
                            <td>'.$user['surname'].'</td>
                            <td>'.$user['date'].'</td>                       
                        ';
                        echo '</tr>';
                    }
                ?> 
            </tbody>

            <tfoot>
                <tr></tr>
            </tfoot>
        </table>
    </div>

    <div class="container">
    <form class="search" method="POST" name="search_performers">  
            <input type="search" name="text">
            <input type="submit" name="search_performers" value="Поиск">
        </form>
        <?php                
            if(isset($_POST['search_performers'])){
                $text=$_POST['text'];
                // echo $text;
            }          
        ?>

        <table class="tb">
            <caption>Список исполнителей</caption>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Имя</td>
                    <td>Фамилия</td>
                    <td>DATE</td>
                </tr>
            </thead>

            <tbody>
                <?php
                        $query="SELECT * FROM helpdesk_users WHERE level=2 AND (surname LIKE '%".$text."%' OR furstname LIKE '%".$text."%') ";
                        $result=$link->query($query);
                        while($user=$result->fetch_assoc()){
                            echo '
                            <tr onclick="window.location.href="index.php";">
                                <td>'.$user['id'].'</td>
                                <td>'.$user['furstname'].'</td>
                                <td>'.$user['surname'].'</td>
                                <td>'.$user['date'].'</td>                    
                            </tr>
                            ';
                        }
                    ?> 
            </tbody>

            <tfoot>
                <tr></tr>
            </tfoot>
        </table>
    </div>
</div>
               