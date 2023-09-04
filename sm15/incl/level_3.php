<?php
    if($user['level']==3){
?>  
    <a  href="#hidden5" onclick="view('hidden5'); return false">
        <div class="s-p_blok">
            Подать заявку                        
        </div>                    
    </a>     
    
    <div id="hidden5"  class="pa_dr-b_blok_hidden">
        <?php
            if(isset($_POST['filing'])){                        
                //ПЕРЕМЕННЫЕ
                $name=$_POST['name'];
                $date=date('Y-m-d');
                $q=1;
                $id_employee=$user['id'];

                // ЗАПИСЬ В БД
                $query="INSERT INTO helpdesk_applications (name, id_employee, id_performers, date, status)
                VALUE ('$name', '$id_employee', '$q', '$date','$q')";
                $link->query($query);
                echo'GOOD';
            }
        ?>
        <form class="filing_form" method="POST" name="filing">
            <div class="filing_form_el">
                <textarea name="name" placeholder="Напишите причину..."
                required cols="100" rows="8"></textarea>
            </div>
            <div class="filing_form_el_submit">
                <input type="submit" name="filing" value="Отправить">
            </div>
            
        </form>
    </div>

    <table class="employee">
        <caption>Ваши заявки</caption>
        <thead>
            <tr>
                <td>ID</td>
                <td>NAME</td>
                <td>DATE</td>
                <td>STATUS</td>
            </tr>
        </thead>
        
        <tbody>                     
        <?php
            $items_query="SELECT * FROM helpdesk_applications WHERE id_employee=$user_id";
            $items_result=$link->query($items_query);
            while($application_items=$items_result->fetch_assoc()){
                $application_count = $application_count+1;
            }

            if(isset($_GET['sheet'])){
                if($_GET['sheet']<=0){
                    $sheet=1;
                }else{
                    $sheet=$_GET['sheet'];
                }
            }else{
                $sheet=1;
            }

            //количество заявок на одной странице 
            $limit=5;

            $offset=$limit*($sheet-1);

            $query="SELECT * FROM helpdesk_applications WHERE id_employee=$user_id LIMIT $limit OFFSET $offset ";
            $result=$link->query($query);
            while($applications=$result->fetch_assoc()){

                echo '<tr onclick=\'window.location.href="?p=view_applications&id='.$applications['id'].'"\'>';

                    echo '<td>'.$applications['id'].'</td>';

                    echo '<td>'.$applications['name'].'</td>';

                    echo '<td>'.$applications['date'].'</td>';

                    echo '<td>';
                        if($applications['status']==1){ echo '<div class="status_red">В обработке</div>';}
                        else{
                            if($applications['status']==2){echo '<div class="status_yellow">Назначена</div>';}
                            else{
                                if($applications['status']==3){echo '<div class="status_green">Выполнена</div>';}
                            }
                        }
                        
                    echo '</td>';
                echo '</tr>';
                
            }
        ?>
        </tbody>

        <tfoot>
            <tr></tr>
        </tfoot>
    </table>
<?php
    include('incl/pagination.php');
    }
?>