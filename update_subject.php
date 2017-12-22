<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改课程页面</title>
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

$id=$_GET["subject_id"];
$sql_sub="select * from subject where subject_id=$id";
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
    <form action="insert_update_subject.php" method="get">
        <input type="hidden" name="subject_id" value="<?php echo $sub[subject_id]?>">
        课程名称：<input type="text" name="subject_name" value="<?php echo $sub[subject_name]?>"><br>
        班主任老师：<select name="tea_id">
                       <?php
                            while($row=mysqli_fetch_array($result)){
                       ?>
                       <option value="<?php echo $row[tea_id]?>" <?php if($row[tea_id]==$sub[tea_id]){ ?>selected="selected"<?php }?>><?php echo $row[tea_name] ?></option>
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