<?php
    if($user['level']==2){
?>
    <table class="performer">
        <caption>Ваши заявки на исполнение</caption>
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
            $items_query="SELECT * FROM helpdesk_applications  WHERE id_performers=$user_id";
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


            $query="SELECT * FROM helpdesk_applications WHERE id_performers=$user_id AND status=2 LIMIT $limit OFFSET $offset";
            $result=$link->query($query);
            while($applications=$result->fetch_assoc()){
                
                echo '<tr onclick=\'window.location.href="?p=view_applications&id='.$applications['id'].'"\'>';
                
                    echo '<td>'.$applications['id'].'</td>';

                    echo '<td>'.$applications['name'].'</td>';

                    echo '<td>'.$applications['date'].'</td>';

                    echo '<td>';
                            echo'<div class="status_done">
                                    <a href="?done='.$applications['id'].'">Выполнено</a>
                                </div>';
                    echo '</td>';
                    
                echo '</tr>';
            }
        ?> 
        </tbody>

        <tfoot>
            <tr></tr>
        </tfoot>
    </table>
<?php include('incl/pagination.php'); ?>

    <table class="performer">
        <caption>Выполненые заявки</caption>
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
            $items_query="SELECT * FROM helpdesk_applications WHERE id_performers=$user_id";
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


            $query="SELECT * FROM helpdesk_applications WHERE id_performers=$user_id AND status=3 LIMIT $limit OFFSET $offset";
            $result=$link->query($query);
            while($applications=$result->fetch_assoc()){
                
                echo '<tr onclick=\'window.location.href="?p=view_applications&id='.$applications['id'].'"\'>';
                
                    echo '<td>'.$applications['id'].'</td>';

                    echo '<td>'.$applications['name'].'</td>';

                    echo '<td>'.$applications['date'].'</td>';

                    echo '<td>';
                        if($applications['status']==3){echo '<div class="status_green">Выполнена</div>';}                             
                    echo '</td>';
                    
                echo '</tr>';
            }
        ?> 
        </tbody>

        <tfoot>
            <tr></tr>
        </tfoot>
    </table>
    <?php include('incl/pagination.php'); ?>

<?php

    if(isset($_GET['done'])){
        $done_id=$_GET['done'];
        $query2="UPDATE helpdesk_applications SET status=3 WHERE id=$done_id";
        $link->query($query2);
        echo '<script>document.location.href="?"</script>';
    }


    }
?>