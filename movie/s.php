<?php
session_start();
require_once("include/common.php");
require_once(sea_INC."/main.class.php");

$i=file_get_contents("data/admin/s.txt");
if($i==0){showmsg('未开启签到功能', 'member.php');exit;}

$u=addslashes($_SESSION['sea_user_id']);
if(empty($u) OR !is_numeric($u)){showmsg('无法获取目标用户ID', 'member.php');exit;}

$row = $dsql->GetOne("Select stime from sea_member where id='$u'");


$nowtime=time();

$lasttime=$row['stime'];

if($nowtime-$lasttime > 86400 )
{
	$dsql->ExecuteNoneQuery("Update sea_member set stime = $nowtime  where id='$u'");
	$sql="Update sea_member set points = points+$i where id=$u";
	$dsql->ExecuteNoneQuery("$sql");
	showmsg('签到成功！', 'member.php');exit;
}
else
{
	showmsg('已经签到！', 'member.php');exit;
}
?>