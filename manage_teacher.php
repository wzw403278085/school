<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理教师页面</title>
    <style>
        body{margin: 0;padding:0;}
        .teacher{width: 80%;margin: 50px  auto; background-color: #e0e9ff;}
        .teacher .add_tea{float:left;margin-right:20px; width: 150px;height: 35px;text-align: center;line-height: 35px;color: #fff;background-color: #666;border-radius: 5px;}
        .teacher .more_add{float:left;margin-right:20px; width: 150px;height: 35px;text-align: center;line-height: 35px;color: #fff;background-color: #666;border-radius: 5px;}
        .teacher .add_tea a{text-decoration: none;color: #fff;}
        .teacher .tea_list{margin-top: 20px;}
        table{border-collapse:collapse;}
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

$sql="select * from teacher order by tea_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<body>
<div class="teacher">
        <div class="add_tea"><a>添加教师</a></div><div class=more_add>批量添加教师</div>
    <div class="search">
            <select name="class" id="class">
                <option value="1">姓名</option>
            </select>
            <input type="text" name="search" id="search"><input type="submit" value="搜索" id="submit">
    </div>
    <div class="tea_list">
       <form action="more_delete_teacher.php" method="get">
        <table width="100%" border=1>
            <tr>
                <th width="10%">选项</th>
                <th width="10%">id</th>
                <th width="70%">姓名</th>
                <th width="10%">操作</th>
            </tr>
            <?php
            while ($row=mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><input type="checkbox" name=de[] value=<?php echo $row[tea_id] ?>></td>
                    <td><?php echo $row[tea_id] ?></td>
                    <td><?php echo $row[tea_name] ?></td>
                    <td><a index="<?php echo $row[tea_id] ?>" class="update">修改</a>&nbsp;&nbsp;&nbsp;<a index="<?php echo $row[tea_id] ?>" class="delete">删除</a></td>
                </tr>
                <?php
            }
            ?>
            <tr><td colspan="4">总计：
                    <?php
                        $sql_count="select count(tea_id) as count from teacher";
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
            <tr><td colspan="4"><input type="submit" value="批量删除"></td></tr>
        </table>
       </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".add_tea").click(function () {
            $(".teacher").load('add_teacher.php');
        });
        $(".more_add").click(function () {
            $(".teacher").load('more_add_teacher.php');
        });
        $(".update").click(function(){
            var id=$(this).attr("index");
            $(".teacher").load('update_teacher.php?tea_id='+id);
        });
        $(".delete").click(function(){
            var id=$(this).attr("index");
            $(".teacher").load('delete_teacher.php?tea_id='+id);
        });
        $("#submit").click(function(){
            var class1=$("#class").val();
            var search1=$("#search").val();
            $(".teacher").load("search_teacher.php?class="+class1+"&search="+search1);
        });
    })
</script>
<?php
    mysqli_close($conn);
?>
</body>
</html>