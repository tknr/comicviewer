<?php
$v = time();
?>
<html>
<head>
<title>Comic Viewer</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/images/comics.png" />
<link href="assets/css/view.css?v=<?=$v?>" rel="stylesheet">
</head>
<body ondragstart="return false" ondrop="return false" oncopy="return false" oncut="return false" onpaste="return false">

<!-- Page -->
<div id="divPage">
  <div class="divImg" id="divImg_0"><img class="imgComics" id="img_0"></div>
  <div class="divImg" id="divImg_1"><img class="imgComics" id="img_1"></div>
  <div class="divImg" id="divImg_2"><img class="imgComics" id="img_2"></div>
</div>

<div id="divDisplayPage"></div>
<div id="divPageBar"></div>

<!-- Menu -->
<div id="divMenuButton"></div>
<div id="divMenu">
  <button id="btnFullscreen">Full Screen</button>
  <button id="btnEnableNav">Navigation</button>
  <button id="btnChangeDir">Direction</button>
  Vertical Move<br>
  <button class="small_button" data-inc="-1">F</button>
  <button class="small_button" data-inc="0">+0</button>
  <button class="small_button" data-inc="1">+1</button>
  <button class="small_button" data-inc="2">+2</button>
  <button id="btnExit">Exit</button>
</div>

<!-- Script -->
<script src="assets/js/viewUtils.js?v=<?=$v?>"></script>
<script src="assets/js/viewPageInfo.js?v=<?=$v?>"></script>
<script src="assets/js/viewPageHandler.js?v=<?=$v?>"></script>
<script src="assets/js/viewPageBar.js?v=<?=$v?>"></script>
<script src="assets/js/view.js?v=<?=$v?>"></script>

</body>
</html>
