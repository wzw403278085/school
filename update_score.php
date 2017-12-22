<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改成绩页面</title>
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

$id=$_GET["id"];
$sql_sub="select * from score where id=$id";
mysqli_select_db($conn,'school');
$result_sub=mysqli_query($conn,$sql_sub);
if(! $result_sub){
    die("查询失败" .mysqli_error($conn));
}

$sql="select * from student order by stu_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
$sql1="select * from class order by class_id desc";
mysqli_select_db($conn,"school");
$result1=mysqli_query($conn,$sql1);
if(! $result1){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<div class="class">
    <?php while($sub=mysqli_fetch_array($result_sub)){?>
    <form action="insert_update_score.php" method="get">
        <input type="hidden" name="id" value="<?php echo $sub[id]?>">

        学号：<select name="stu_id">
                    <?php
                         while($row=mysqli_fetch_array($result)){
                    ?>
                    <option value="<?php echo $row[stu_id]?>" <?php if($row[stu_id]==$sub[stu_id]){ ?>selected="selected"<?php }?>><?php echo $row[stu_id] ?></option>
                    <?php
                         }
                    ?>
               </select><br>
        班级：<select name="class_id">
                       <?php
                            while($row=mysqli_fetch_array($result1)){
                       ?>
                       <option value="<?php echo $row[class_id]?>" <?php if($row[class_id]==$sub[class_id]){ ?>selected="selected"<?php }?>><?php echo $row[class_name] ?></option>
                       <?php
                            }
                       ?>
                  </select><br>
        分数：<input type="text" name="score" value="<?php echo $sub[score]?>"><br>
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