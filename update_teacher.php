<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改教师页面</title>
</head>
<body>
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

$id=$_GET["tea_id"];
$sql_sub="select * from teacher where tea_id=$id";
mysqli_select_db($conn,'school');
$result_sub=mysqli_query($conn,$sql_sub);
if(! $result_sub){
    die("查询失败" .mysqli_error($conn));
}

$sql="select * from teacher order by tea_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<div class="class">
    <?php while($sub=mysqli_fetch_array($result_sub)){?>
    <form action="insert_update_teacher.php" method="get">
        <input type="hidden" name="tea_id" value="<?php echo $sub[tea_id]?>">
        名字：<input type="text" name="tea_name" value="<?php echo $sub[tea_name]?>"><br>

        <input type="submit" value="提交">
    </form>
    <?php
        }
    ?>
</div>
<?php
    mysqli_close($conn);
?>
</body>
</html>