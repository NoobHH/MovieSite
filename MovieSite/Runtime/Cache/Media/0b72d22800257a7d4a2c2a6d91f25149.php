<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>铁头影城 - 铁头宿舍出品</title>
	<meta name="key" content="铁头影城，海量片源在线观看。">
	<meta name="description" content="铁头影城，海量片源在线观看。 - 铁头宿舍出品">
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
	</style>
	<link rel="shortcut icon" href="/TTT/Public/Theme/Common/images/logo.png">
	<link rel="stylesheet" type="text/css" href="/TTT/Public/Theme/Common/css/common.css">
	<link rel="stylesheet" type="text/css" href="/TTT/Public/Theme/Common/css/index.css">
	<link rel="stylesheet" type="text/css" href="/TTT/Public/Theme/Common/css/player.css">
	<link rel="stylesheet" type="text/css" href="/TTT/Public/Theme/Common/css/DPlayer.min.css">
	<link rel="stylesheet" type="text/css" href="/TTT/Public/Theme/Common/css/progress.min.css">

	<script src="/TTT/Plugin/jquery.min.js"></script>
	<script src="/TTT/Plugin/progress.min.js"></script>
	<script type="text/javascript">
		ROOT 	= "/TTT";
		INDEX 	= "/TTT/index.php";
	</script>
	<script src="/TTT/Public/Theme/Common/js/common.js"></script>
	<script src="/TTT/Public/Theme/Common/js/index.js"></script>

	<script type="text/javascript">
		$(function(){
			ajaxMovieItem();
			$(".waterfall-main").scroll(function(){  
				if (noMoreMovie){
					return;
				}
				var viewH = $(this).height(),
					contentH = $(this).get(0).scrollHeight,
					scrollTop = $(this).scrollTop();
				if(contentH - viewH - scrollTop == 0) {
					// 下拉刷新
					ajaxMovieItem();
				}  
			});
		});
	</script>
</head>
<body>
<div class="header">
	<div class="header-main">
		<ul class="nav">
			<li><a href="javascript:;" class="title">铁头影城</a></li>
			<li>
				<a href="javascript:;" onmouseover="tbPanelShow();" onmouseout="tbPanelHide();">淘宝店</a>
				<div class="hover-content tb"><i></i>
					<img class="logo" src="/TTT/Public/Theme/Common/images/logo.png" alt="">
					<h1>铁头宿舍</h1>
					<p>嫩头青的夜场影院</p>
					<img class="ewm" src="/TTT/Public/Theme/Common/images/qr.png" alt="">
					<p class="is">- 淘宝店铺 -</p>
				</div>
			</li>
			<li>
				<a href="javascript:;" onmouseover="zfbPanelShow();" onmouseout="zfbPanelHide();">赞助我们</a>
				<div class="hover-content zfb"><i></i>
					<img class="logo" src="/TTT/Public/Theme/Common/images/logo.png" alt="">
					<h1>铁头宿舍</h1>
					<p>嫩头青的夜场影院</p>
					<img class="ewm" src="/TTT/Public/Theme/Common/images/qr.png" alt="">
					<p class="is">- 支付宝 -</p>
				</div>
			</li>
		</ul>
	</div>
</div>
<div class="container">
	<div class="index">
		<div class="index-main">
			<ul class="nav">
				<li><a href="javascript:;" class="title">铁头影城</a></li>
				<li><a href="javascript:;" title="建设中">铁头BBS</a></li>
				<!-- <li><a href="javascript:;" title="建设中">淘宝店</a></li> -->
			</ul>
			<div class="user-panel">
				<?php if($_SESSION['mail']!= null): ?><a href="javascript:;">余额(<span class="num"><?php echo ($pocket); ?>g</span>)</a>
					<!-- <a href="javascript:;">消息(<span class="num"><?php echo (count($message_list)); ?></span>)</a> -->
					<a href="javascript:;" class="uname">
						<?php echo (substr(session('mail'),0,30)); ?>
						<span class="logout" onclick="ajaxLogout();">注销</span>
					</a>
				<?php else: ?>
					<a href="<?php echo U('/User/Login');?>">登录</a>
					<a href="<?php echo U('/User/Reg');?>">注册</a><?php endif; ?>
			</div>
			<div class="form-search">
				<input type="text" id="key" placeholder="片名">
				<a href="javascript:;" id="search" onclick="setSearchRule();"></a>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="category-main">
			<ul class="ucate">
				<li><a href="javascript:;" onclick="changeMovieGettingRule(this);" rank-type="all" class="choosen default">所有分类</a></li>
				<li><a href="javascript:;" onclick="changeMovieGettingRule(this);" rank-type="record">观看记录</a></li>
				<!-- <li><a href="javascript:;">我的收藏</a></li> -->
			</ul>
			<span>分类</span>
			<ul class="cate">
				<li><a href="javascript:;" onclick="changeMovieGettingRule(this);" rank-type="category">科幻</a></li>
				<li><a href="javascript:;" onclick="changeMovieGettingRule(this);" rank-type="category">喜剧</a></li>
				<li><a href="javascript:;" onclick="changeMovieGettingRule(this);" rank-type="category">动作</a></li>
			</ul>
		</div>
		<div class="waterfall-main">
			<ul class="movie-list"></ul>
		</div>
	</div>
	<div class="log-panel">
		<div class="form">
			<div class="form-option">
				<a href="javascript:;">登录</a>
				<a href="javascript:;" class="unchoosen">注册</a>
			</div>
			<div class="form-login">
				<div class="row">
					<label for="user">邮箱</label>
					<input type="text" id="user" placeholder="邮箱">
				</div>
				<div class="row">
					<label for="password">登录密码</label>
					<input type="password" id="password" placeholder="登录密码">
				</div>
				<div class="row short">
					<a href="javascript:;" class="btn-forget">忘记密码</a>
					<em class="tip"></em>
				</div>
				<input type="button" id="login" value="登录">
			</div>
			<div class="form-reg">
				<div class="row">
					<label for="user">邮箱</label>
					<input type="text" id="user" placeholder="邮箱">
				</div>
				<div class="row">
					<label for="vertify">验证码</label>
					<input type="text" id="vertify" placeholder="验证码">
					<input type="button" id="get_vertify" value="发送验证码">
				</div>
				<div class="row">
					<label for="password">登录密码</label>
					<input type="password" id="password" placeholder="登录密码(6-20位)">
				</div>
				<input type="button" id="reg" value="注册">
			</div>
			
		</div>
	</div>
</div>

<div class="player-panel">
	<div class="action-wrapper">
		<!-- <a href="javascript:;" onclick=";;" class="like"></a> -->
		<a href="javascript:;" onclick="closePlayer();" class="close"></a>
	</div>
	<div class="player-wrapper">
		<div id="player" class="player-main dplayer"></div>
	</div>
</div>

<div class="footer">
	<a href="javascript:;">合作伙伴</a>
	<a href="javascript:;">友情链接</a>
	<a href="javascript:;">淘宝</a>
	<a href="javascript:;">关于我们</a>
	<div class="copyright">
		<a href="javascript:;">Copyright © 2017-2018</a>
		<a href="javascript:;">铁头影城</a>
	</div>
</div>

<script src="/TTT/Plugin/flv.min.js"></script>
<script src="/TTT/Plugin/hls.min.js"></script>
<script src="/TTT/Plugin/DPlayer.min.js"></script>

<script type="text/javascript">
	var player = null;
	/*
	 * 开始播放
	*/
	function play(src, cover){
		$('.player-panel').show();
		if (player === null){
			player = new DPlayer({
		        element: document.getElementById('player'),
		        autoplay: false,
		        theme: '#FADFA3',
		        loop: false,
		        lang: 'en',
		        preload: 'auto', 
		        screenshot: true,
		        hotkey: true,
		        video: {
		            url: src,
		            pic: cover,
		            type: 'auto',
		        },
		        // danmaku: {
		        //     id: '9E2E3368B56CDBB4',
		        //     api: 'https://api.prprpr.me/dplayer/',
		        //     token: 'tokendemo',
		        //     maximum: 3000,
		        //     user: 'DIYgod的女粉'
		        // }
		    });
		    return;
		}
		player.switchVideo({
            url: src,
            pic: cover,
            type: 'auto',
        });
	}

	/*
	 * 关闭播放器
	*/
	function closePlayer(){
		$('.player-panel').hide();
		if (player){
			player.pause();
		}
	}


	/*
	 * 购买商品
	*/
	function purchaseItem(obj){
		// var src 	= obj.getAttribute('media-src');
		var cover 	= obj.getAttribute('media-cover');
		var guid 	= obj.getAttribute('media-guid');

		$.ajax({
			url : INDEX + "/Media/purchase/purchase",
			type : "POST",
			data : {
				'guid' : guid,
			},
			dataType : "json",
			success : function(result) {
				if (result.success){
					play(result.data.src, cover);
				}else{
					console.log(result);
				}
			},
			error:function(msg){
				console.log(msg);
			}
		});
	}
</script>
</body>
</html>