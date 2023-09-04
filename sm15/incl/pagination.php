
<div class="pagination">
    <?php
        $sheet=$application_count/$limit;
        $sheet=ceil($sheet);
        // echo $sheet;

        for($i=1;$i<=$sheet; $i++){
            echo '<a href="?sheet='.$i.'">'.$i.'</a>';
        }
    ?>
    <div>
    
</div>