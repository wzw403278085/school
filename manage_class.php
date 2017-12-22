<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理班级页面</title>
    <style>
        body{margin: 0;padding:0;}
        .class{width: 80%;margin: 50px  auto; background-color: #e0e9ff;}
        .class .add_tea{float:left;margin-right:20px; width: 150px;width: 150px;height: 35px;text-align: center;line-height: 35px;color: #fff;background-color: #666;border-radius: 5px;}
        .class .add_tea a{text-decoration: none;color: #fff;}
        .class .tea_list{margin-top: 20px;}
        table td{text-align:center;}
    </style>
    <script src="js/jquery-3.2.1.min.js"></script>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: 11
 * Date: 2017/9/16
 * Time: 11:01
 */
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

$sql="select * from class order by class_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<body>
<div class="class">
    <div class="add_tea"><a>添加班级</a></div>
    <div class="search">
            <select name="class" id="class">
                <option value="1">班级名</option>
                <option value="2">班主任</option>
            </select>
            <input type="text" name="search" id="search"><input type="submit" value="搜索" id="submit">
    </div>
    <div class="tea_list">
     <form action="more_delete_class.php" method="get">
        <table width="100%" border=1>
            <tr>
                <th width="10%">选项</th>
                <th width="10%">班级号</th>
                <th width="50%">班级名</th>
                <th width="20%">班主任</th>
                <th width="10%">操作</th>
            </tr>
            <?php
            while ($row=mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><input type="checkbox" name=de[] value=<?php echo $row[class_id] ?>></td>
                    <td><?php echo $row[class_id] ?></td>
                    <td><?php echo $row[class_name] ?></td>
                    <td><?php
                          $sql_teaName="select * from teacher where tea_id=$row[tea_id]";
                          mysqli_select_db($conn,'school');
                          $result_tea=mysqli_query($conn,$sql_teaName);
                          if(! $result_tea){
                              die ("查询失败！" .mysqli_error($conn));
                          }
                          while ($teaName=mysqli_fetch_array($result_tea)){
                              echo "$teaName[tea_name]";
                          }
                      ?></td>
                    <td><a index="<?php echo $row[class_id] ?>" class="update">修改</a>&nbsp;&nbsp;&nbsp;<a index="<?php echo $row[class_id] ?>" class="delete">删除</a></td>
                </tr>
                <?php
            }
            ?>
            <tr><td colspan="5">总计：
                    <?php
                        $sql_count="select count(class_id) as count from class";
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
            <tr><td colspan="5"><input type="submit" value="批量删除"></td></tr>
        </table>
       </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".add_tea").click(function () {
            $(".class").load('add_class.php');
        });
        $(".update").click(function(){
            var id=$(this).attr("index");
            $(".class").load('update_class.php?class_id='+id);
        });
        $(".delete").click(function(){
            var id=$(this).attr("index");
            $(".class").load('delete_class.php?class_id='+id);
        });
        $("#submit").click(function(){
            var class1=$("#class").val();
            var search1=$("#search").val();
            $(".class").load("search_class.php?class="+class1+"&search="+search1);
        });
    })
</script>
<?php
    mysqli_free_result($result);
    mysqli_close($conn);
?>
</body>
</html>