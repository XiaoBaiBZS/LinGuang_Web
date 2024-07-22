<!DOCTYPE html>
<html lang="zh-cn">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼光</title>
    <link rel="icon" href="../src/favicon.png">
    <link rel="stylesheet" href="https://unpkg.com/mdui@2.0.3/mdui.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
    <script src="https://unpkg.com/mdui@2.0.3/mdui.global.js"></script>
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <style src="../css/style.css"></style>
    <style>
      #page_title {
        display: inline
      }

      a {
        text-decoration: none;
        border-bottom: 1.25px solid transparent;
      }

      a:hover {
        border-bottom: 1.25px solid rgb(108, 28, 108);
        transition: border-bottom 0.9s ease;
      }

      /* 状态一: 未被访问过的链接 */
      a:link {
        text-decoration: none;
        color: #000;
      }

      /* 状态二: 已经访问过的链接 */
      a:visited {
        text-decoration: none;
        color: #000;
      }

      /* 状态三: 鼠标划过(停留)的链接(默认红色) */
      a:hover {
        text-decoration: none;
        color: #000;
      }

      /* 状态四: 被点击的链接 */
      a:active {
        text-decoration: none;
        color: #000;
      }


      /* .search-btn:focus {
        transition: all .3s;
    } */

      /* .search-btn:focus {
      width: 200px;
    } */

      .item {
        width: 90%;
        /* height: 100px; */
        margin-top: 20px;
        padding: 10px;
        padding-left: 20px;
        padding-left: 20px;
        text-align: left;
      }

      .item-title {
        font-size: 23px;
        font-weight: 700;

      }

      .item-introduction {
        font-size: 16px;
        font-weight: 500;
        color: gray;

      }

      .item-chip {
        width: auto;
        height: 28px;
        margin-top: 5px
      }

      .footer-item-title {
        font-size: 20px;
        font-weight: 700;
      }

      .footer-item-content {
        font-size: 17px;
        font-weight: 500;
      }

      .custom-item {
        padding: 4px 12px;
      }

      .custom-item .secondary {
        display: none;
        color: #888;
        font-size: 13px;
      }

      .custom-item:hover .secondary {
        display: block
      }

      /* #rank_btn:hover {
        width: 130px;
      transition: width 2s ease;
    }
    
    #search_btn:hover {
      width: 130px;
      transition: width 2s ease;
    } */

      #fab_btn {
        /* opacity: 0; */
        bottom: -80px;
        transition: all 0.8s ease;
      }

      #console_head {
        /* opacity: 0; */
        /* top: -80px; */
        transition: all 0.8s ease;
      }

      @font-face {
        font-family: "HLFont";
        src: url("../src/font/HongLeiXingShuJianTi-2.otf");
      }

      @font-face {
        font-family: "LYFont";
        src: url("../src/font/LXGWWenKai-Regular.ttf");
      }
    </style>
  </head>


  <body style="text-align: center;">

    <div class="navigation" style="position: relative; overflow: hidden">
      <mdui-navigation-drawer modal style="text-align: left;">
        <!-- <mdui-button class="close">关闭侧边抽屉栏</mdui-button> -->
        <mdui-list-subheader style="margin-top: 30px;">
          <span style="font-size: 24px;font-weight: 700;margin-left: 10px;">目录</span>
          <mdui-button-icon icon="close" style="margin-right: 10px;margin-top:10px;float: right;"
            id="close_btn"></mdui-button-icon>

        </mdui-list-subheader>
        <br>
        <mdui-collapse accordion id="navigation_content">
          <mdui-list style="margin-left: 10px;margin-right: 10px;">
            <mdui-list-item icon="home--outlined" rounded onclick="location.href='../index.php'">主页</mdui-list-item>
            <mdui-list-item icon="share--outlined" rounded
              onclick="location.href='../page/upload_app.php'">分享应用</mdui-list-item>
            <mdui-list-item icon="account_circle--outlined" rounded
              onclick="location.href='./user_center.php'">个人中心</mdui-list-item>
            <mdui-list-item icon="explore--outlined" rounded onclick="location.href='../page/'">粼光社区</mdui-list-item>
            <!-- <mdui-list-item icon="people" rounded>Headline</mdui-list-item> -->
          </mdui-list>
        </mdui-collapse>


      </mdui-navigation-drawer>

    </div>
    <!-- <div style="float: left;width: 100%;"> -->

    <div id="console_head" style="z-index: 9999; position: fixed ! important; top: 20px; left:5%;width: 90%;">

      <mdui-card style="width: 100%;height: 60px;text-align: right;">
        <mdui-button-icon icon="menu" style="float:left;margin-top: 10px;margin-left: 10px;"
          id="menu"></mdui-button-icon>


        <!-- 
        <mdui-dropdown>

          <mdui-button variant="text" slot="trigger" id="search_btn" style="margin-right: 10px;margin-top: 10px;"
            icon='account_circle--outlined' onclick="window.open('../page/user_center.php')">个人中心</mdui-button>
        </mdui-dropdown>

        <mdui-dropdown>

          <mdui-button variant="text" icon="explore--outlined" slot="trigger" id="search_btn"
            style="margin-right: 10px;margin-top: 10px;"
            onclick="window.open('https://support.qq.com/products/628635')">寻迹社区</mdui-button>
        </mdui-dropdown> -->
        <div style="margin-left: 10px;">

          <mdui-dropdown>
            <mdui-button variant="text" icon="sort--outlined" slot="trigger" id="rank_btn"
              style="margin-right: 10px;margin-top: 10px;">排序</mdui-button>
          </mdui-dropdown>
          <mdui-dropdown>
            <mdui-button variant="text" icon="sell--outlined" slot="trigger" id="rank_btn"
              style="margin-right: 10px;margin-top: 10px;">筛选</mdui-button>
          </mdui-dropdown>

        </div>
      </mdui-card>

    </div>

    <div style="text-align: left;margin-top: 100px;margin-left: 6%;">
      <div style="width: 150px;float: left;">
        <h1 id="page_title" style="font-family: 'LYFont', Arial, sans-serif; ">粼光
        </h1>
      </div>


    </div>
    <br>
    <!-- <mdui-text-field icon="search" clearable label="请输入应用名称" placeholder="例：粼光"
      style="width: 90%;margin-right: 10px;margin-left: 10px;margin-top: 15px;" id="search_box"></mdui-text-field> -->
    <!-- <div style="width: 90%;margin-left: 5%;margin-right: 5%; margin-top: 20px; " id="banner_head" variant="filled"
      onclick="window.open('../page/document.php?id=9')">
      <img src="../src/banner/banner_01.webp" style="width: 100%;" alt="杭城迹忆推荐">
      <mdui-card clickable style="text-align: left;margin-top: -5px;width: 100%;border-radius: 0px 0px 15px 15px;">
        <p style="font-size: 18px;font-weight: 700;margin-left: 20px;">漫步西湖边，赏花如春意 </p>
        <p style="font-size: 16px;color: gray; margin-top: -12px;margin-left: 20px;">是春光萃西子，底须秋水悟南华！ </p>
      </mdui-card>
    </div> -->

    <mdui-tabs value="tab-1" placement="top" class="example-placement" full-width
      style="margin-left:20px;margin-right: 20px;margin-top: 20px;margin-bottom: 20px;">
      <mdui-tab value="tab-1">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">推荐</text>
      </mdui-tab>
      <mdui-tab value="tab-2">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">工具</text>
      </mdui-tab>
      <mdui-tab value="tab-3">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">学习</text>
      </mdui-tab>
      <mdui-tab value="tab-4">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">编程</text>
      </mdui-tab>




      <mdui-tab-panel slot="panel" value="tab-1">
      </mdui-tab-panel>
    </mdui-tabs>
    <!-- <div align="left" style="margin-left: 5%;margin-top: 20px;margin-bottom: 10px;">
      <text style="font-size: 20px;font-weight: 800;">学习工具</text>
    </div> -->
    <div id="list" style="text-align: center;display: block;">
      <div style="height: 70px;" align="left">
        <mdui-card
          style="width: 70px;height: 70px;background-color: #fff;margin-left: 5%;margin-right: 16px;float: left;">
          <img src="../src/favicon.png" style="width: 100%;height: 100%;" alt="AppLogoImg">
        </mdui-card>
        <div style="width: 200px;float: left;">
          <text style="font-size: 20px;font-weight: 800;display: block;">粼光</text>
          <text style="font-size: 16px;display: block; color: gray;">粼光的一句话介绍</text>
          <div style="margin-top: -1px;">
            <mdui-icon name='file_download--outlined'
              style="color: gray;font-size: 16px;float: left;margin-top: 4px;"></mdui-icon> <text
              style="font-size: 14px; color: gray;margin-left: 5px;margin-top: -1px;">1次</text>
          </div>
        </div>
        <div style="height: 70px;">
          <mdui-button variant="filled" style="height:34px;margin-top: 16px;">获取</mdui-button>
        </div>
      </div>
    </div>

    <div id="fab_btn" style="z-index: 9999; position: fixed ! important; right: 10px; ">
      <table style="position: absolute; width:260px; right: 0px; top: 0px;">
        <mdui-fab extended variant="surface" icon="arrow_upward">回到顶部</mdui-fab>
      </table>
    </div>
    <mdui-snackbar class="example-snackbar">未能正确获得您的位置，为您展示默认排序，请检查是否授予网页定位访问权限或刷新网页重试。</mdui-snackbar>
    <mdui-snackbar class="location-snackbar">未能正确获得您的位置，将使用上一次成功获取到的存储位置数据。</mdui-snackbar>

    <script>

      window.addEventListener("scroll", function () {
        const scroll_length = document.documentElement.scrollTop
        if (scroll_length >= 50) {
          fab_btn.style.bottom = "20px"
        } else {
          fab_btn.style.bottom = "-80px"
        }
      })
      window.addEventListener("scroll", function () {
        const scroll_length = document.documentElement.scrollTop
        console.log(scroll_length);
        if (scroll_length >= 50) {
          console_head.style.top = "-100px"
        } else if (scroll_length == 0) {
          console_head.style.top = "20px"
        } else {
          console_head.style.top = "20px"
        }
      })

      const navigation = document.querySelector(".navigation");
      const navigationDrawer = navigation.querySelector("mdui-navigation-drawer");
      const navigationCloseBtn = navigationDrawer.querySelector("#close_btn");
      const menu = document.querySelector("#menu");
      const search_box = document.querySelector("#search_box");

      menu.addEventListener("click", function () {
        navigationDrawer.open = true
        console_head.style.top = "-100px"
      });
      navigationCloseBtn.addEventListener("click", function () {
        navigationDrawer.open = false
        console_head.style.top = "20px"
      });


    </script>
  </body>

  <?php
  require("../page/footer.php");
  ?>


</html>