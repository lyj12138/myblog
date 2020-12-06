<?php ini_set('display_errors','Off'); ?>
<?php session_start(); $_SESSION['user_id']=0;?>
<html>
<head>
    <title>用户注册</title>
    <link rel="shortcut icon" type="image/x-icon" href="../static/images/web-icon.png" media="screen" />
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
    <script src="../static/js/jquery-3.2.1.min.js"></script>
    <script src="../static/js/bootstrap.min.js"></script>

    <style>
        #myCarousel{
            margin-left: 2%;
            width: 900px;
            height: 80%;
            float: left;
            z-index: 999;
            display: inline;
        }
        #login{
            float: left;
            height: 250px;
            width: 330px;
            margin-left: 6%;
            margin-top: 9%;
            display: inline;
            z-index: 999;
        }
        body{
            padding:0;
            margin:0;
        }
    </style>
    <script>
        $(function(){
            $('#myCarousel').carousel({
                interval: 2000
            })
        });
    </script>
</head>
<body>
<h2 style="text-align: center;font-family: 'Adobe 楷体 Std R';color: black">博客管理系统</h2>
<div style="float:right;" id="github_iframe"></div>
<script>
    ! function() {
        //封装方法，压缩之后减少文件大小
        function get_attribute(node, attr, default_value) {
            return node.getAttribute(attr) || default_value;
        }
        //封装方法，压缩之后减少文件大小
        function get_by_tagname(name) {
            return document.getElementsByTagName(name);
        }
        //获取配置参数
        function get_config_option() {
            var scripts = get_by_tagname("script"),
                script_len = scripts.length,
                script = scripts[script_len - 1]; //当前加载的script
            return {
                l: script_len, //长度，用于生成id用
                z: get_attribute(script, "zIndex", -1), //z-index
                o: get_attribute(script, "opacity", 0.5), //opacity
                c: get_attribute(script, "color", "0,0,0"), //color
                n: get_attribute(script, "count", 99) //count
            };
        }
        //设置canvas的高宽
        function set_canvas_size() {
            canvas_width = the_canvas.width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
                canvas_height = the_canvas.height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
        }
        //绘制过程
        function draw_canvas() {
            context.clearRect(0, 0, canvas_width, canvas_height);
            //随机的线条和当前位置联合数组
            var e, i, d, x_dist, y_dist, dist; //临时节点
            //遍历处理每一个点
            random_points.forEach(function(r, idx) {
                r.x += r.xa,
                    r.y += r.ya, //移动
                    r.xa *= r.x > canvas_width || r.x < 0 ? -1 : 1,
                    r.ya *= r.y > canvas_height || r.y < 0 ? -1 : 1, //碰到边界，反向反弹
                    context.fillRect(r.x - 0.5, r.y - 0.5, 1, 1); //绘制一个宽高为1的点
                //从下一个点开始
                for (i = idx + 1; i < all_array.length; i++) {
                    e = all_array[i];
                    // 当前点存在
                    if (null !== e.x && null !== e.y) {
                        x_dist = r.x - e.x; //x轴距离 l
                        y_dist = r.y - e.y; //y轴距离 n
                        dist = x_dist * x_dist + y_dist * y_dist; //总距离, m
                        dist < e.max && (e === current_point && dist >= e.max / 2 && (r.x -= 0.03 * x_dist, r.y -= 0.03 * y_dist), //靠近的时候加速
                            d = (e.max - dist) / e.max,
                            context.beginPath(),
                            context.lineWidth = d / 2,
                            context.strokeStyle = "rgba(" + config.c + "," + (d + 0.2) + ")",
                            context.moveTo(r.x, r.y),
                            context.lineTo(e.x, e.y),
                            context.stroke());
                    }
                }
            }), frame_func(draw_canvas);
        }
        //创建画布，并添加到body中
        var the_canvas = document.createElement("canvas"), //画布
            config = get_config_option(), //配置
            canvas_id = "c_n" + config.l, //canvas id
            context = the_canvas.getContext("2d"), canvas_width, canvas_height,
            frame_func = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(func) {
                window.setTimeout(func, 1000 / 45);
            }, random = Math.random,
            current_point = {
                x: null, //当前鼠标x
                y: null, //当前鼠标y
                max: 20000 // 圈半径的平方
            },
            all_array;
        the_canvas.id = canvas_id;
        the_canvas.style.cssText = "position:fixed;top:0;left:0;z-index:" + config.z + ";opacity:" + config.o;
        get_by_tagname("body")[0].appendChild(the_canvas);
        //初始化画布大小
        set_canvas_size();
        window.onresize = set_canvas_size;
        //当时鼠标位置存储，离开的时候，释放当前位置信息
        window.onmousemove = function(e) {
            e = e || window.event;
            current_point.x = e.clientX;
            current_point.y = e.clientY;
        }, window.onmouseout = function() {
            current_point.x = null;
            current_point.y = null;
        };
        //随机生成config.n条线位置信息
        for (var random_points = [], i = 0; config.n > i; i++) {
            var x = random() * canvas_width, //随机位置
                y = random() * canvas_height,
                xa = 2 * random() - 1, //随机运动方向
                ya = 2 * random() - 1;
            // 随机点
            random_points.push({
                x: x,
                y: y,
                xa: xa,
                ya: ya,
                max: 6000 //沾附距离
            });
        }
        all_array = random_points.concat([current_point]);
        //0.1秒后绘制
        setTimeout(function() {
            draw_canvas();
        }, 100);
    }();
</script>
<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="../static/images/1.jpg" alt="第一张">
        </div>
        <div class="item">
            <img src="../static/images/2.jpg" alt="第二张">
        </div>
        <div class="item">
            <img src="../static/images/3.jpg" alt="第三张">
        </div>

    </div>
    <a class="carousel-control left" href="#myCarousel"
       data-slide="prev">&lsaquo;
    </a>
    <a class="carousel-control right" href="#myCarousel"
       data-slide="next">&rsaquo;
    </a>
</div>
<div  id="login">

    <div class="form-inline"  >
        <div class="input-group">
            <span class="input-group-addon">用户名</span>
            <input type="text" class="form-control" name="username" id="username">
        </div>
        <br/><br/>
        <div class="input-group">
            <span class="input-group-addon">密码</span>
            <input type="password" class="form-control" name="passwd" id="passwd">
        </div>
        <br/><br/>
        <div class="input-group">
            <span class="input-group-addon">重复密码</span>
            <input type="password" class="form-control" name="repasswd" id="repasswd">
        </div>
        <br/><br/>
        <div class="input-group">
            <span class="input-group-addon">邮箱</span>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <br/><br/>
        <div class="input-group">
            <span class="input-group-addon">昵称</span>
            <input type="text" class="form-control" name="nickname" id="nickname">
        </div>
        <br/><br/>
        <p style="text-align: right;color: red;position: absolute" id="info"></p>
        <br/>
        <button id="loginButton"  class="btn btn-primary">注册
        </button>

    </div>
    <script>
        var regUpper=/[A-Z]/;
        var regLower=/[a-z]/;
        var regNum=/[0-9]/;
        var regEmail=/^[0-9a-zA-Z_.-]+[@][0-9a-zA-Z_.-]+([.][a-zA-Z]+){1,2}$/;
        $("#username").keyup(
            function(){
                if($("#username").val()==''){
                    $("#info").text("提示:用户名不能为空");
                } else if($("#username").val().length<3)
                {
                    $("#info").text("提示:用户名长度必须大于3");
                }
                else{
                    $("#info").text("");
                }
            }
        )
        $("#nickname").keyup(
            function(){
                if($("#nickname").val()==''){
                    $("#info").text("提示:用户名不能为空");
                } else if($("#nickname").val().length<3)
                {
                    $("#info").text("提示:昵称长度必须大于3");
                }
                else{
                    $("#info").text("");
                }
            }
        )
        $("#email").keyup(
            function(){
                if($("#email").val()==''){
                    $("#info").text("提示:邮箱不能为空");
                } else if(!regEmail.test($("#email").val()))
                {
                    $("#info").text("提示:邮箱格式不合法");
                }
                else{
                    $("#info").text("");
                }
            }
        )
        $("#passwd").keyup(
            function(){
                if($("#passwd").val()==''){
                    $("#info").text("提示:密码不能为空");
                } else if(!(regUpper.test($("#passwd").val())&&regLower.test($("#passwd").val())&&regNum.test($("#passwd").val())&&$("#passwd").val().length>=8))
                {
                    $("#info").text("提示:密码必须为不小于八位的数字大写小写字母组合");
                }
                else{
                    $("#info").text("");
                }
            }
        )
        $("#repasswd").keyup(
            function () {
                if($("#repasswd").val()!=$("#passwd").val()){
                    $("#info").text("提示:两次输入的密码不一致");
                }
                else {
                    $("#info").text("");
                }
            }
        )
        $("#loginButton").click(function () {
            if($("#username").val()==''&&$("#passwd").val()==''){
                $("#info").text("提示:用户名和密码不能为空");
            }
            else if ($("#username").val()==''){
                $("#info").text("提示:用户名不能为空");   
            }
            else if($("#passwd").val()==''){
                $("#info").text("提示:密码不能为空");
            }
            else if($("#repasswd").val()!=$("#passwd").val()){
                $("#info").text("提示:两次输入的密码不一致");
            }
            else if(!(regUpper.test($("#passwd").val())&&regLower.test($("#passwd").val())&&regNum.test($("#passwd").val())&&$("#passwd").val().length>=8))
            {
                $("#info").text("提示:密码必须为不小于八位的数字大写小写字母组合");
            }
            else if($("#nickname").val()=='')
            {
                $("#info").text("提示:昵称不能为空");
            }
            else if($("#nickname").val().length<3)
            {
                $("#info").text("提示:昵称长度不能小于3");
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "register_user.php",
                    data: {
                        username:$("#username").val() ,
                        password: $("#passwd").val(),
                        email:$("#email").val(),
                        nickname:$("#nickname").val()
                    },
                    success: function(data) {
                            if(data==2)
                            {
                            $("#info").text("提示:用户注册成功，激活创作权限需后台审核通过，跳转中...");
                            window.location.href="./userblog.php";
                            }
                            else if(data==1){
                                $("#info").text("提示:该用户名已被注册");
                            }
                            else{
                                $("#info").text("提示:该邮箱已被注册");
                            }
                    }
                });
            }
        })

    </script>

</div>

</body>
</html>