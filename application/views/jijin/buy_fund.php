<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>基金购买</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="keywords" content="小牛资本">
	<meta name="description" content="小牛资本管理集团公募基金代销系统">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="<?php echo $base.'/data/jijin/css/mui.min.css';?>">
	<link rel="stylesheet" href="<?php echo $base.'/data/jijin/css/style.css';?>">
	<link rel="stylesheet" href="<?php echo $base.'/data/jijin/css/mui.picker.min.css';?>">
</head>
<body>
	<nav class="mui-bar mui-bar-tab">
		<a class="mui-tab-item mui-active" href="#tabbar-with-chat">
			<span class="mui-icon icon-email iconfont"></span></span>
			<span class="mui-tab-label">购买基金</span>
		</a>
		<a class="mui-tab-item" href="#tabbar-with-contact" id="my">
			<span class="mui-icon icon-contact iconfont"></span>
			<span class="mui-tab-label">我的基金</span>
		</a>
		<a class="mui-tab-item" href="#tabbar-with-contact" id="exit">
			<span class="mui-icon icon-exit iconfont"></span>
			<span class="mui-tab-label">返回首页</span>
		</a>		
	</nav>
	<div class="mui-content">
<!--  
		<div class="mui-slider" id="header">
			<div class="mui-slider-group mui-slider-loop">
				<div class="mui-slider-item"><a href="###"><img style="height:102px" src="" class="slider-height" alt="huodong"></a></div>
			</div>
		</div>
-->
		<div id="slider" class="mui-slider">
			<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
				<a class="mui-control-item <?php echo ($pageOper == 'buy')? 'mui-active' : '';?>" href="#item1mobile">
					<i class="subscribe Cicon"></i>
					<p>认购</p>
				</a>
				<a class="mui-control-item <?php echo ($pageOper == 'apply')? 'mui-active' : '';?>" href="#item2mobile">
					<i class="apply Cicon"></i>
					<p>申购</p>
				</a>
				<a class="mui-control-item <?php echo ($pageOper == 'today')? 'mui-active' : '';?>" href="#item3mobile">
					<i class="day-delegate Cicon"></i>
					<p>当日委托</p>
				</a>
				<a class="mui-control-item <?php echo ($pageOper == 'history')? 'mui-active' : '';?>" href="#item4mobile" >
					<i class="history-delegate Cicon"></i>
					<p>历史委托</p>
				</a>
			</div>
			<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-3"></div>

			<div class="mui-slider-group">
				<div id="item1mobile" class="mui-slider-item mui-control-content <?php echo ($pageOper == 'buy')? 'mui-active' : '';?>">
					<div id="scroll1" class="mui-scroll-wrapper">
						<div class="mui-scroll">
						<?php
							if (isset($_SESSION['riskLevel'])){
								echo '<p style="color: #333;padding:5px 10px;">';
								if( 1 == $_SESSION['qryallfund']){
									echo '根据证监会适当性管理办法，产品列表已根据您的风险等级作筛选。您已主动要求查看高于您风险等级的产品。';
								}else{
									echo '根据证监会适当性管理办法，产品列表已根据您的风险等级作筛选。';
								}
								echo '<a href="/jijin/jz_fund/viewAllFund" >前往了解</a>';
								echo '</p>';
							}
						?>
							<ul class="mui-table-view" id="subscribe">
								<div class="mui-loading">
									<div class="mui-spinner">
									</div>
								</div>
							</ul>
						</div>
					</div>
				</div>
				<div id="item2mobile" class="mui-slider-item mui-control-content <?php echo ($pageOper == 'apply')? 'mui-active' : '';?>">
					<div id="scroll2" class="mui-scroll-wrapper">
						<div class="mui-scroll">
						<?php
							if (isset($_SESSION['riskLevel'])){
								echo '<p style="color: #333;padding:5px 10px;">';
								if( isset( $_SESSION['qryallfund']) && 1 == $_SESSION['qryallfund']){
									echo '根据证监会适当性管理办法，产品列表已根据您的风险等级作筛选。您已主动要求查看高于您风险等级的产品。';
								}else{
									echo '根据证监会适当性管理办法，产品列表已根据您的风险等级作筛选。';
								}
								echo '<a href="/jijin/jz_fund/viewAllFund" >前往了解</a>';
								echo '</p>';
							}
						?>
							<ul class="mui-table-view" id="apply">
								<div class="mui-loading">
									<div class="mui-spinner">
									</div>
								</div>
							</ul>
						</div>						
					</div>
				</div>
				<div id="item3mobile" class="mui-slider-item mui-control-content <?php echo ($pageOper == 'today')? 'mui-active' : '';?>">
					<div id="scroll3" class="mui-scroll-wrapper">
						<div class="mui-scroll">
							<div class="mui-loading">
								<div class="mui-spinner">
								</div>
							</div>
							<div class="mui-table-view-cell query-padding">								
								<div class="mui-media-body clear delegate">
							<!--		<div class="delegate-date">日期</div>  -->
									<div class="delegate-name">基金名称/代码</div>
									<div class="delegate-oprate">交易类型</div>
									<div class="delegate-amount">金额/份额</div>
									<div class="delegate-oprate">交易状态</div>
									<div class="delegate-more-title"></div>
								</div>
							</div>
							<ul class="mui-table-view" id="today">
							</ul>
						</div>
					</div>
				</div>
				<div id="item4mobile" class="mui-slider-item mui-control-content <?php echo ($pageOper == 'history')? 'mui-active' : '';?>">
					<div id="scroll4" class="mui-scroll-wrapper">
						<div class="mui-scroll">
							<div class="mui-loading" style="display:none">
								<div class="mui-spinner">
								</div>
							</div>
							<div class="mui-table-view-cell query-padding">									
								<label for="begin"><button id='begin' data-options='{"type":"date","beginYear":2016,"endYear":<?php echo date("Y",time()) ?>}' class="btn mui-btn">开始日期</button></label>
								<label for="end"><button id='end' data-options='{"type":"date","beginYear":2016,"endYear":<?php echo date("Y",time()) ?>}' class="btn mui-btn">结束日期</button></label>
								<button type="button" id="search" class="mui-btn mui-btn-primary" style="width:28%;">搜索</button>											
							</div>
							<div class="mui-table-view-cell query-padding">
								<a href="###">
									<div class="mui-media-body clear delegate">
										<div class="delegate-date">订单日期</div>
										<div class="delegate-name">基金名称/代码</div>
										<div class="delegate-oprate">交易类型</div>
										<div class="delegate-amount">金额/份额</div>
										<div class="delegate-more-title"></div>
									</div>
								</a>
							</div>
							<ul class="mui-table-view" id="history">
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<input value="<?php echo $base;?>" type="hidden" id="url"></input>
<script src="<?php echo $base.'/data/jijin/js/mui.min.js';?>"></script>
<script src="<?php echo $base.'/data/jijin/js/mui.picker.min.js';?>"></script>
<script src="<?php echo $base.'/data/jijin/js/buy_fund.js';?>"></script>
<script type="text/javascript">
	document.getElementById('my').addEventListener('tap', function() {
	  	//打开我的基金页
	  	mui.openWindow({
		  	url: '<?php echo $base;?>'+'/jijin/Jz_my', 
	    	id:'my'
	  	});
	});
	document.getElementById('exit').addEventListener('tap', function() {
	  	//退出基金		
	  	mui.openWindow({
		  	url: '/jijin/Jz_account/logout',       
	    	id:'exit'
	  	});
	});

	
    // pushHistory(); 
    window.addEventListener("popstate", function(e) { 
        // alert("我监听到了浏览器的返回按钮事件啦");
        window.location.href = '/jijin/Jz_account/logout';
    }, false); 
    function pushHistory() { 
        var state = { 
          title: "buy_fund",
          url: "#"
        };
        window.history.pushState(state, "title", "#");
    } 

</script>
</body>
</html>
