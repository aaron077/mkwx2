<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title id="title">八客互动</title>
<base href="<?php  echo base_url();?>"/>
<link rel="stylesheet" type="text/css" href="application/views/css/style.css">
<link rel="stylesheet" type="text/css" href="application/views/css/talk_style.css">

<style type="text/css">
	.bubble {
		width:100%;
		height:280px;
		position:relative;
		margin:0px;
		padding:0px;
		font-size:12px;
		-webkit-font-smoothing:antialiased;
		line-height:1.5;
	}
	
	svg {
		position:absolute;
		overflow:hidden;
		font-size:12px;
		-webkit-font-smoothing:antialiased;
		line-height:1.5;
		bottom:0px;
	}
</style>
</head>

<body>
<div id="index_page">
	<div id="_centent" style="z-index:100;margin:0px">
		<!--
		<header style="display:none">
			<div class="rt-bk">
				<i class="bk"></i>
				<p>返回</p>
			</div>
			<div class="top-name"><p>八客互动</p></div>
		</header>
		-->
		
		<div class="head" style="border:1px solid green;position:absolute;top:0px">
			<div class="head-img">
				<img id="singer_img" style="border-radius:1rem">
			</div>
			<div class="head-dsb" style="font-size:8px">
				歌手昵称：<p class="dsb-name" id="singer_nickname" style="display:inline">aa</p><br>
				爱心值：<p class="dsb-id" id="singer_lovecount" style="display:inline"></p><br>
				活跃度：<p class="dsb-id" id="singer_liveness" style="display:inline"></p>
				<a href="javascript:void(0);" onclick="showOnline()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在线人数：<p class="dsb-id" id="onlinecount" style="display:inline;font-size:12">0</p></a>
				
				<a href="javascript:void(0);" onclick="showPayPage()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;购买八客币</a>
				<a href="http://www.tpy10.net/ewm.php?name=kspzwm">关注</a>
			</div>
		</div>
	</div>
	
	<div id="player-praises" style="width:72px;height:337px;position:fixed;-webkit-font-smoothing:antialiased;bottom:40px;right:5px;margin:0px;padding:0px;font-size:12px;line-height:1.5;">
		<div class="bubble" id="bubble_div">
			
		</div>
	</div>
	<div id="add_love_icon"  style="position:fixed;bottom:50px;right:20px;overflow-y: scroll;overflow-x: hidden;">
		<a href="javascript:void(0);" onclick="add_singerlove()"><img src="application/views/img/love.jpg" style="width:40px;height:40px"></img></a>
	</div>

	<!--
	<div id="convo" data-from="Sonu Joshi" style="margin:0px;position:relative">  
		<ul class="chat-thread">
			<li>Are we meeting today?</li>
			<li>yes, what time suits you?</li>
			<li>I was thinking after lunch, I have a meeting in the morning</li>
			<li>Are we meeting today?</li>
			<li>yes, what time suits you?</li>
			<li>I was thinking after lunch, I have a meeting in the morning</li>
			<li>Are we meeting today?</li>
			<li>yes, what time suits you?</li>
			<li>I was thinking after lunch, I have a meeting in the morning</li>
			<li>Are we meeting today?</li>
			<li>yes, what time suits you?</li>
			<li>I was thinking after lunch, I have a meeting in the morning</li>
		</ul>
	</div>-->
	
	<div id="msg" style="position:fixed;bottom:0.9rem;z-index:-1">
		<div>
			<ul style="font-size:0.2rem;margin-top:0.2rem" id="msg_list">
			</ul>
		</div>
	</div>

	<footer>
		<div id="bkfoot">
			<div class="mune">
				<img src="img/1.png">
				<a href="javascript:void(0)" onclick="showMsgInput();">消息</a>
			</div>
			<div class="mune" style="border-left:1px solid #f7f7f7">
				<img src="img/2.png">
				<a href="javascript:void(0)" onclick="showGift()">礼物</a>
			</div>
			<div class="mune" style="border-left:1px solid #f7f7f7">
				<img src="img/4.png">
				<a href="javascript:void(0)" onclick="showUserInfo()">个人中心</a>
			</div> 
		</div>
		
		<div id="inputmsg" style="display:none">
			<input type="checkbox" id="danmu" checked="unchecked">弹幕</input>
			<input type="text" id="sendmsgtxt"></input>
			<a id="emoji" href="javascript:void(0)" onclick="sendEmoji()">表情符号</a>
			<a id="sendmsg" onclick="sendUserMsg();">发送消息</a>
		</div>
		
		<div id="giftdiv" style="display:none;position:absolute;bottom:40%;">
			<ul id="gift_list">
			</ul>
		</div>
	</footer>
</div>
<!------------------------首页------------------------->



<!---------------------所有与在线人页面-------------->
<div id="online_page" style="display:none;width:100%">
	<ul id="online_ul" style="width:100%">
	</ul>
</div>
<!---------------------所有与在线人页面-------------->


<div id="recharge_page" style="display:none; font-size:14px">
	八客币余额：<div id="left_money">0</div><br>
	60豆：<input type="radio" checked="checked" name="money_count" value="60" /><br>
	300豆：<input type="radio" checked="checked" name="money_count" value="300" /><br>
	980豆：<input type="radio" name="money_count" value="980" /><br>
	<br>
	<br>
	<a href="javascript:void(0)" onclick="pay()" style="background-color:#ff0a0a">立即购买</a>
</div>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="http://dream.waimaipu.cn/application/views/js/jquery.svg.package-1.5.0/jquery.svg.js"></script>
<script src="http://119.29.10.176/plhwin/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>	
	function chooseImage() 
	{
		wx.chooseImage({
				success: function (result) {
					alert("chooseImage succeed.");
					//dosomething
				}
			});
	}
	/*$(document).ready(function () {
	alert("我的第一个jQuery代码!");
	});*/

	$(document).ready(function() 
	{
		var url = window.location.href;
		$.post(
				"http://dream.waimaipu.cn/index.php/user/data_config",
				{
					url:url
				},
				function(json) {
					if(json.code != 0)
					{//查询失败，后面考虑如何提示(thinklater)
						return;
					}

					var data_config = {
						debug: true,
						appId: json.data["appId"],
						timestamp: json.data["timestamp"],
						nonceStr: json.data["nonceStr"],
						signature: json.data["signature"],
						jsApiList: ['onMenuShareAppMessage', 'onMenuShareAppMessage', 'hideMenuItems', 'showMenuItems', 'chooseImage']
					};
					wx.config(data_config);
					
					wx.ready(function() {
						
						wx.showMenuItems({
							menuList: [
								'menuItem:profile', // 添加查看公众号
								'menuItem:addContact'
							]
						});
						

						wx.onMenuShareTimeline({
							title: $("#title").val(), // 分享标题
							link: "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0523023df5aa4bf1&redirect_uri=http://dream.waimaipu.cn/index.php/user/login&response_type=code&scope=snsapi_userinfo&state=barid%3D1%26deskid%3D2#wechat_redirect", // 分享链接
							imgUrl: "http://o95rd8icu.bkt.clouddn.com/%E4%B8%8B%E8%BD%BD.jpg", // 分享图标
							success: function() {alert("分享到朋友圈成功！");},
							cancel: function() {alert("分享到朋友圈失败！");}
						});
						
						wx.onMenuShareAppMessage({
							title: $("#title").val(), // 分享标题
							desc: $("#title").val(), // 分享描述
							link: "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0523023df5aa4bf1&redirect_uri=http://dream.waimaipu.cn/index.php/user/login&response_type=code&scope=snsapi_userinfo&state=barid%3D1%26deskid%3D2#wechat_redirect", // 分享链接
							imgUrl: "http://o95rd8icu.bkt.clouddn.com/%E4%B8%8B%E8%BD%BD.jpg", // 分享图标
							type: '', // 分享类型,music、video或link，不填默认为link
							dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
							success: function() {alert("分享到朋友成功！");},
							cancel: function() {alert("分享到朋友失败！");}
						});
						
					});
					
					wx.error(function(res) {
						//alert("errorMSG:"+JSON.stringify(res));
					});
				},
				"json"
		);
	});
	
	function getRandomColor() { 
		return "#"+("00000"+((Math.random()*16777215+0.5)>>0).toString(16)).slice(-6); 
	} 
 
	function LoveCatoon()
	{
		var bubble = document.getElementById("bubble_div");
		var color = getRandomColor();
		var svg=document.createElementNS('http://www.w3.org/2000/svg','svg'); 
		svg.innerHTML = '<path class="svgpath" style="fill:'+color+';stroke: #FFF; stroke-width: 1px;" d="M11.29,2C7-2.4,0,1,0,7.09c0,4.4,4.06,7.53,7.1,9.9,2.11,1.63,3.21,2.41,4,3a1.72,1.72,0,0,0,2.12,0c0.79-.64,1.88-1.44,4-3,3.09-2.32,7.1-5.55,7.1-9.94,0-6-7-9.45-11.29-5.07A1.15,1.15,0,0,1,11.29,2Z"></path>';
		svg.setAttribute("style", "left: 20px; bottom: 20px; opacity: 0.9; width: 32px; height: 32px;");
		svg.setAttribute("ViewBox", "-1 -1 27 27");
		
		var obj = bubble.appendChild(svg);
		svg.left = 20;
		svg.bottom = 20;
		svg.opacity = 0.9;
		svg.dirLeft = Math.floor(Math.random()*50)%2;
		var time = Math.floor(Math.random()*50+50);//50-100
		var sh = setInterval(function() {
			svg.bottom += 4;
			svg.opacity -= 0.02;
			if(svg.dirLeft == 1)
			{
				svg.left = svg.left - 2;
				if(svg.left <= 6)
				{
					svg.dirLeft = 0;
				}
			}
			else
			{
				svg.left = svg.left + 2;
				if(svg.left >= 56)
				{
					svg.dirLeft = 1;
				}
			}
			
			svg.setAttribute("style", "left:" + svg.left+"px;bottom:" + svg.bottom+"px;opacity:"+svg.opacity+"; width: 32px; height: 32px;");
			if(obj.opacity <= 0.1)
			{
				clearInterval(sh);
				bubble.removeChild(svg);
			}
		}, time);
	}
	
	function sendEmoji()
	{
		$("#sendmsgtxt").attr("readonly", "readonly");
	}
	
	function endSendEmoji()
	{
		$("#sendmsgtxt").removeAttr("readonly");
	}
	
	var socket;
	var singer = {};
	var onlinecount = 0;
	function showGift()
	{
		$("#giftdiv").show();
		$("#bkfoot").hide();
		
		$("#gift_list").html("");
		for(var i = 0; i < items.length; i++)
		{
			var types = items[i].type.split("|");
			for(var j = 0; j < types.length; j++)
			{
				if(types[j] == "s")
				{//歌手礼物,可以加入
					$("#gift_list").append(
						'<li style="display:inline-block">	\
							<a href="javascript:void(0)" onclick="SendGiftToSinger('+ i + ')">\
							<img src="' + items[i].img + '" style="width:40px;height:40px;display:inline-block"></img>'
							+ items[i].name + '(' + items[i].price + ')</a>\
						</li>'
					);
				}
			}
		}
	}
	
	function SendGiftToSinger(index)
	{
		if(!singer || !singer.userid)
		{
			return;
		}
		$.post(
				"http://dream.waimaipu.cn/index.php/user/send_gift",
				{
					bar_id:<?php echo $barinfo['bar_id'];?>,
					desk_id:<?php echo $deskid; ?>,
					target_user_id:singer.userid,
					item_id:items[index].item_id,
					item_count:1,
					leave_word:'send you a gift'
				},
				function(json) {
					if(json.code != 0)
					{//查询失败，后面考虑如何提示(thinklater)
						return;
					}
					
					socket.emit('giftMessage', {
						type:'giftMessage',
						barid:<?php echo $barinfo['bar_id'];?>,
						userid:<?php echo $userid;?>,
						nickname:'<?php echo $nickname;?>',
						headimg:'<?php echo $headimgurl;?>',
						
						target_userid:singer.userid,
						target_nickname:singer.singername,
						
						item_name:items[index].name,
						item_count:1
					});
					//alert("赠送成功");
					//发送礼物消息
				},
				"json"
		);
	}
	
	function showMsgInput()
	{
		$("#bkfoot").hide();
		$("#inputmsg").show();
	}
	
	
	(function (doc, win) {
	  var docEl = doc.documentElement,
		resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
		recalc = function () {
		  var clientWidth = docEl.clientWidth;
		  if (!clientWidth) return;
		  docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
		};

	  if (!doc.addEventListener) return;
	  win.addEventListener(resizeEvt, recalc, false);
	  doc.addEventListener('DOMContentLoaded', recalc, false);
	})(document, window);
</script>
<script type="text/javascript">
	
	function initWebSocket() {
		socket = io.connect('ws://119.29.10.176:3000');
		//alert(socket);
		//告诉服务器端有用户登录
		socket.emit('login', {
				barid:<?php echo $barinfo['bar_id'];?>,
				userid:<?php echo $userid;?>,
				nickname:'<?php echo $nickname;?>',
				headimg:'<?php echo $headimgurl;?>',
			});
		
		//监听新用户登录
		socket.on('login', function(obj){
			//当有用户登录时，login消息会传回
			onlinecount = obj.guest.length;
			$("#onlinecount").html(onlinecount);
		
			if(obj.singer)
			{//如果有歌手信息
				singer.userid = obj.singer.userid;
				singer.singername = obj.singer.singername;
				singer.lovecount = obj.singer.lovecount;
				singer.liveness = obj.singer.liveness;
				singer.singerimg = obj.singer.singerimg;
				
				$("#singer_nickname").html(singer.singername);
				$("#singer_lovecount").html(singer.lovecount);
				$("#singer_liveness").html(singer.liveness);
				$("#singer_img").attr("src", singer.singerimg);
			}
			
			if(obj.user)
			{
				$("#msg_list").append(
				'<li>	\
					<div class="user-img">	\
						<img src="' + obj.user.headimg + '"></img>	\
					</div>	\
					<div class="user-msg" style="opacity:.6;">	\
						<div class="arrow-left"></div>	\
						'+obj.user.nickname+'上线了	\
					</div>	\
				</li>	\
				'
				);
			}
		});
		
		//监听用户退出
		socket.on('logout', function(obj){
			onlinecount--;
			$("#onlinecount").html(onlinecount);
		});
		//礼物消息
		socket.on('giftMessage', function(message) {
							alert(message.headimg);
							$("#msg_list").append('<li>	\
													<div class="user-img">	\
														<img src="' + message.headimg + '"></img>	\
													</div>	\
													<div class="user-msg" style="opacity:.6;">	\
														<div class="arrow-left"></div>	\
														'+message.nickname+'送了'+message.target_nickname+message.item_count+'个'+message.item_name+'	\
													</div>	\
												</li>');
										});
		//监听客人消息
		socket.on('message', function(obj){
			var type = obj.type;
			if(type == 'danmumsg')
			{
				$("#msg_list").append(
					'<li name="user_msg" id="user_msg_'+obj.message_id+'">	\
						<div class="user-img">	\
							<img src="' + obj.headimg + '"></img>	\
						</div>	\
						<div class="user-msg" style="opacity:.6;">	\
							<div class="arrow-left"></div>	\
							'+'弹幕消息：'+obj.content+'	\
						</div>	\
					</li>'
				);
			}
			else
			{
				$("#msg_list").append(
					'<li name="user_msg" id="user_msg_'+obj.message_id+'">	\
						<div class="user-img">	\
							<img src="' + obj.headimg + '"></img>	\
						</div>	\
						<div class="user-msg" style="opacity:.6;">	\
							<div class="arrow-left"></div>	\
							'+obj.content+'	\
						</div>	\
					</li>'
				);
			}
			
		});
		//监听歌手切换消息
		socket.on('singerSwitch', function(obj) {
			singer.userid = obj.userid;
			singer.singername = obj.singername;
			singer.lovecount = obj.lovecount;
			singer.liveness = obj.liveness;
			singer.singerimg = obj.singerimg;
			
			$("#singer_nickname").html(singer.singername);
			$("#singer_lovecount").html(singer.lovecount);
			$("#singer_liveness").html(singer.liveness);
			$(singer_img).attr("src", singer.singerimg);
		});
		//监听新用户登录消息，发送getOnlineUsers消息后返回
		socket.on('retOnlineUsers', function(obj) {
			var userids = [];
			for(var i = 0; i < obj.guest.length; i++)
			{
				userids.push(obj.guest[i].userid);
				// $("#online_ul").append(
					// '<li>		\
						// <div class="user-img" style="font-size:10px"> \
							// <img src="' + obj.guest[i].headimg + '" style="border-radius:1rem;display:inline"></img> \
							// ' + obj.guest[i].nickname + '\
						// </div> \
					 // </li>'
				// );
				//' + obj.guest[i].nickname + ' \
			}
			
			$.post(
					"http://dream.waimaipu.cn/index.php/user/get_users_info",
					{
						userids:userids.join("|"),
					},
					function(json) {
						if(json.code != 0)
						{//查询失败，后面考虑如何提示(thinklater)
							return;
						}
						
						for(var i = 0; i < json.data.length; i++)
						{
							
							$("#online_ul").append(
								'<li style="width:100%;font-size:10px;margin-left:0px;display:block">		\
									<div class="user-img" style="font-size:10px"> \
										<img src="' + obj.guest[i].headimg + '" style="border-radius:1rem;display:inline"></img> \
									</div> '
									+ obj.guest[i].nickname + '爱心值：'+json.data[i].love_count+ ' \
										性别：' + json.data[i].sex + '角色：'+ json.data[i].role + '活跃度：' + json.data[i].liveness + '\
								 </li>'
							);
							
						}
					},
					"json"
			);
		});
		
		socket.on('sysMessage', function(obj) {
			$("#msg_list").append(
				'<li>	\
					<div class="user-msg" style="opacity:.6;">	\
						<div class="arrow-left"></div>	\
						'+'系统消息：'+obj.content+'	\
					</div>	\
				</li>	\
				'
			);
		});
		
		socket.on('barMessage', function(obj) {
			$("#msg_list").append(
				'<li>	\
					<div class="user-msg" style="opacity:.6;">	\
						<div class="arrow-left"></div>	\
						'+'商家消息：'+obj.content+'	\
					</div>	\
				</li>	\
				'
			);
		});
		
		socket.on('delMessage', function(obj) {
			var user_msgs = document.getElementsByName('user_msg'); 
			for(var i = 0; i < user_msgs.length; i++)
			{
				if(user_msgs[i].id == ("user_msg_"+obj.message_id))
				{
					document.getElementById("msg_list").removeChild(user_msgs[i]);
				}
			}
		});
	}
	
	initWebSocket();
	
	function sendUserMsg() {
		var content = $("#sendmsgtxt").val();
		if($("#danmu").is(':checked'))
		{//发送弹幕消息逻辑
			
							
			//扣除八刻币，目前先放前端做(简化设计)，后面考虑放后端,安全
			$.post(
					"http://dream.waimaipu.cn/index.php/user/consume_money",
					{
						moneycount:1,
					},
					function(json){
						//不关注是否扣除成功
						if(json.code == 0)
						{//查询失败，后面考虑如何提示(thinklater)
							socket.emit('message', {
								type:'danmumsg',
								userid:<?php echo $userid; ?>,
								barid:<?php echo $barinfo['bar_id']; ?>,
								nickname:'<?php echo $nickname; ?>',
								headimg:'<?php echo $headimgurl; ?>',
								content:content
							});
							return;
						}
						else if(json.code == -1003)
						{
							alert("余额不足");
						}
					},
					"json"
			);
			
		}
		else
		{//发送普通消息逻辑
			socket.emit('message', {
								type:'normsg',
								userid:<?php echo $userid; ?>,
								barid:<?php echo $barinfo['bar_id']; ?>,
								nickname:'<?php echo $nickname; ?>',
								headimg:'<?php echo $headimgurl; ?>',
								content:content
							});
		}

		$("#bkfoot").show();
		$("#inputmsg").hide();
		$("#sendmsgtxt").val("");
	}
	
	function showOnline() {
		$("#index_page").hide();
		$("#online_page").show();
		socket.emit('getOnlineUsers', {barid:<?php echo $barinfo['bar_id']; ?>});
	}
	
	/************************添加歌手爱心逻辑  start******************/
	var add_love_time;
	var added_love_count = 0;
	function add_singerlove()
	{
		if(!singer || !singer.userid)
		{
			return;
		}
		//var love_catoon = new LoveCatoon();
		LoveCatoon();
		add_love_time = new Date().getTime();
		if(added_love_count == 0)
		{
			setTimeout(judge_addlove, 200);
		}
		added_love_count++;
	}
	
	function judge_addlove()
	{
		curr_time = new Date().getTime();
		if((curr_time - add_love_time) >= 500 && added_love_count > 0) //如果上次点击时间比现在已经过去了1秒钟
		{
			//调用后台接口增加
			$.post(
					"http://dream.waimaipu.cn/index.php/user/add_love",
					{
						userid:singer.userid,
						count:added_love_count
					},
					function(json) {
						if(json.code != 0)
						{//查询失败，后面考虑如何提示(thinklater)
							return;
						}
					},
					"json"
			);
			added_love_count = 0;
		}
		else
		{
			setTimeout(judge_addlove, 200);
		}
	}
	/**********************添加歌手爱心逻辑  over******************/
	
	
	
	function showPayPage()
	{
		$.post(
				"http://dream.waimaipu.cn/index.php/user/query_money",
				{
				},
				function(json) {
					if(json.code != 0)
					{//查询失败，后面考虑如何提示(thinklater)
						return;
					}
					$("#left_money").html(json.money);
				},
				"json"
		);
		$("#index_page").hide();
		$("#recharge_page").show();
	}
	
	var jsApiParameters;
	var order_id;
	var money_count;
	function pay()
	{
		order_id = null;
		money_count = $("input[name='money_count']:checked").val();
		$.post(
				"http://dream.waimaipu.cn/index.php/user/pay",
				{
					bar_id:<?php echo $barinfo['bar_id']; ?>,
					desk_id:<?php echo $deskid; ?>,
					item_id:1,//八客币
					item_count:money_count
				},
				function(json) {
					if(json.code != 0)
					{//查询失败，后面考虑如何提示(thinklater)
						return;
					}
					jsApiParameters = json.jsApiParameters;
					order_id = json.order_id;
					callpay();
				},
				"json"
		);
	}
	

	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			JSON.parse(jsApiParameters),
			function(res)
			{
				if(res.err_msg == "get_brand_wcpay_request:ok") 
				{
					//支付成功，发货
					$.post(
							"http://dream.waimaipu.cn/index.php/user/deliver_good",
							{
								"order_id":order_id
							},
							function(json) {
								if(json.code != 0)
								{//查询失败，后面考虑如何提示(thinklater)
									alert('充值失败!');
									return;
								}
								alert('充值成功！');
							},
							"json"
					);
				}
				else
				{
					alert(JSON.stringify(res));
					alert(res.err_msg);
					//window.history.go(-1);
				}
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
				document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			}
		}else{
			jsApiCall();
		}
	}
	function goback(){
		window.history.go(-1);
	}
</script>
<script type="text/javascript" src="http://dream.waimaipu.cn/item.js">
</script>
<script type="text/javascript">
	$('.check-on').click(function(){
		$(this).toggleClass('check-off');
		})
</script>
</body>
</html>
