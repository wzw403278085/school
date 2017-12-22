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
    $sql="select * from  teacher where tea_name like '%".$txt."%'";
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
            <th>id</th>
            <th>姓名</th>
            <th>操作</th>
        </tr>
        <?php
            while($row=mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row[tea_id] ?></td>
            <td><?php echo $row[tea_name] ?></td>
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









