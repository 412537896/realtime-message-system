<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/common.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.11.0.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/web_socket.js"></script>
<script type="text/javascript" src="js/msg-websoket.js"></script>
<title>好雨消息推送平台</title>
<style type="text/css">
.navbar-inverse {
/*  background-color: RGB(3,111,177);  */
 background-color: RGB(64,147,216); 
}
.navbar-inverse .navbar-nav>li>a{
color: #fff;
}
.navbar-inverse .navbar-nav>li>a:hover,
.navbar-inverse .navbar-nav>li>a:focus
{
background-color: #5d7895;
}
.navbar-inverse .navbar-nav>.open>a, 
.navbar-inverse .navbar-nav>.open>a:hover, 
.navbar-inverse .navbar-nav>.open>a:focus {
color: #fff;
background-color: #5d7895;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("#submit").click(function(){
		var code = $("#code").val();
		var topic = $("#topic").val();
		var token = $("#token").val();
		var content = $("#content").val();
		var param = $("#form1").serialize();
		$.ajax({
			type: "post",
			async : false ,
		  	url: "postData.php",  
		  	data: {
		  		topic : code+"_"+topic,
		  		token : token,
		  		content : content,
		  	},
	  	  	success: function(msg) {
// 	  	  		alert(msg);
	  	  	}
		});
	});
});
	extPushWebSocketClient.prototype = {
		onMessage : function(msg) {
			var ta = document.getElementById('responseText');
			if (ta.value == "") {
				ta.value = msg
			} else {
				ta.value = ta.value + '\n' + msg
			}
		}
	}
	var connect = new extPushWebSocketConnect();
	connect.init(new extPushWebSocketClient());

	function sub(_type) {
	    var ws = $("#code").val();
		var code = $("#code").val();
		var topic = $("#topic").val();
		var token = $("#token").val();

		connect.sendCmd(ws,code+"_"+topic, _type, token,Math.ceil(Math.random()*100));
	}
</script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="color: #FFFFFF;" href="index.php">好雨消息推送平台</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
	          <?php include 'head.php'; ?>
	       	</div>
		</div>
	</nav>
	<div class="container-fluid">
		<h3 class="page-header" style="margin-top: 28px;">在线演示</h3>
		<div class="alert alert-info" role="alert" style="line-height: 30px;"><strong>说明</strong>：请用户参照<strong>使用手册</strong>的说明进行操作。在用户创建完成应用和实体后，会得到系统返回的Token。用户就可以使用<strong>应用代码</strong>、<strong>实体名称</strong>和<strong>Token</strong>值，进行消息的订阅和发布功能了。<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注意，实体编辑完成后，会在5分钟以内生效。请参考以下<strong>在线演示</strong>。</div>
	</div>
	
	<div class="container-fluid">
		<ul class="nav nav-tabs" role="tablist">
		  <li role="presentation"><a href="demo.php">WebSocket</a></li>
		  <li role="presentation"><a href="http_demo.php">HTTP</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="container-fluid">
			<h4 style="color: #428bca; margin-top: 20px;">
				<strong>WebSocket实例演示：</strong>
			</h4>
			<div class="col-md-6"
				style="border-right: thin; border-right-color: #eee; border-right-style: solid; margin-top: 5px; padding: 0 40px;">
				<h4>发布</h4>
				<form id="form1" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="code" class="col-md-2 col-lg-2 control-label">ws地址</label>
						<div class="col-md-9 col-lg-9">
							<input type="text" class="form-control" id="ws" name="ws"
								placeholder="ws地址" value="ws://">
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-md-2 col-lg-2 control-label">应用代码</label>
						<div class="col-md-9 col-lg-9">
							<input type="text" class="form-control" id="code" name="code"
								placeholder="应用代码" value="msgAdmin">
						</div>
					</div>
					<div class="form-group">
						<label for="topic" class="col-md-2 col-lg-2 control-label">实体名称</label>
						<div class="col-md-9 col-lg-9">
							<input type="text" class="form-control" id="topic" name="topic"
								placeholder="实体名称" value="demo">
						</div>
					</div>
					<div class="form-group">
						<label for="token"
							class="col-sm-2 col-md-2 col-lg-2 control-label">Token</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<input type="text" class="form-control" id="token" name="token"
								value="b05b6e6d3d35d41220aac1b971f30d4d">
						</div>
					</div>
					<div class="form-group">
						<label for="content"
							class="col-sm-2 col-md-2 col-lg-2 control-label">发布内容</label>
						<div class="col-sm-9 col-md-9 col-lg-9">
							<textarea rows="3" cols="" class="form-control" id="content"
								name="content" placeholder="发布内容">This is Demo</textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-9">
							<input type="button" class="btn btn-primary" value="订阅"
								onclick="sub('sub')" /> <input type="button"
								class="btn btn-primary" value="取消订阅" onclick="sub('unsub')" /> <input
								type="button" id="submit" class="btn btn-primary" value="发布" />
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6" style="padding: 0 40px; margin-top: 5px;">
				<h4>订阅</h4>
				<textarea id="responseText" class="form-control" rows="6"></textarea>
			</div>
		</div>
	</div>
</body>
</html>