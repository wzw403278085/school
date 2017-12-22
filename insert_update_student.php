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

$id=$_GET['stu_id'];

$stu_name=$_GET['stu_name'];
$stu_age=$_GET['stu_age'];
$stu_sex=$_GET['stu_sex'];
$class_id=$_GET['class_id'];
$sql="update student set stu_name='$stu_name',stu_age=$stu_age,stu_sex=$stu_sex,class_id=$class_id where stu_id=$id";
mysqli_select_db($conn,'school');
$result=mysqli_query($conn,$sql);
if(! $result){
    die("修改数据失败" .mysqli_error($conn));
}
header("location:manage.php");
mysqli_free_result($result);
mysqli_close($conn);
?>







