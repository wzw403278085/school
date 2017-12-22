<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理学生页面</title>
    <style>
        body{margin: 0;padding:0;}
        .student{width: 80%;margin: 40px  auto; background-color: #e0e9ff;}
        .student .add_stu{float:left; width: 150px;height: 35px;text-align: center;line-height: 35px;color: #fff;background-color: #666;border-radius: 5px;margin-right:20px;}
        table td{text-align:center;}
    </style>
    <script src="js/jquery-3.2.1.min.js"></script>
</head>
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
<body>
<div class="student">
    <div class="add_stu"><a>添加学生</a></div>
    <div class="search">
            <select name="class" id="class">
                <option value="1">姓名</option>
                <option value="2">年龄</option>
                <option value="3">性别</option>
                <option value="4">班级</option>
            </select>
            <input type="text" name="search" id="search"><input type="submit" value="搜索" id="submit">
    </div>
    <div class="tea_list">
       <form action="more_delete_student.php" method="get">
        <table width="100%" border=1>
            <tr>
                <th width="10%">选项</th>
                <th width="10%">学号</th>
                <th width="10%">姓名</th>
                <th width="10%">年龄</th>
                <th width="20%">性别</th>
                <th width="20%">班级</th>
                <th width="20%">操作</th>
            </tr>
            <?php
            while ($row=mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><input type="checkbox" name=de[] value=<?php echo $row[stu_id] ?>></td>
                    <td><?php echo $row[stu_id] ?></td>
                    <td><?php echo $row[stu_name] ?></td>
                    <td><?php echo $row[stu_age] ?></td>
                    <td><?php
                            if($row[stu_sex]=="0"){
                                echo "男";
                            }
                            if($row[stu_sex]=="1"){
                                 echo "女";
                            }
                     ?></td>
                    <td><?php
                            $sql_class="select * from class where class_id=$row[class_id]";
                            mysqli_select_db($conn,'school');
                            $result_stu=mysqli_query($conn,$sql_class);
                            if(! $result_stu){
                                die ("查询失败" .mysqli_error($conn));
                            }
                            while($stu_class=mysqli_fetch_array($result_stu)){
                                echo "$stu_class[class_name]";
                            }
                     ?></td>

                    <td><a index="<?php echo $row[stu_id] ?>" class="update">修改</a>&nbsp;&nbsp;&nbsp;<a index="<?php echo $row[stu_id] ?>" class="delete">删除</a></td>
                </tr>
                <?php
                    }
                ?>
                <tr><td colspan="7">总计：
                        <?php
                            $sql_count="select count(stu_id) as count from student";
                            mysqli_select_db($conn,'school');
                            $result_count=mysqli_query($conn,$sql_count);
                            if(! result_count){
                                die ("统计失败" .mysqli_error($conn));
                            }
                            while($count=mysqli_fetch_array($result_count)){
                                echo "$count[count]";
                            }
                        ?>
                条数据</td></tr>
                <tr><td colspan="7"><input type="submit" value="批量删除"></td></tr>
        </table>
      </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".add_stu").click(function () {
            $(".student").load('add_student.php');
        });
        $(".update").click(function(){
            var id=$(this).attr("index");
            $(".student").load('update_student.php?stu_id='+id);
        });
        $(".delete").click(function(){
            var id=$(this).attr("index");
            $(".student").load('delete_student.php?stu_id='+id);
        });
        $("#submit").click(function(){
            var class1=$("#class").val();
            var search1=$("#search").val();
            $(".student").load("search_student.php?class="+class1+"&search="+search1);
        });
    })
</script>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
</body>
</html>