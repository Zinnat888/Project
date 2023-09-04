<main>
    <div class="container_2">
        <?php
            if (isset($_GET['id'])) {
                $get_id = $_GET['id'];
                $query="SELECT * FROM helpdesk_applications WHERE id=$get_id";
                $result=$link->query($query);
                $applications=$result->fetch_assoc();

                echo '<table class="view_applications">';

                    echo '<caption>Заявка</caption>';

                    echo '<thead>
                            <tr>
                                <td>ID</td>
                                <td>NAME</td>
                                <td>Сотрудник</td>
                                <td>Исполнитель</td>
                                <td>DATE</td>
                                <td>STATUS</td>
                            </tr>
                        </thead>';

                    echo '<tbody>';         
                        echo '<tr>';
                                
                            echo '<td>'.$applications['id'].'</td>';

                            echo '<td>'.$applications['name'].'</td>';

                            $id_employee = $applications['id_employee'];
                            $query2="SELECT * FROM helpdesk_users WHERE id=$id_employee";
                            $result2=$link->query($query2);
                            $employee=$result2->fetch_assoc();
                            echo '<td>'.$employee['surname'].' '.$employee['furstname'].'</td>';

                            if($applications['id_performers'] == 1){
                                echo  '<td> <a href="#okno"> Назначить </a> </td>';
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
                    echo '</tbody>';       
                    
                    echo '<tfoot>
                            <tr></tr>
                        </tfoot>';
                echo '</table>';
                    
                
            }
        include('incl/modal.php');
        ?>   
        <!-- HTML -->
        
        
    </div>
</main>