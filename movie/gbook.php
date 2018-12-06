<?php
session_start();
require_once("include/common.php");
require_once(sea_INC."/filter.inc.php");
require_once(sea_INC.'/main.class.php');
 
if($cfg_feedbackstart=='0'){
	showMsg('对不起，留言暂时关闭','-1');
	exit();
}

if($cfg_feedbackcheck=='1') $needCheck = 0;
else $needCheck = 1;

if(empty($action)) $action = '';
if($action=='add')
{
	$ip = GetIP();
	$dtime = time();
	
	//检查验证码是否正确
if($cfg_feedback_ck=='1')
{	
	$validate = empty($validate) ? '' : strtolower(trim($validate));
	$svali = $_SESSION['sea_ckstr'];
	if($validate=='' || $validate != $svali)
	{
		ResetVdValue();
		ShowMsg('验证码不正确!','-1');
		exit();
	}
}	
	//检查留言间隔时间；
	if(!empty($cfg_feedback_times))
	{
		$row = $dsql->GetOne("SELECT dtime FROM `sea_guestbook` WHERE `ip` = '$ip' ORDER BY `id` DESC ");
		if($dtime - $row['dtime'] < $cfg_feedback_times)
		{
			ShowMsg("留言过快，歇会再来留言吧","-1");
			exit();
		}
	}
	$userid = !empty($userid)?intval($userid):0;
	$uname = trimMsg($m_author);
	$uname =  _Replace_Badword($uname);
	$msg = trimMsg(cn_substrR($m_content, 1024), 1);
	
	if(!preg_match("/[".chr(0xa1)."-".chr(0xff)."]/",$msg)){
		
	}
	
	$reid = empty($reid) ? 0 : intval($reid);

	if(!empty($cfg_banwords))
	{
		$myarr = explode ('|',$cfg_banwords);
		for($i=0;$i<count($myarr);$i++)
		{
			$userisok = strpos($uname, $myarr[$i]);
			$msgisok = strpos($msg, $myarr[$i]);
			if(is_int($userisok)||is_int($msgisok))
			{
				showMsg('您发表的评论中有禁用词语!','-1');
				exit();
			}
		}
	}
	
	if($msg=='' || $uname=='') {
		showMsg('你的姓名和留言内容不能为空!','-1');
		exit();
	}
	$title = HtmlReplace( cn_substrR($title,60), 1 );
	if($title=='') $title = '无标题';
		$title = _Replace_Badword($title);

	if($reid != 0)
	{
		$row = $dsql->GetOne("Select msg From `sea_guestbook` where id='$reid' ");
		$msg = "<div class=\\'rebox\\'>".addslashes($row['msg'])."</div>\n".$msg;
	}
	$msg = _Replace_Badword($msg);
	$query = "INSERT INTO `sea_guestbook`(title,mid,uname,uid,msg,ip,dtime,ischeck)
                  VALUES ('$title','{$g_mid}','$uname','$userid','$msg','$ip','$dtime','$needCheck'); ";
	$dsql->ExecuteNoneQuery($query);
	if($needCheck==1)
	{
		ShowMsg('感谢您的留言，我们会尽快回复您！','gbook.php',0,3000);
		exit();	
	}
	else
	{
		ShowMsg('成功发送一则留言，但需审核后才能显示！','gbook.php',0,3000);
		exit();
	}
}
//显示所有留言
else
{
	if($key!=''){
	$key="您好，我想看".HtmlReplace($key).",多谢了";
	$title="求片";
	}else{
	$key='';
	$title='';
	}
	$page=empty($page) ? 1 : intval($page);
	if($page==0) $page=1;
	$tempfile = sea_ROOT."/templets/".$GLOBALS['cfg_df_style']."/".$GLOBALS['cfg_df_html']."/gbook.html";
	$content=loadFile($tempfile);
	$t=$content;
	$t=$mainClassObj->parseTopAndFoot($t);
	$t=$mainClassObj->parseHistory($t);
	$t=$mainClassObj->parseSelf($t);
	$t=$mainClassObj->parseGlobal($t);
	$t=$mainClassObj->parseAreaList($t);
	$t=$mainClassObj->parseMenuList($t,"");
	$t=$mainClassObj->parseVideoList($t,-444);
	$t=$mainClassObj->parseNewsList($t,-444);
	$t=$mainClassObj->parseTopicList($t);
	$t=replaceCurrentTypeId($t,-444);
	$t=$mainClassObj->parseIf($t);
	if($cfg_feedback_ck=='1')
	{$t=str_replace("{gbook:viewLeaveWord}",viewLeaveWord2(),$t);}
	else
	{$t=str_replace("{gbook:viewLeaveWord}",viewLeaveWord(),$t);}
	$t=str_replace("{gbook:main}",viewMain(),$t);
	$t=str_replace("{seacms:runinfo}",getRunTime($t1),$t);
	$t=str_replace("{seacms:member}",front_member(),$t);
	echo $t;
	exit();
}

function viewMain(){
	$main="".$GLOBALS['cfg_webname']."留言板";
	return $main;
}

function viewLeaveWord(){
	if(!empty($_SESSION['sea_user_name']))
	{
		$uname=$_SESSION['sea_user_name'];
		$userid =$_SESSION['sea_user_id'];
	}
	
	$mystr=
	"<div class=\"col-md-9 col-sm-12 hy-main-content\"><div class=\"hy-layout clearfix\"><div class=\"hy-video-head\"><h4 class=\"margin-0\">留言板</h4></div>".leaveWordList($_GET['page'])."<script type=\"text/javascript\" src=\"js/base.js\"></script></div></div>".	
"<div class=\"col-md-3 col-sm-12 hy-main-side\"><div class=\"hy-layout clearfix\"><div class=\"hy-video-head\"><h4 class=\"margin-0\">我要留言</h4></div>".
"<form id=\"f_leaveword\" class=\"form-horizontal\"  action=\"/".$GLOBALS['cfg_cmspath']."gbook.php?action=add\" method=\"post\">".
"<input type=\"hidden\" value=\"$userid\" name=\"userid\" />".
"<input type=\"hidden\" value=\"$uname\" name=\"m_author\" />".
"<ul class=\"hy-common-text\">".
"<li>".
(isset($uname)?$uname:'<input type="input" class="form-control" value="匿名" placeholder="输入昵称"  name="m_author" id="m_author" size="20" />').
"</li>".
"<li><textarea cols=\"40\" class=\"form-control\" name=\"m_content\" id=\"m_content\" rows=\"5\" placeholder=\"输入留言内容\"></textarea></li>".

"<li><input type=\"reset\" value=\"重新留言\" class=\"btn btn-default pull-right\" /><input type=\"submit\" click=\"leaveWord()\" value=\"提交留言\" class=\"btn btn-warning\"/></li>".
"</ul>".
"</form>".
"</div></div>";
	return $mystr;
}


//开启验证码
function viewLeaveWord2(){
	if(!empty($_SESSION['sea_user_name']))
	{
		$uname=$_SESSION['sea_user_name'];
		$userid =$_SESSION['sea_user_id'];
	}
	
	$mystr=
"<div id=\"content\" style=\"width:100%; height: auto;\">".
"<div class=\"wrap\">".
"<div class=\"comment\">".
"<div class=\"head-face\">".
"<img src=\"templets/id97/html/images/1.jpg\" / >".
"</div>".
"<div class=\"content\" style=\"height: auto;\">".
"<form id=\"f_leaveword\" class=\"form-horizontal\"  action=\"/".$GLOBALS['cfg_cmspath']."gbook.php?action=add\" method=\"post\">".
"<div class=\"cont-box\" style=\"height: auto;width:auto;margin-bottom: 3px;border: 1px solid #07a7e1;border-radius: 5px;\">".
"<input value=\"匿名\" placeholder=\"输入昵称\"  name=\"m_author\" id=\"m_author\" size=\"20\" />".
"</div>".
"<div class=\"cont-box\" style=\"border-radius: 5px;margin-bottom: 3px;\">".
"<textarea name=\"m_content\" style=\"width: 100%;height: 100%;\" id=\"m_content\" class=\"text\" placeholder=\"请输入留言...\"></textarea>".
"</div>".
"<div class=\"cont-box\" style=\"height: auto;width:auto;border: 0px;\">".
"<img id=\"vdimgck\" class=\"pull-right\" style=\"width:70px; height:32px;margin-top: 1px;\"  src=\"include/vdimgck.php\" alt=\"看不清？点击更换\"  align=\"absmiddle\"  style=\"cursor:pointer\" onClick=\"this.src=this.src+'?get=' + new Date()\"/><input name=\"validate\" class=\"form-control\" type=\"text\" id=\"vdcode\" placeholder=\"验证码\" style=\"width:50%;text-transform:uppercase;\" class=\"text\" tabindex=\"3\"/>".
"</div>".
"<div class=\"tools-box\" style=\"margin-top: 3px;border-radius: 5px;height: 32px;\" >".
"<div class=\"operator-box-btn\"><span class=\"face-icon\">☺</span><span class=\"img-icon\">▧</span></div>".
"<div class=\"submit-btn\"><input type=\"button\" onClick=\"leaveWord()\" value=\"提交评论\" /></div>".
"</div>".
"</form>".
"</div>".
leaveWordList($_GET['page']);

	return $mystr;
}
function leaveWordList($currentPage){
	global $dsql;
	$vsize=10;
	if($currentPage<=1)
	{
		$currentPage=1;
	}
	$limitstart = ($currentPage-1) * $vsize;
	$sql="select * from `sea_guestbook` where ischeck='1' ORDER BY id DESC limit $limitstart,$vsize";	
	$cquery = "Select count(*) as dd From `sea_guestbook` where ischeck='1'";
	$row = $dsql->GetOne($cquery);
	if(is_array($row))
	{
		$TotalResult = $row['dd'];
	}
	else
	{
		$TotalResult = 0;
	}
	$TotalPage = ceil($TotalResult/$vsize);
	$dsql->SetQuery($sql);
	$dsql->Execute('leaveWordList');
	$i=$TotalResult;

	$txt="<input type=\"hidden\" id=\"totalResult\" value='".$TotalResult."'/>";
	$txt.="<div id=\"info-show\"  style=\"margin-bottom: 50px;\"><ul>";
	while($row=$dsql->GetObject('leaveWordList')){
	$txt.= "<li style=\"padding-bottom: 10px;\">";
	$txt.= "<div class=\"head-face\">";
	$txt.= "<img src=\"templets/id97/html/images/1.jpg\" / >";
	$txt.= "</div>";
	$txt.= "<div class=\"reply-cont\">";
	$txt.= "<p class=\"username\">".$row->uname."</p>";
	$txt.= "<p class=\"comment-body\">".showFace($row->msg)."</p>";
	$txt.= "<p class=\"comment-footer\">".MyDate('',$row->dtime)."</p>";
	$txt.= "</div>";
	$txt.= "</li>";
	$i--;
	}
	$txt.="</ul></div></div></div>";
	if($TotalResult>10) {
	unset($i);
	$txt.="<div style=\"text-align:center;\"><nav role=\"navigation\"><ul class=\"cd-pagination no-space\" style=\"margin-bottom: 0px;\">";
	if($currentPage==1)$txt.="<li class=\"button\"><a class=\"disabled\" href=\"#\">首页</a></li><li class=\"button\"><a class=\"disabled\" href=\"#\">上一页</a></li>";
	else $txt.="<li class=\"button\"><a title='首页' href=\"/".$GLOBALS['cfg_cmspath']."gbook.php?page=1\">首页</a></li><li class=\"button\"><a title='前一页' href=\"/".$GLOBALS['cfg_cmspath']."gbook.php?page=".($currentPage-1)."\">上一页</a></li>";
	if($currentPage==$TotalPage)$txt.="<li class=\"button\"><a class=\"disabled\" href=\"#\">下一页</a></li><li class=\"button\"><a class=\"disabled\" href=\"#\">尾页</a></li>";
	else $txt.="<li class=\"button\"><a href=\"/".$GLOBALS['cfg_cmspath']."gbook.php?page=".($currentPage+1)."\">下一页</a></li> <li class=\"button\"><a href=\"/".$GLOBALS['cfg_cmspath']."gbook.php?page=".$TotalPage."\">尾页</a></li>";
	return $txt."</nav></ul></div>";
	} else {
		return $txt;
	}

}


?>