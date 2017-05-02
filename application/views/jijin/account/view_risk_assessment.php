﻿<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="keywords" content="小牛资本">
	<meta name="description" content="小牛资本管理集团公募基金代销系统">
	<title>风险评测</title>
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" type="text/css" href="<?php echo $base ?>/data/css/risk.css">
</head>
<body>
	<div data-role="page" id="pageone">
		<form method="post" action="/jijin/Risk_assessment/submit">
			<div data-role="content">
				<section class="m-item-wrap m-item-5-wrap">
			        <div class="m-item-5">
			            <h3 class="text-center">风险等级测试</h3>
			        </div>
			    </section>
				<input type="hidden" id="cout" name="cout" value="<?php echo count($data)?>">
				<ul data-role="listview">
					<?php for($i=0;$i<count($data);$i++) { ?>		
					<li data-role="list-divider" class="ul-title" ><?php echo $data[$i]['questioncode'].'. '.$data[$i]['questionname']?></li>				
						 <li data-role="controlgroup" class="li-control" >
						 <input type="hidden" id=<?php echo 'questioncode'.$i?> name=<?php echo 'questioncode'.$i?> value="<?php echo $data[$i]['questioncode']?>">			 
						 <fieldset data-role="controlgroup">
						 	
						 		<?php for($j=0;$j<count($data[$i]['result']);$j++) {?>
						 		<div class="li-radio">
						 			<input type="radio" name=<?php echo $i?> id=<?php echo 'id'.$i.$j ?> 
							 		value=<?php echo $data[$i]['result'][$j]['result'].'|'.$data[$i]['result'][$j]['resultpoint']?>>
							 		<label style="display:block;" for=<?php echo 'id'.$i.$j?>> <?php echo $data[$i]['result'][$j]['result'].'. '.$data[$i]['result'][$j]['resultcontent']?> </label>
							 		
						 		</div>
						 		<?php }?>						 	
					     </fieldset>			     
					     </li>			   
					 <?php }?>
				</ul>
			
			</div>
			<button data-role="submit" data-theme="b" class="risk-btn-submit" >提交</button>
			<button class="risk-back" onclick="history.go(-1);">返回</button>
		</form>
	</div>
</body>
</html>
