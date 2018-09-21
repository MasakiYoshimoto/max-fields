var ua = navigator.userAgent;
if (ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0 ) {//スマートフォン
document.open();
document.write('<meta name="viewport" content="width=auto, initial-scale=1, maximum-scale=1">')
document.write('<link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />')
document.write('<link rel="stylesheet" type="text/css" media="screen" href="../css/mobile.css" />')
document.write('<link rel="stylesheet" type="text/css" media="screen" href="../css/slicknav.css" />')
document.write('<script type="text/javascript" src="../js/jquery.slicknav.min.js"></script>')
document.write('<script type="text/javascript" src="../js/jquery.slicknav.settings.js"></script>')
document.write('<script type="text/javascript" src="../js/topscroll2.js"></script>')
document.write('<script type="text/javascript" src="../js/sptouch.js"></script>')
document.close();
}
else{//PC
document.open();
document.write('<meta name="viewport" content="width=1024, initial-scale=1, maximum-scale=1">')
document.write('<link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />')
document.write('<script type="text/javascript" src="../js/topscroll.js"></script>')
document.close();
}