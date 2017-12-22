<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改学生页面</title>
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

$id=$_GET["stu_id"];
$sql_sub="select * from student where stu_id=$id";
mysqli_select_db($conn,'school');
$result_sub=mysqli_query($conn,$sql_sub);
if(! $result_sub){
    die("查询失败" .mysqli_error($conn));
}

$sql="select * from class order by class_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<div class="class">
    <?php while($sub=mysqli_fetch_array($result_sub)){?>
    <form action="insert_update_student.php" method="get">
        <input type="hidden" name="stu_id" value="<?php echo $sub[stu_id]?>">


                  姓名：<input type="text" name="stu_name" value="<?php echo $sub[stu_name]?>"><br>
                  年龄：<input type="text" name="stu_age" value="<?php echo $sub[stu_age]?>"><br>
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
                       <option value="<?php echo $class[class_id] ?> <?php if($row[class_id]==$sub[class_id]){ ?>selected="selected"<?php }?>"><?php echo $class[class_name] ?></option>
                       <?php
                            }
                       ?>
                  </select><br>
        <input type="submit" value="提交">
    </form>
    <?php
        }
    ?>
</div>
<?php
    mysqli_free_result($result);
    mysqli_close($conn);
?>
</body>
</html>