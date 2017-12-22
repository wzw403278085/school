<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加课程页面</title>
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

$sql1="select * from student order by stu_id desc";
mysqli_select_db($conn,"school");
$result1=mysqli_query($conn,$sql1);
if(! $result1){
    die("查询数据失败" .mysqli_error($conn));
}

$sql="select * from class order by class_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<div class="class">
    <form action="insert_add_score.php" method="get">
        学号：<select name="stu_id">
            <?php
                 while($row=mysqli_fetch_array($result1)){
            ?>
            <option value="<?php echo $row[stu_id]?>"><?php echo $row[stu_id] ?></option>
            <?php
                 }
            ?>
       </select><br>
        班级：<select name="class_id">
                       <?php
                            while($row=mysqli_fetch_array($result)){
                       ?>
                       <option value="<?php echo $row[class_id]?>"><?php echo $row[class_name] ?></option>
                       <?php
                            }
                       ?>
                  </select><br>
        分数：<input type="text" name="score"><br>
        <input type="submit" value="提交">
    </form>
</div>
<?php
    mysqli_close($conn);
?>
</body>
</html>