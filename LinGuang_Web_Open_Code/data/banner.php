<?php
$html=<<<eof



<div style="width: 320px;margin-left: 5%;margin-right: 5%; margin-top: 20px;display: inline-block; "
id="banner_01" variant="filled" onclick="window.open('../page/document.php?id=9')" class="banner">
<img src="../src/banner/banner_01.webp" style="width: 100%;" alt="杭城迹忆推荐">
<mdui-card clickable style="text-align: left;margin-top: -5px;width: 100%;border-radius: 0px 0px 15px 15px;">
  <p style="font-size: 18px;font-weight: 700;margin-left: 20px;">今日推荐</p>
  <p style="font-size: 16px;color: gray; margin-top: -12px;margin-left: 20px;">轻听美好音乐</p>
</mdui-card>
</div>

<div style="width: 320px;margin-left: 5%;margin-right: 5%; margin-top: 20px; display: inline-block; "
id="banner_02" variant="filled" onclick="window.open('../page/document.php?id=9')" class="banner">
<img src="../src/banner/banner_02.webp" style="width: 100%;" alt="杭城迹忆推荐">
<mdui-card clickable style="text-align: left;margin-top: -5px;width: 100%;border-radius: 0px 0px 15px 15px;">
  <p style="font-size: 18px;font-weight: 700;margin-left: 20px;">漫步西湖边，赏花如春意 </p>
  <p style="font-size: 16px;color: gray; margin-top: -12px;margin-left: 20px;">是春光萃西子，底须秋水悟南华！ </p>
</mdui-card>
</div>


eof;
echo($html);
?>