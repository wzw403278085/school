<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理ch页面</title>
    <style>
        body{margin: 0;padding:0;}
        .student{width: 80%;margin: 50px  auto; background-color: #e0e9ff;}
        .student .add_stu{float:left;margin-right:20px; width: 150px;height: 35px;text-align: center;line-height: 35px;color: #fff;background-color: #666;border-radius: 5px;}
        .student .add_stu a{text-decoration: none;color: #fff;}
        .student .tea_list{margin-top: 20px;}
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

$sql="select * from score order by id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<body>
<div class="student">
    <div class="add_stu"><a>添加学生成绩</a></div>
    <div class="search">
         <select name="class" id="class">
             <option value="1">学号</option>
             <option value="2">班级</option>
             <option value="3">分数</option>
         </select>
         <input type="text" name="search" id="search"><input type="submit" value="搜索" id="submit">
    </div>

    <div class="tea_list">
     <form action="more_delete_score.php" method="get">
        <table width="100%" border=1>
            <tr>
                <th width="10%">选项</th>
                <th width="10%">排名</th>
                <th width="10%">学号</th>
                <th width="20%">姓名</th>
                <th width="20%">班级</th>
                <th width="10%">分数</th>
                <th width="20%">操作</th>
            </tr>
            <?php
            while ($row=mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><input type="checkbox" name=de[] value=<?php echo $row[id] ?>></td>
                    <td><?php echo $row[id] ?></td>
                    <td><?php echo $row[stu_id] ?></td>
                    <td>
                        <?php
                            $sql_stu1="select * from student where stu_id=$row[stu_id]";
                            mysqli_select_db($conn,'school');
                            $result_stu1=mysqli_query($conn,$sql_stu1);
                            if(! $result_stu1){
                                die ("查询失败" .mysqli_error($conn));
                            }
                            while($stu_class1=mysqli_fetch_array($result_stu1)){
                                echo "$stu_class1[stu_name]";
                            }
                     ?>
                    </td>
                    <td><?php
                            $sql_stu2="select * from class where class_id=$row[class_id]";
                            mysqli_select_db($conn,'school');
                            $result_stu2=mysqli_query($conn,$sql_stu2);
                            if(! $result_stu2){
                                die ("查询失败" .mysqli_error($conn));
                            }
                            while($stu_class2=mysqli_fetch_array($result_stu2)){
                                echo "$stu_class2[class_name]";
                            }
                     ?></td>
                    <td><?php echo $row[score] ?></td>
                    <td><a index="<?php echo $row[id] ?>" class="update">修改</a>&nbsp;&nbsp;&nbsp;<a index="<?php echo $row[id] ?>" class="delete">删除</a></td>
                </tr>
                <?php
            }
            ?>
            <tr><td colspan="7">总计：
                    <?php
                        $sql_count="select count(id) as count from score";
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
            $(".student").load('add_score.php');
        });
        $(".update").click(function(){
            var id=$(this).attr("index");
            $(".student").load('update_score.php?id='+id);
        });
        $(".delete").click(function(){
            var id=$(this).attr("index");
            $(".student").load('delete_score.php?id='+id);
        });
         $("#submit").click(function(){
             var class1=$("#class").val();
             var search1=$("#search").val();
             $(".student").load("search_score.php?class="+class1+"&search="+search1);
         });
    })
</script>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
</body>
</html>