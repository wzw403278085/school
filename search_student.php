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
    $sql="select * from  student where stu_name like '%".$txt."%'";
}
if($class=="2"){
    $sql="select * from  student where stu_age=$txt";
}
if($txt=='男'){
     $sql="select * from  student where stu_sex=0";
 }
if($txt=='女'){
      $sql="select * from  student where stu_sex=1";
 }
if($class=="4"){
    $sql_c="select * from class where class_name LIKE '%".$txt."%'";
    mysqli_select_db($conn,'school');
    $result_c=mysqli_fetch_array(mysqli_query($conn,$sql_c));
    if(! $result_c){
        die ("查询失败" .mysqli_error($conn));
    }
    $sql="select * from student where class_id=$result_c[class_id]";
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
            <th>学号</th>
            <th>姓名</th>
            <th>年龄</th>
            <th>性别</th>
            <th>班级</th>
            <th>操作</th>
        </tr>
        <?php
            while($row=mysqli_fetch_array($result)){
        ?>
        <tr>
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









