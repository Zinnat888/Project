
<div class="okno" id="okno">
    <div class="modal">
        <a href="#"> X </a>        

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
        <table class="appointment">
            <caption>Список сотрудников</caption>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Имя</td>
                    <td>Фамилия</td>    
                    <td>Кнопка</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    $query="SELECT * FROM helpdesk_users WHERE level=2  AND (surname LIKE '%".$text."%' OR furstname LIKE '%".$text."%') ";
                    $result=$link->query($query);
                    while($user=$result->fetch_assoc()){
                        echo '
                        <tr onclick="window.location.href="index.php";">';
                        
                        echo '<td>'.$user['id'].'</td>';

                        echo '<td>'.$user['furstname'].'</td>';

                        echo '<td>'.$user['surname'].'</td>';

                        echo '<td>';
                            echo'<a href="?p=view_applications&id='.$get_id.'&done_2='.$user['id'].'">
                                    <div class="status_done">
                                        Назначить
                                    </div>
                            </a>';
                        echo '</td>';
                    }
                    if(isset($_GET['done_2'])){
                        $done_id2=$_GET['done_2'];

                        $query2="UPDATE helpdesk_applications SET status=2, id_performers=$done_id2 WHERE id=$get_id ";
                        $link->query($query2);
                        echo '<script>document.location.href="?"</script>';
                    }
                ?> 
            </tbody>

            <tfoot>
                <tr></tr>
            </tfoot>
        </table>

        
    </div>
</div>
