<?php
$dbhost = 'localhost:3306';  // mysql
$dbuser = 'root';            // mysql û
$dbpass = '';          // mysql û
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
    die('连接错误：' . mysqli_error($conn));
}
echo '链接成功';
mysqli_query($conn,"set names utf8");

$stu_id=$_GET['stu_id'];
$class_id=$_GET['class_id'];
$score=$_GET['score'];
$sql="insert into score"."(stu_id,class_id,score)"."values"."('$stu_id','$class_id','$score')";
mysqli_select_db($conn,'school');
$result=mysqli_query($conn,$sql);
if(! $result){
    die("插入数据失败" .mysqli_error($conn));
}
header("location:manage.php");

mysqli_close($conn);
?>







