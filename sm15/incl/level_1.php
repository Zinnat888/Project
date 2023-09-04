<?php
    if($user['level']==1){
?>  
    <table class="admin">
        <caption>Список всех заявок</caption>
        <caption>
            <div class="status_box">
                <div class="s-b_nav">
                    <a href="?category=1">
                        <div class="status_red">
                            В обработке
                        </div>
                    </a>    
                </div>
                <div class="s-b_nav">
                    <a href="?category=2">
                        <div class="status_yellow">
                            Назначена
                        </div>
                    </a>
                </div>
                <div class="s-b_nav">
                    <a href="?category=3">
                        <div class="status_green">
                            Выполнена
                        </div>
                    </a>
                </div>
            </div>
        </caption>
        <thead>
            <tr>
                <td>ID</td>
                <td>NAME</td>
                <td>Сотрудник</td>
                <td>Исполнитель</td>
                <td>DATE</td>
                <td>STATUS</td>
            </tr>
        </thead>
        
        <tbody>   
        <?php

            $items_query="SELECT * FROM helpdesk_applications";
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


            // категории
            if(isset($_GET['category'])){
                $category_id=$_GET['category'];
                $dob_text='WHERE status = '.$category_id;
            }   
        


            $query="SELECT * FROM helpdesk_applications  $dob_text LIMIT $limit OFFSET $offset";
            $result=$link->query($query);
            while($applications=$result->fetch_assoc()){
                
                echo '<tr onclick=\'window.location.href="?p=view_applications&id='.$applications['id'].'"\'>';
                
                    echo '<td>'.$applications['id'].'</td>';

                    echo '<td>'.$applications['name'].'</td>';
                    
                        $id_employee = $applications['id_employee'];
                        $query2="SELECT * FROM helpdesk_users WHERE id=$id_employee";
                        $result2=$link->query($query2);
                        $employee=$result2->fetch_assoc();
                        echo '<td>'.$employee['surname'].' '.$employee['furstname'].'</td>';

                    if($applications['id_performers'] == 1){
                        echo  '<td>Назначить</td>';
                    }else{
                        
                        $id_performers = $applications['id_performers'];
                        $query3="SELECT * FROM helpdesk_users WHERE id=$id_performers";
                        $result3=$link->query($query3);
                        $performers=$result3->fetch_assoc();
                        echo '<td>'.$performers['surname'].' '.$performers['furstname'].'</td>';
                    }

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
            <!-- <tr onclick="window.location.href='#';">
                <td>1</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni ea explicabo odit distinctio quos unde repudiandae, eveniet, mollitia repellat cum nobis nostrum fugiat magnam voluptas at labore excepturi debitis eum.</td>
                <td>Сотрудник</td>
                <td>Исполнитель</td>
                <td>12.34.5678</td>
                <td>В обработке</td>                    
            </tr>-->
        </tbody>
        <tfoot>
            <tr></tr>
        </tfoot>
    </table>
<?php
    include('incl/pagination.php');
    
    }
?>