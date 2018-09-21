var ua = navigator.userAgent;
if (ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0 ) {//スマートフォン
document.open();
document.write('<meta name="viewport" content="width=auto, initial-scale=1, maximum-scale=1">')
document.write('<link rel="stylesheet" type="text/css" media="screen" href="../css/maxfields.css" />')
document.write('<link rel="stylesheet" type="text/css" media="screen" href="../css/maxfields_sp.css" />')
document.close();
}
else{//PC
document.open();
document.write('<meta name="viewport" content="width=1024, initial-scale=1, maximum-scale=1">')
document.write('<link rel="stylesheet" type="text/css" media="screen" href="../css/maxfields.css" />')
document.close();
}