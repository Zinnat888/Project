<?php
    if(isset($_GET['id'])){
        $get_id = $_GET['id'];
?>
<section class="section_store">
    <div class="container">
        <div class="wrap_store">
            <?php            
                $sql = "SELECT * FROM tovar WHERE id = $get_id";
                $result = $link->query($sql, PDO::FETCH_ASSOC);
                $tovar = $result->fetch()
            ?>                
            <div class="product">
                <div class="product_item">
                    <div class="product_name">
                        <? echo $tovar['name']?>
                    </div>
                    <div class="product_img">
                        <img src="<? echo $tovar['img']?>" alt="">                            
                    </div>
                </div>
                <div class="point_start point_store">
                    <div class="point"><? echo $tovar['points']?> Б</div>   
                </div>
            </div>
        </div>
    </div>
</section>
<?}?>