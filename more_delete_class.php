<?php
error_reporting(0);
$dbhost = 'localhost:3306';  // mysql
$dbuser = 'root';            // mysql û
$dbpass = '';          // mysql û
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
    die('连接错误：' . mysqli_error($conn));
}
//echo '链接成功';
mysqli_select_db($conn,'school');
$class_id=$_GET[de];
foreach($class_id as $ide){
    $exec="delete from class where class_id=$ide";
    $result=mysqli_query($conn,$exec);
    if(! $result){
        die("删除失败" .mysqli_error($conn));
    }
}
header("location:manage.php");
mysqli_free_result($result);
mysqli_close($conn);
?>