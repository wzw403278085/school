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
mysqli_query($conn,"set names utf8");

$id=$_GET['class_id'];

$class_name=$_GET['class_name'];
$tea_id=$_GET['tea_id'];
$sql="update class set class_name='$class_name',tea_id=$tea_id where class_id=$id";
mysqli_select_db($conn,'school');
$result=mysqli_query($conn,$sql);
if(! $result){
    die("修改数据失败" .mysqli_error($conn));
}
header("location:manage.php");
mysqli_free_result($result);
mysqli_close($conn);
?>







