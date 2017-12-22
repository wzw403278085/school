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

$class=$_GET['class'];
$txt=$_GET['search'];
if($class=="1"){
    $sql="select * from  score where stu_id=$txt";
}
if($class=="2"){
    $sql_c="select * from class where class_name LIKE '%".$txt."%'";
    mysqli_select_db($conn,'school');
    $result_c=mysqli_fetch_array(mysqli_query($conn,$sql_c));
    if(! $result_c){
        die ("查询失败" .mysqli_error($conn));
    }
    $sql="select * from score where class_id=$result_c[class_id]";
}
if($class=="3"){
    $sql="select * from  score where score=$txt";
}
mysqli_select_db($conn,'school');
$result=mysqli_query($conn,$sql);
if(! $result){
    die("搜索失败" .mysqli_error($conn));
}
?>

<div>
    <table width="100%" border="1">
        <tr>
            <th>排名</th>
            <th>学号</th>
            <th>姓名</th>
            <th>班级</th>
            <th>分数</th>
            <th>操作</th>
        </tr>
        <?php
            while($row=mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row[id] ?></td>
            <td><?php echo $row[stu_id] ?></td>
            <td><?php
                   $sql_stu1="select * from student where stu_id=$row[stu_id]";
                   mysqli_select_db($conn,'school');
                   $result_stu1=mysqli_query($conn,$sql_stu1);
                   if(! $result_stu1){
                       die ("查询失败" .mysqli_error($conn));
                   }
                   while($stu_class1=mysqli_fetch_array($result_stu1)){
                       echo "$stu_class1[stu_name]";
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
            <td><?php echo $row[score] ?></td>
            <td><a>修改</a>&nbsp;&nbsp;&nbsp;<a>删除</a></td>
        </tr>

        <?php
            }
        ?>
    </table>
</div>


<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
