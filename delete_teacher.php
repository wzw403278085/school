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

$id=$_GET["tea_id"];
$sql="delete from teacher where tea_id=$id";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("删除失败" .mysqli_error($conn));
}
mysqli_free_result($result);
mysqli_close($conn);
?>
<script>
    $(".right").load('manage_teacher.php');
</script>