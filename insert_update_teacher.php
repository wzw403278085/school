<?php
$dbhost = 'localhost:3306';  // mysql
$dbuser = 'root';            // mysql û
$dbpass = '';          // mysql û
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
    die('连接错误：' . mysqli_error($conn));
}
//echo '链接成功';
mysqli_query($conn,"set names utf8");

$id=$_GET["tea_id"];

$tea_name=$_GET['tea_name'];
$sql="update teacher set tea_name='$tea_name' where tea_id=$id";
mysqli_select_db($conn,'school');
$result=mysqli_query($conn,$sql);
if(! $result){
    die("修改数据失败" .mysqli_error($conn));
}
header("location:manage.php");

mysqli_close($conn);
?>







