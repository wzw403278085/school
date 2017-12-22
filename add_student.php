<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加学生页面</title>
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

$sql="select * from student order by stu_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<div class="class">
    <form action="insert_add_student.php" method="get">
        姓名：<input type="text" name="stu_name"><br>
        年龄：<input type="text" name="stu_age"><br>
        性别：<input type="radio" name="stu_sex" value='0'>男 <input type="radio" name="stu_sex" value='1'>女<br>
        班级：<select name="class_id">
            <?php
                    $sql_class="select * from class";
                    mysqli_select_db($conn,'school');
                    $result_class=mysqli_query($conn,$sql_class);
                    if(! $result_class){
                        die ("查询失败" .mysqli_error($conn));
                    }
                    while($class=mysqli_fetch_array($result_class)){
                    ?>
                    <option value="<?php echo $class[class_id] ?>"><?php echo $class[class_name] ?></option>
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