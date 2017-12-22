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
    $sql="select * from  subject where subject_name like '%".$txt."%'";
}
if($class=="2"){
    $sql_c="select * from teacher where tea_name LIKE '%".$txt."%'";
    mysqli_select_db($conn,'school');
    $result_c=mysqli_fetch_array(mysqli_query($conn,$sql_c));
    if(! $result_c){
        die ("查询失败" .mysqli_error($conn));
    }
    $sql="select * from subject where tea_id=$result_c[tea_id]";
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
            <th>课程号</th>
            <th>课程名</th>
            <th>班主任</th>
            <th>操作</th>
        </tr>
        <?php
            while($row=mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row[subject_id] ?></td>
            <td><?php echo $row[subject_name] ?></td>
            <td><?php
                   $sql_class="select * from teacher where tea_id=$row[tea_id]";
                   mysqli_select_db($conn,'school');
                   $result_stu=mysqli_query($conn,$sql_class);
                   if(! $result_stu){
                       die ("查询失败" .mysqli_error($conn));
                   }
                   while($stu_class=mysqli_fetch_array($result_stu)){
                       echo "$stu_class[tea_name]";
                   }
            ?></td>
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