<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理系统添加教师页面</title>
    <script src="js/jquery-3.2.1.min.js"></script>
    <style>
        body,html{height: 100%;}
        *{margin: 0;padding: 0;box-sizing: border-box;}
        .box{width: 100%;height: 100%;}
        .top{height: 10%;background-color: #FFD777;text-align:center;line-height:60px;font-size:35px;}
        .con{height: 90%}
        .con .left{float: left;padding-top:30px;height: 100%;width: 15%;background-color: #434A5D;}
        .con .right{float: left;height: 100%;width: 85%;background-color: #F2F2F2;text-align: center;}
        .con .right h1{position: relative; top: 40%;width: 100%;height: 100px;margin-top: 50px;font-size: 50px;color: #000;}
        .con .left ul{list-style: none;width: 100%;}
        .con .left ul li {width: 100%;height: 40px; line-height: 40px;font-size: 18px;text-align: center;color: #fff;}
        .con .left ul li.cur{color: #333;background: #94faf0;}
    </style>
</head>
<body>
<div class="box">
    <div class="top">管理系统</div>
    <div class="con">
        <div class="left">
            <ul>
                <li>教师管理</li>
                <li>课程管理</li>
                <li>班级管理</li>
                <li>学生管理</li>
                <li>成绩管理</li>
            </ul>
        </div>
        <div class="right">
            <h1>欢迎来到教师管理系统</h1>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".left ul li").click(function () {
            $(this).addClass("cur").siblings().removeClass("cur");
        });
        $(".left ul li:nth-child(1)").click(function () {
            $(".right").load('manage_teacher.php');
        });
        $(".left ul li:nth-child(2)").click(function () {
            $(".right").load('manage_subject.php');
        });
        $(".left ul li:nth-child(3)").click(function () {
            $(".right").load('manage_class.php');
        });
        $(".left ul li:nth-child(4)").click(function () {
            $(".right").load('manage_student.php');
        });
        $(".left ul li:nth-child(5)").click(function () {
            $(".right").load('manage_score.php');
        });
    })
</script>
</body>
</html>