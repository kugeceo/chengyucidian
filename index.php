<?php
set_time_limit(0);
$prescription = trim($_GET['q']);
$id = intval($_GET['id']);

$r_num = 0; //结果个数
$lan = 3;
$pf = "";
$pf_l = "";

if($prescription!=""){
	$dreamdb=file("chengyu.txt");//读取词语文件
	$count=count($dreamdb);//计算行数

	for($i=0; $i<$count; $i++) {
		$keyword=explode(" ",$prescription);//拆分关键字
		$dreamcount=count($keyword);//关键字个数
		$detail=explode("\t",$dreamdb[$i]);
		for ($ai=0; $ai<$dreamcount; $ai++) {
			@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[0]\");");
			if(($found)){
				if(fmod($r_num,$lan)==0) $pf_l .= "<tr>";
				$pf_l .= '<td width="'.(100/$lan).'%"><img src="dot.gif" /> <a href="?id='.($i+1).'">'.$detail[0].'</a></td>';
				if(fmod($r_num,$lan)+1==$lan) $pf_l .= "</tr>";
				$r_num++;
				break;
			}
		}
	}
	$pf_l = '<table width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><a href="?">鲁虺成语词典</a>：找到 <a href="?q='.urlencode($prescription).'"><font color="#c60a00">'.$prescription.'</font></a> 的相关词语'.$r_num.'个</b></td></tr><tr><td><table cellpadding="5" cellspacing="10" width="100%">'.$pf_l.'</table></td></tr></table>';
}elseif($id>0){
	$dreamdb=file("chengyu.txt");//读取词语文件
	$count=count($dreamdb);//计算行数

	$detail=explode("\t",$dreamdb[$id-1]);
	$pf = '<table width="100%" cellpadding=2 cellspacing=0 style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle"><b><a href="?">鲁虺成语词典</a> / '.$detail[0].'</b></td><td style="background:#EDF7FF;padding:0 5px;color:#014198;" align="right">';
	if($id>1 && $id<=$count) $pf .= '<a href="?id='.($id-1).'">上一个</a> ';
	$pf .= '<a href="?">查看全部</a>';
	if($id>=1 && $id<$count) $pf .= ' <a href="?id='.($id+1).'">下一个</a>';
	$pf .= '</td></tr><tr><td align="center" colspan="2"><h3>'.$detail[0].'</h3></td></tr><tr><td style="padding:5px;line-height:21px;" colspan="2"><p>'.$detail[1].'</p></td></tr></table>';
}else{
	$dreamdb=file("chengyu.txt");//读取词语文件
	$count=count($dreamdb);//计算行数

	$pfl = rand(0,intval($count/60));

	for($i=$pfl*60; $i<$pfl*60+60; $i++) {
		if($i>=$count-1) break;
		$detail=explode("\t",$dreamdb[$i]);
		if(fmod($r_num,$lan)==0) $pf_l .= "<tr>";
		$pf_l .= '<td width="'.(100/$lan).'%"><img src="dot.gif" /> <a href="?id='.($i+1).'">'.$detail[0].'</a></td>';
		if(fmod($r_num,$lan)+1==$lan) $pf_l .= "</tr>";
		$r_num++;
	}
	$pf_l = '<table width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b>推荐成语'.$r_num.'个</b></td></tr><tr><td><table cellpadding="5" cellspacing="10" width="100%">'.$pf_l.'</table></td></tr></table>';
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<html lang="zh">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
if($prescription){
	echo "<title>".$prescription." - 鲁虺成语词典大全，中华成语典故，成语资源，成语典故，方位成语，自然成语，儿童成语，三字成语，相对成语，同字成语，动物成语，身体成语，表情成语，心情成语，叠字成语，双字成语，数字成语，成语故事，成语新编，成语接龙</title>";
	echo '<meta name="keywords" content="'.$prescription.',中华成语典故,成语对仗词典,词语,成语故事,儿童成语,成语接龙,鲁虺成语词典大全，中华成语典故，成语资源，成语典故，方位成语，自然成语，儿童成语，三字成语，相对成语，同字成语，动物成语，身体成语，表情成语，心情成语，叠字成语，双字成语，数字成语，成语故事，成语新编，成语接龙。" />';
}elseif($id>0 && $id<=$count){
	echo "<title>".$detail[0]." - 鲁虺成语词典大全</title>";
	echo '<meta name="keywords" content="'.$detail[0].',中华成语典故,成语对仗词典,词语,成语故事,儿童成语,成语接龙,鲁虺成语词典大全，中华成语典故，成语资源，成语典故，方位成语，自然成语，儿童成语，三字成语，相对成语，同字成语，动物成语，身体成语，表情成语，心情成语，叠字成语，双字成语，数字成语，成语故事，成语新编，成语接龙。" />';
	echo '<meta name="description" content="'.str_replace("<br>","",$detail[1]).'鲁虺成语词典大全" />';
}else{
	echo "<title>鲁虺成语词典大全，中华成语典故，成语资源，成语典故，方位成语，自然成语，儿童成语，三字成语，相对成语，同字成语，动物成语，身体成语，表情成语，心情成语，叠字成语，双字成语，数字成语，成语故事，成语新编，成语接龙。</title>";
	echo '<meta name="keywords" content="鲁虺成语词典,成语对仗词典,成语接龙,词语大全，中华成语典故，成语资源，成语典故，方位成语，自然成语，儿童成语，三字成语，相对成语，同字成语，动物成语，身体成语，表情成语，心情成语，叠字成语，双字成语，数字成语，成语故事，成语新编，成语接龙。" />';
	echo '<meta name="description" content="鲁虺成语词典大全，中华成语典故，成语资源，成语典故，方位成语，自然成语，儿童成语，三字成语，相对成语，同字成语，动物成语，身体成语，表情成语，心情成语，叠字成语，双字成语，数字成语，成语故事，成语新编，成语接龙。" />';
}
?>
</head>

<body>
<div align="center">

<center>

</center>

<br>

<script src='http://www.luhui.net/js/header.js' language='JavaScript' charset='utf-8'></script>

<a href="./" class="logo-expanded">
<img src="./logo.png" width="100%" alt="" />
</a>
<table width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;" id="top"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b>鲁虺成语词典搜索</b></td></tr><tr><td align="center" valign="middle" height="60"><form action="?" method="get" name="f1">搜索词语：<input name="q" id="q" type="text" size="18" delay="0" value="" style="width:200px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" /> <input type="submit" value=" 搜索 " /></form></td></tr><tr><td align="center" height="30" style="font-size:14px;">推荐：
<a href="http://www.luhui.net/cn/book/">成语资源</a> 
<a href="?q=典故">成语典故</a> 
<a href="?q=方位">方位成语</a> 
<a href="?q=自然">自然成语</a> 
<a href="?q=儿童">儿童成语</a> 
<a href="?q=三字">三字成语</a>  
<a href="?q=相对">相对成语</a> 
<a href="?q=同字">同字成语</a> 
<a href="?q=动物">动物成语</a>  
<a href="?q=身体">身体成语</a>
<a href="?q=表情">表情成语</a> 
<a href="?q=心情">心情成语</a>  
<a href="?q=叠字">叠字成语</a> 
<a href="?q=双字">双字成语</a> 
<a href="?q=数字">数字成语</a> 
<a href="?q=故事">成语故事</a>  
<a href="?q=新编">成语新编</a> 
<a href="?q=接龙">成语接龙</a></td></tr></table><br />




<?
if($prescription!=""){
	//echo $pf_l.$pf;
	echo $pf_l;
}elseif($id>0 && $id<=$count){
	echo $pf;
}else{
	echo '<table width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b>鲁虺成语词典说明</b></td></tr><tr><td><p style="line-height:100%">成语词典是一种专门收录成语的工具书。<br></p>
一、内容丰富性<br></p>
它通常包含了数量众多的成语，涵盖了从古至今各个历史时期的语言精华。每个成语都有详细的解释，包括成语的字面意义和引申含义。例如，“破釜沉舟” 这个成语，词典会解释其字面意思为把锅打破，把船凿沉，同时阐明其引申义为表示下定决心，不顾一切地干到底。<br></p>
二、来源与典故<br></p>
许多成语词典还会介绍成语的来源和典故。这些典故往往来源于历史故事、神话传说、文学作品等。比如 “卧薪尝胆”，词典会讲述越王勾践卧薪尝胆以图复国的历史故事，帮助读者更好地理解成语的背景和含义。通过了解成语的典故，读者可以深入了解中国的历史文化和传统价值观。<br></p>
三、用法说明<br></p>
除了解释和典故，成语词典还会提供成语的用法说明。包括成语的词性、适用场景、搭配对象等。例如，“一马当先” 是一个动词性成语，通常用于描述人在行动中处于领先地位，可以说 “他在工作中一马当先，积极进取”。这样的用法说明可以帮助读者正确地使用成语，避免出现错误用法。
四、功能多样<br></p>
成语词典不仅可以帮助读者理解和学习成语，还可以用于语言表达的丰富和提升。在写作、演讲、交流等场合中，恰当运用成语可以使语言更加生动、形象、富有表现力。同时，成语词典也是学习语文、提高语言素养的重要工具，对于学生、教师、文学爱好者等人群都具有很大的价值。<br></p>
总之，成语词典是一座丰富的语言宝库，为人们学习和使用成语提供了便利和指导。<br></p></td></tr></table><br>';
	echo $pf_l;
}
?>
</div>
<div id="footer">
<!--此方法可以自动获取调用网址来源-->
<script>var yreflocation_html=document.location.href;</script><script>var url="<iframe allowTransparency=true border=0 align=center vspace=0  hspace=0 name=searchbar marginwidth=0 marginheight=0 framespacing=0 frameborder=0 scrolling=no width=100% height=60";url+='  src="http://www.luhui.net/search/code46840.htm#?url='+escape(yreflocation_html)+'"></iframe>';document.write(url);</script>
<script src='http://www.luhui.net/js/footer.js' language='JavaScript' charset='utf-8'></script>
<script src='http://www.luhui.net/js/tongji.js' language='JavaScript' charset='utf-8'></script>
</center>
</body>
</html>