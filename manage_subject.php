<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理课程页面</title>
    <style>
        body{margin: 0;padding:0;}
        .subject{width: 80%;margin: 50px  auto; background-color: #e0e9ff;}
        .subject .add_sub{float:left;margin-right:20px;width: 150px;height: 35px;text-align: center;line-height: 35px;color: #fff;background-color: #666;border-radius: 5px;}
        .subject .add_sub a{text-decoration: none;color: #fff;}
        .subject .sub_list{margin-top: 20px;}
        table td{text-align:center;}
    </style>
    <script src="js/jquery-3.2.1.min.js"></script>
</head>
<?php
error_reporting(0);
$dbhost = 'localhost:3306';  // mysql
$dbuser = 'root';            // mysql ?
$dbpass = '';          // mysql ?
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
    die('连接错误：' . mysqli_error($conn));
}
//echo '链接成功';
mysqli_query($conn,"set names utf8");

$sql="select * from subject order by subject_id desc";
mysqli_select_db($conn,"school");
$result=mysqli_query($conn,$sql);
if(! $result){
    die("查询数据失败" .mysqli_error($conn));
}
?>
<body>
<div class="subject">
    <div class="add_sub"><a>添加课程</a></div>
    <div class="search">
            <select name="class" id="class">
                <option value="1">课程名称</option>
                <option value="2">班主任</option>
            </select>
            <input type="text" name="search" id="search"><input type="submit" value="搜索" id="submit">
    </div>
    <div class="sub_list">
      <form action="more_delete_subject.php" method="get">
        <table width="100%" border=1>
            <tr>
                <th width="10%">选项</th>
                <th width="10%">课程号</th>
                <th width="40%">课程名称</th>
                <th width="30%">班主任</th>
                <th width="10%">操作</th>
            </tr>
            <?php
                while ($row=mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><input type="checkbox" name=de[] value=<?php echo $row[subject_id] ?>></td>
                    <td><?php echo $row[subject_id] ?></td>
                    <td><?php echo $row[subject_name] ?></td>
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
                    <td><a index="<?php echo $row[subject_id] ?>" class="update">修改</a>&nbsp;&nbsp;&nbsp;<a index="<?php echo $row[subject_id] ?>" class="delete">删除</a></td>
                </tr>
            <?php
                }
            ?>
            <tr><td colspan="5">总计：
                    <?php
                        $sql_count="select count(subject_id) as count from subject";
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
        $(".add_sub").click(function () {
            $(".subject").load('add_subject.php');
        });
        $(".update").click(function(){
            var id=$(this).attr("index");
            $(".subject").load('update_subject.php?subject_id='+id);
        });
        $(".delete").click(function(){
            var id=$(this).attr("index");
            $(".subject").load('delete_subject.php?subject_id='+id);
        });
        $("#submit").click(function(){
            var class1=$("#class").val();
            var search1=$("#search").val();
            $(".subject").load("search_subject.php?class="+class1+"&search="+search1);
        });
    });
</script>
<?php
    mysqli_free_result($result);
    mysqli_close($conn);
?>
</body>
</html>