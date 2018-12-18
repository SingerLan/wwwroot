<!DOCTYPE html>
<html>
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>M3U8/MP4+P2P加速视频播放器</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="dplay/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="dplay/player.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="dplay/player.css" /></head>
  
  <body>
    <div id="video" style="width:100%;height:100%;"></div>
    <div class="total">
      <span class="peer"></span>
      <span class="load"></span>
      <span class="line"></span>
    </div>
    <link rel="stylesheet" type="text/css" href="dplay/dplayer.css" />
    <script src="dplay/p2p.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="dplay/hls.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="dplay/dplayer.js" type="text/javascript" charset="utf-8"></script>
    <script>var urls = '<?php echo $_GET['url'];?>';
      var apis = "1";
      var jump = "";
      var cookie = apis ? vfed.cookie.put(urls) : "";</script>
    <script>function delayed() {
        vfed.player.dplayer(true, urls, jump);
      }</script>
    <script>delayed();</script>
    <div style="display:none">
    </div>
  </body>

</html>