<!doctype html>
<html>
<head>
<title>WebP2P播放器</title>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<meta http-equiv="content-language" content="zh-CN"/>
<meta http-equiv="X-UA-Compatible" content="chrome=1"/>
<meta http-equiv="pragma" content="no-cache"/>
<meta http-equiv="expires" content="0"/>
<meta name="referrer" content="never"/>
<meta name="renderer" content="webkit"/>
<meta name="msapplication-tap-highlight" content="no"/>
<meta name="HandheldFriendly" content="true"/>
<meta name="x5-page-mode" content="app"/>
<meta name="Viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
<link rel="stylesheet" href="dplayer/p2p-dplayer.min.css" type="text/css"/> 
<style type="text/css">
body,html{width:100%;height:100%;background:#000;padding:0;margin:0;overflow-x:hidden;overflow-y:hidden}
*{margin:0;border:0;padding:0;text-decoration:none}
#stats{position:fixed;top:5px;left:8px;font-size:12px;color:#fdfdfd;text-shadow:1px 1px 1px #000, 1px 1px 1px #000}
#dplayer{position:inherit}
</style>
</head>
<body>
<div id="dplayer"></div>
<div id="stats"></div>
<script type="text/javascript" src="dplayer/p2p-hls.min.js"></script>
<script type="text/javascript" src="dplayer/p2p-dplayer.min.js"></script>
<script>
	var webdata = {
		set:function(key,val){
			window.sessionStorage.setItem(key,val);
		},
		get:function(key){
			return window.sessionStorage.getItem(key);
		},
		del:function(key){
			window.sessionStorage.removeItem(key);
		},
		clear:function(key){
			window.sessionStorage.clear();
		}
	};
	var m3u8url = '<?php echo $_GET['url'];?>'
    var dp = new DPlayer({
        autoplay: true,
        container: document.getElementById('dplayer'),
        video: {
            // url: '<?php echo $_GET['url'];?>',
            url: m3u8url,
        	type: 'auto',
        	pic: 'dplayer/loading.gif',
        },
          volume: 6.0,
		  logo: 'dplayer/logo.png',
          preload: 'auto',
          screenshot: true,
          theme: '#7CFC00',
		danmaku: {
				id: '<?php echo $_GET['url'];?>',
				api: 'https://api.prprpr.me/dplayer/',
				maximum: 1000,
				bottom: '20%',
				unlimited: true
        },
        hlsjsConfig: {
//            debug: false,
            // Other hlsjsConfig options provided by hls.js
            p2pConfig: {
                logLevel: false,
                // Other p2pConfig options provided by CDNBye
                // https://github.com/cdnbye/hlsjs-p2p-engine/blob/master/docs/%E4%B8%AD%E6%96%87/API.md
            }
        }
    });
	dp.seek(webdata.get('pay'+m3u8url));
	setInterval(function(){
		webdata.set('pay'+m3u8url,dp.video.currentTime);
	},1000);
    var _peerId = '', _peerNum = 0, _totalP2PDownloaded = 0, _totalP2PUploaded = 0;
    dp.on('stats', function (stats) {
        _totalP2PDownloaded += stats.totalP2PDownloaded;
        _totalP2PUploaded += stats.totalP2PUploaded;
        updateStats();
    });
    dp.on('peerId', function (peerId) {
        _peerId = peerId;
    });
    dp.on('peers', function (peers) {
        _peerNum = peers.length;
        updateStats();
    });

    function updateStats() {
        var text = 'P2P加速引擎已开启 已缓存' + (_totalP2PUploaded/1024).toFixed(2) + 'MB' + ' 已加速' + (_totalP2PDownloaded/1024).toFixed(2)
            + 'MB' + ' 在线' + _peerNum + '人';
        document.getElementById('stats').innerText = text
    }
</script>
<span style="display: none;"><!--统计代码--></span>
</body>
</html>