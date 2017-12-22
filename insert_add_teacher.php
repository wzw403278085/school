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

$leixing=$_GET['leixing'];

if($leixing=="1"){
    $tea_name=$_GET['tea_name'];
    $sql="insert into teacher"."(tea_name)"."values"."('$tea_name')";
}
if($leixing=="2"){
    $tea_name1=$_GET['tea_name1'];
    $tea_name2=$_GET['tea_name2'];
    $tea_name3=$_GET['tea_name3'];
    $tea_name4=$_GET['tea_name4'];
    $tea_name5=$_GET['tea_name5'];
    $sql="insert into teacher"."(tea_name)"."values"."('$tea_name1'),('$tea_name2'),('$tea_name3'),('$tea_name4'),('$tea_name5')";
}
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("插入数据失败" .mysqli_error($conn));
}
header("location:manage.php");
mysqli_free_result($result);
mysqli_close($conn);
?>







