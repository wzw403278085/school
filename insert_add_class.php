<?php
/**
 * Created by PhpStorm.
 * User: 11
 * Date: 2017/9/16
 * Time: 11:01
 */
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

$class_name=$_GET['class_name'];
$tea_id=$_GET['tea_id'];
$sql="insert into class"."(class_name,tea_id)"."values"."('$class_name','$tea_id')";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("插入数据失败" .mysqli_error($conn));
}
header("location:manage.php");

mysqli_close($conn);
?>







