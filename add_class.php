<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加班级页面</title>
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

$sql="select * from teacher order by tea_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<div class="class">
    <form action="insert_add_class.php" method="get">
        班级名：<input type="text" name="class_name"><br>
        班主任：<select name="tea_id">
                       <?php
                            while($row=mysqli_fetch_array($result)){
                       ?>
                       <option value="<?php echo $row[tea_id]?>"><?php echo $row[tea_name] ?></option>
                       <?php
                            }
                       ?>
                  </select><br>
        <input type="submit" value="提交">
    </form>
</div>
<?php
    mysqli_close($conn);
?>
</body>
</html>