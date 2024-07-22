<?php
$html=<<<eof
<footer>
  
  <style>
    .footer-item-title {
      font-weight: 800;
    }
  </style>
  <mdui-dialog close-on-overlay-click class="example-overlay1" align="center">
    <h2>感谢您的支持！</h2><img src="../src/wechat.jpg" style="width: 80%;"><br>
  </mdui-dialog>
  <mdui-dialog close-on-overlay-click class="example-overlay2"  align="center">
    <h2>感谢您的支持！</h2><img src="../src/alipay.jpg" style="width: 80%;"><br>
  </mdui-dialog>


  <div class="divider" style="text-align: left;margin-top: 30px;" data-v-6022fb55=""><svg aria-hidden="true"
      width="100%" height="8" fill="none" xmlns="http://www.w3.org/2000/svg" data-v-6022fb55="">
      <pattern id="a" width="91" height="8" patternUnits="userSpaceOnUse" data-v-6022fb55="">
        <g clip-path="url(#clip0_2426_11367)" data-v-6022fb55="">
          <path
            d="M114 4c-5.067 4.667-10.133 4.667-15.2 0S88.667-.667 83.6 4 73.467 8.667 68.4 4 58.267-.667 53.2 4 43.067 8.667 38 4 27.867-.667 22.8 4 12.667 8.667 7.6 4-2.533-.667-7.6 4s-10.133 4.667-15.2 0S-32.933-.667-38 4s-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0-10.133-4.667-15.2 0-10.133 4.667-15.2 0"
            stroke="#E1E3E1" stroke-linecap="square" data-v-6022fb55=""></path>
        </g>
      </pattern>
      <rect width="100%" height="100%" fill="url(#a)" data-v-6022fb55=""></rect>
    </svg>
  </div>

  <div>
    <div style="float: left;margin-left: 10%;text-align: left;margin-top: 30px;">
      <p class="footer-item-title">社区</p>

      <a class="footer-item-content" href="https://github.com/XiaoBaiBZS/HangchengMemory">GitHub Issue</a>
      <br>
      <div style="height: 5px;"></div>
      <a class="footer-item-content" href="https://support.qq.com/products/628635">粼光社区</a>
      <br>
      <br>
      <br>
      <br>
    </div>
    <div style="float: left;margin-left: 20px;text-align: left;margin-top: 30px;">
      <mdui-tooltip variant="rich" headline="这是一个免费项目" content="网站需要资金来进行搭建与维护，您可以通过捐赠来支持项目发展。">
        <p class="footer-item-title">赞助</p>

      </mdui-tooltip>

      <a class="footer-item-content" id="wechat">微信</a>
      <br>
      <div style="height: 5px;"></div>
      <a class="footer-item-content" id="alipay">支付宝</a>
      <br>
      <div style="height: 5px;"></div>
      <!-- <a class="footer-item-content" onclick="window.open('https://afdian.net/a/hclove')">爱发电</a> -->
      <br>
      <br>
      <br>
      <br>

    </div>
    <div style="float: left;margin-left: 20px;text-align: left;margin-top: 30px;">
      <p class="footer-item-title">服务</p>

      <a class="footer-item-content" href="../page/serviceitem.php">用户隐私协议</a>
      <br>
      <!-- <div style="height: 5px;"></div>
      <a class="footer-item-content" href="https://support.qq.com/products/628635">举报与反馈</a>
      <br>
      <div style="height: 5px;"></div>
      <a class="footer-item-content" href="../page/code_with_me_introduction.php">与我同行</a> -->
      <br>
      <br>
      <br>
    </div>
    <br>
  </div>
  
  <br>
  <div style="width:90%;float: left;margin-bottom: 20px;text-align: left;margin-left: 10%;margin-right: 20px;">

    <a style="color:#000;" href="https://beian.miit.gov.cn/state/outPortal/loginPortal.action/#/Integrated/index"
      target="_blank">
      <img style=" width: 15px; height: 15px;margin-right: 5px;" src="../src/police.png">桂ICP备2022004937号-7</a>
    <br><br><a onclick="window.open('../page/XiaoBaiBZS.php')">@XiaoBaiBZS与粼光合作作品</a>
  </div>
  <script>
    const dialog_footer_wechat = document.querySelector(".example-overlay1");
    const dialog_footer_alipay = document.querySelector(".example-overlay2");
    const wechat = document.querySelector("#wechat")
    const alipay = document.querySelector("#alipay")
    wechat.addEventListener("click", function () { dialog_footer_wechat.open = true })
    alipay.addEventListener("click", function () { dialog_footer_alipay.open = true })
  </script>
</footer>

eof;
echo($html);
?>