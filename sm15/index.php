
<?php
    session_start();
    include('incl/connect.php');
    if(isset($_SESSION['uid'])){
        $query="SELECT * FROM helpdesk_users WHERE id='{$_SESSION['uid']}'";
        $result=$link->query($query);
        $user=$result->fetch_assoc();
    } 
    if($_REQUEST['do']=="exit"){
        session_unset();
        echo '<script>document.location.href="?"</script>';
    }
    $user_id=$user['id'];
    $user_furstname=$user['furstname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HELP DESK</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/main.js">
</head>
<body>
    <?php
        include('incl/header.php');  

        if(isset($_SESSION['uid'])){
            if(isset($_GET['p'])){
                if ($_GET['p']=='personal_area') {
                    include('incl/personal_area.php');
                }
                if ($_GET['p']=='profile') {
                    include('incl/profile.php');
                }
                if ($_GET['p']=='edit') {
                    include('incl/edit.php');
                }
                if ($_GET['p']=='reg') {
                    include('incl/reg.php');
                }
                if ($_GET['p']=='view_applications') {
                    include('incl/view_applications.php');
                }
                if ($_GET['p']=='list') {
                    include('incl/list.php');
                }
                if ($_GET['p']=='modal') {
                    include('incl/modal.php');
                }
                if ($_GET['p']=='user_edit') {
                    include('incl/user_edit.php');
                }
                
            }else{
                include('incl/start_page.php');
            }
        }else{
            include('incl/auth.php');
        }
        
        include('incl/footer.php');


        
    ?>






    <script>
        function view(n) {
            style = document.getElementById(n).style;
            style.display = (style.display == 'block') ? 'none' : 'block';
        }                       
    </script>
</body>
</html>