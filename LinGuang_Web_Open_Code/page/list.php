<?php
  session_start();
  if(!isset($_SESSION["userinfo"])){
    $isLogin = 0;
  }else{
    $isLogin = 1;
    $DS = DIRECTORY_SEPARATOR;
    require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
    $userinfo = $_SESSION["userinfo"];
    $user = Db::table("user")->where([["id","=",$userinfo["id"]]])->select()[0];
    //print_r($user);
  }




  if($isLogin==1){
$html1 = <<<eof
    <div style="float: right;width: 45px;height: 45px;background-color: #fff;border-radius: 45px;margin-right: 6%;">
      <mdui-card style="width: 100%;height: 100%;border-radius: 50px;" clickable align="center"
        onclick="location.href='./user_center.php'">
    
    
        <img src="http://q.qlogo.cn/headimg_dl?dst_uin={$user["qq"]}&spec=640&img_type=jpg"
style="width: 100%;height:100%;" />



</mdui-card>
</div>

eof;
}else{
$html1 = <<<eof


<div
  style="float: right;width: 45px;height: 45px;background-color: #fff;border-radius: 45px;margin-right: 6%;">
  <mdui-card style="width: 100%;height: 100%;border-radius: 50px;" clickable align="center"
    onclick="location.href='./user_center.php'">

    <mdui-icon name='person--rounded' style="font-size: 30px;margin-top: 6px;margin-left:1px;color: rgb(94, 94, 94);"></mdui-icon>
  


</mdui-card>
</div>

eof;
}
?>
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



    <div style="text-align: left;margin-top: 40px;margin-left: 6%;">
      <div style="width: 150px;float: left;">
        <h1 id="page_title" style="font-family: 'LYFont', Arial, sans-serif; ">粼光
        </h1>
      </div>
      <?php

      echo $html1;

      ?>

      <!-- <div style="float: right;width: 45px;height: 45px;background-color: #fff;border-radius: 45px;margin-right: 10px;">
        <mdui-card style="width: 100%;height: 100%;border-radius: 50px;" clickable align="center">
          <mdui-button-icon variant="standard" icon="search" style="width: 100%;
        height: 100%;"></mdui-button-icon>

        </mdui-card>
      </div> -->
    </div>
    <br>
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

    <mdui-tabs value="tab-0" placement="top" class="example-placement" full-width
      style="margin-left:20px;margin-right: 20px;margin-top: 20px;margin-bottom: 20px;" id="tabsBar">
      <mdui-tab value="tab-0">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">推荐</text>
      </mdui-tab>
      <mdui-tab value="tab-1">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">应用</text>
      </mdui-tab>
      <mdui-tab value="tab-2">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">热门</text>
      </mdui-tab>
      <mdui-tab value="tab-3">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">分类</text>
      </mdui-tab>
      <mdui-tab value="tab-4">
        <text style="font-family: 'LYFont', Arial, sans-serif;font-size: 18px; ">搜索</text>
      </mdui-tab>

      <mdui-tab-panel slot="panel" value="tab-0">

        <mdui-card style="width: 100%;height: 50px;border-radius: 0 0 15px 15px;">
          <div align="left" style="width: 50px;">
            <mdui-icon name='celebration--rounded'
              style="color: #666 ;font-size: 26px;margin-top: 12px;margin-left: 16px;"></mdui-icon>
          </div>
          <div style="width: 100%;float: left;margin-left: 54px;margin-top: -30px;margin-right: 20px;" align="left">

            <marquee style="width: 100%;color: #444;" scrolldelay="150">
              <?php
              require("../data/notice.php");
              ?>
            </marquee>

          </div>

        </mdui-card>
        <?php
        require("../data/banner.php");
        ?>
      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-1">
        <br>
        <div id="app_recommend">
        </div>

      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-2">
        <br>
        <div id="app_hot">
        </div>
      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-3">

        <mdui-tabs value="vtab-1" placement="left-start" class="example-placement" id="typeBar">
          <mdui-tab value="vtab-1" icon="construction--rounded">实用工具</mdui-tab>
          <mdui-tab value="vtab-2" icon="menu_book--rounded">学习工具</mdui-tab>
          <mdui-tab value="vtab-3" icon="videogame_asset--rounded">休闲娱乐</mdui-tab>
          <mdui-tab value="vtab-4" icon="terminal--rounded">编程开发</mdui-tab>

          <mdui-tab-panel slot="panel" value="vtab-1">
            <div id="app_type1"></div>
          </mdui-tab-panel>
          <mdui-tab-panel slot="panel" value="vtab-2">
            <div id="app_type2"></div>
          </mdui-tab-panel>
          <mdui-tab-panel slot="panel" value="vtab-3">
            <div id="app_type3"></div>
          </mdui-tab-panel>
          <mdui-tab-panel slot="panel" value="vtab-4">
            <div id="app_type4"></div>
          </mdui-tab-panel>
        </mdui-tabs>

      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-4">
        <br>
        <mdui-text-field label="请输入搜索应用名称" placeholder="例：粼光" id="searchBox" class="text_box"></mdui-text-field>

        <div id="app_search" style="margin-top: 20px;"></div>

      </mdui-tab-panel>
    </mdui-tabs>
    <!-- <div align="left" style="margin-left: 5%;margin-top: 20px;margin-bottom: 10px;">
      <text style="font-size: 20px;font-weight: 800;">学习工具</text>
    </div> -->


    <div id="fab_btn" style="z-index: 9999; position: fixed ! important; right: 10px; ">
      <table style="position: absolute; width:260px; right: 0px; top: 0px;">
        <mdui-fab extended variant="surface" icon="arrow_upward">回到顶部</mdui-fab>
      </table>
    </div>
    <mdui-snackbar class="example-snackbar">未能正确获得您的位置，为您展示默认排序，请检查是否授予网页定位访问权限或刷新网页重试。</mdui-snackbar>
    <mdui-snackbar class="location-snackbar">未能正确获得您的位置，将使用上一次成功获取到的存储位置数据。</mdui-snackbar>


    <script>
      // var pageWidth = document.body.clientWidth;
      // var banner = document.querySelectorAll(".banner");
      // for (var i = 0; i < banner.length; i++) {
      //   banner[i].style.width = 0.75 * pageWidth + "px";
      // }
    </script>
    <script>



      window.addEventListener("scroll", function () {
        const scroll_length = document.documentElement.scrollTop
        if (scroll_length >= 50) {
          fab_btn.style.bottom = "20px"
        } else {
          fab_btn.style.bottom = "-80px"
        }
      })

      document.querySelector("#fab_btn").onclick = function () {
        document.querySelector("body").scrollIntoView(true);
      }
      window.addEventListener("scroll", function () {
        const scroll_length = document.documentElement.scrollTop
        //console.log(scroll_length);
        // if (scroll_length >= 50) {
        //   console_head.style.top = "-100px"
        // } else if (scroll_length == 0) {
        //   console_head.style.top = "20px"
        // } else {
        //   console_head.style.top = "20px"
        // }
      })

      const navigation = document.querySelector(".navigation");
      const navigationDrawer = navigation.querySelector("mdui-navigation-drawer");
      const navigationCloseBtn = navigationDrawer.querySelector("#close_btn");
      const menu = document.querySelector("#menu");
      const search_box = document.querySelector("#search_box");

      // menu.addEventListener("click", function () {
      //   navigationDrawer.open = true
      //   console_head.style.top = "-100px"
      // });
      // navigationCloseBtn.addEventListener("click", function () {
      //   navigationDrawer.open = false
      //   console_head.style.top = "20px"
      // });


    </script>
    <!-- //搜索 -->
    <script>
      const text_boxes = document.querySelectorAll(".text_box");
      text_boxes.forEach(text_box => {
        text_box.addEventListener("focus", function () {
        })
        text_box.addEventListener("keyup", function (e) {
          if (e.key == "Enter") {
          } else if (e.key == ' ') {
            text_box.value = text_box.value.trim()
          }
        })
      });

      var searchBox = document.getElementById("searchBox");
      searchBox.addEventListener("keyup", function (e) {
        if (e.key == "Enter") {
          // fetch请求
          var url = `../api/api_searchApp.php?key=${searchBox.value}&type=AppName&format=json`;
          fetch(url, {
            method: "GET",
          })
            .then(response => response.json())
            .then(data => {
              //console.log(data);
              if (data.code !== 1) {
                //未能成功
                //alert(data.message);

                console.log(data);
                if (data.code == -3) {
                  var html = `
                          <text>
          没有搜索到相关应用，你可以通过 <a href="./upload_app.php"><b>应用提单</b></a> 将优质作品分享给大家。
        </text>
              `;

                  var app_search = document.getElementById("app_search");
                  app_search.innerHTML = html;
                }
              } else {
                //成功请求
                data = data.data;

                var app_search = document.getElementById("app_search");
                app_search.innerHTML = '';
                for (let i = 0; i < data.length; i++) {
                  //console.log(data[i]);
                  let AppName = data[i]["AppName"];
                  let AppOneSentenceIntroduction = data[i]["AppOneSentenceIntroduction"];
                  let AppDownloadNum = data[i]["AppDownloadNum"];
                  let AppDownloadUrl = data[i]["AppDownloadUrl"];
                  let AppLogoUrl = data[i]["AppLogoUrl"];
                  let AppId = data[i]["AppId"];

                  // fetch请求
                  var url = `../api/api_getPicture.php?id=${AppLogoUrl}`;
                  fetch(url, {
                    method: "GET",
                  })
                    .then(response => response.json())
                    .then(data => {
                      //console.log(data);
                      if (data.code !== 1) {
                        //未能成功
                        //alert(data.message);

                      } else {
                        //成功请求
                        AppLogoUrl = data.data[0]['data'];
                        var html = `
              <div id="app" style="text-align: center;display: block; width: 100%;"onclick="location.href = '../page/app_content.php?AppId=${AppId}'">
          <div style="height: 70px;" align="left">
            <mdui-card
              style="width: 70px;height: 70px;background-color: #fff;margin-left: 4%;margin-right: 16px;float: left;">
              <img src="${AppLogoUrl}" style="width: 100%;height: 100%;" alt="AppLogoImg">
            </mdui-card>
            <div style="width: 140px;float: left;">
              <text style="font-size: 16px;font-weight: 800;display: block;">${AppName}</text>
              <text style="font-size: 14px;display: block; color: gray;">${AppOneSentenceIntroduction}</text>
              <div style="margin-top: -1px;">
                <mdui-icon name='file_download--outlined'
                  style="color: gray;font-size: 16px;float: left;margin-top: 4px;"></mdui-icon> <text
                  style="font-size: 14px; color: gray;margin-left: 5px;margin-top: -1px;">${AppDownloadNum}次</text>
              </div>
            </div>
            <div style="height: 70px;float:right;margin-right:20px;">
              <mdui-button variant="filled" style="height:34px;margin-top: 16px;" onclick="location.href = '${AppDownloadUrl}'" >获取</mdui-button>
            </div>
          </div>
        </div>
        </br>
        
              
              `;

                        var app_search = document.getElementById("app_search");
                        app_search.innerHTML += html;



                      }
                    })
                    .catch(error => {
                      //异常处理
                      console.log("error: ", error);
                    })


                }

              }
            })
            .catch(error => {
              //异常处理
              console.log("error: ", error);
            })
        }
      })
    </script>
    <!-- //库 -->
    <script>
      var isAppOnLoad = 0;
      var tabsBar = document.getElementById("tabsBar");
      tabsBar.addEventListener('change', function (event) {
        //console.log(tabsBar.value);
        if (tabsBar.value == 'tab-1' && isAppOnLoad == 0) {
          var app_recommend = document.getElementById("app_recommend");
          // fetch请求
          var url = "../api/api_getAllApp.php";

          fetch(url, {
            method: "GET",
          })
            .then(response => response.json())
            .then(data => {
              console.log(data);
              if (data.code !== 1) {
                //未能成功
                //alert(data.message);
                console.log(data);
              } else {
                //成功请求
                data = data.data;

                for (let i = 0; i < data.length; i++) {
                  //console.log(data[i]);
                  let AppName = data[i]["AppName"];
                  let AppOneSentenceIntroduction = data[i]["AppOneSentenceIntroduction"];
                  let AppDownloadNum = data[i]["AppDownloadNum"];
                  let AppDownloadUrl = data[i]["AppDownloadUrl"];
                  let AppLogoUrl = data[i]["AppLogoUrl"];
                  let AppId = data[i]["AppId"];



                  // fetch请求
                  var url = `../api/api_getPicture.php?id=${AppLogoUrl}`;
                  fetch(url, {
                    method: "GET",
                  })
                    .then(response => response.json())
                    .then(data => {
                      //console.log(data);
                      if (data.code !== 1) {
                        //未能成功
                        //alert(data.message);
                      } else {
                        //成功请求
                        AppLogoUrl = data.data[0]['data'];
                        console.log(AppId);
                        var html = `
              <div style="text-align: center;display: block; width: 100%;" onclick="location.href = '../page/app_content.php?AppId=${AppId}'">
          <div style="height: 70px;" align="left">
            <mdui-card
              style="width: 70px;height: 70px;background-color: #fff;margin-left: 4%;margin-right: 16px;float: left;">
              <img src="${AppLogoUrl}" style="width: 100%;height: 100%;" alt="AppLogoImg">
            </mdui-card>
            <div style="width: 140px;float: left;">
              <text style="font-size: 16px;font-weight: 800;display: block;">${AppName}</text>
              <text style="font-size: 14px;display: block; color: gray;">${AppOneSentenceIntroduction}</text>
              <div style="margin-top: -1px;">
                <mdui-icon name='file_download--outlined'
                  style="color: gray;font-size: 16px;float: left;margin-top: 4px;"></mdui-icon> <text
                  style="font-size: 14px; color: gray;margin-left: 5px;margin-top: -1px;">${AppDownloadNum}次</text>
              </div>
            </div>
            <div style="height: 70px;float:right;margin-right:20px;">
              <mdui-button variant="filled" style="height:34px;margin-top: 16px;" onclick="location.href = '${AppDownloadUrl}'" >获取</mdui-button>
            </div>
          </div>
        </div>
        </br>
        
              
              `;

                        var app_recommend = document.getElementById("app_recommend");
                        app_recommend.innerHTML += html;
                      }
                    })
                    .catch(error => {
                      //异常处理
                      console.log("error: ", error);
                    })


                }
                isAppOnLoad = 1;
              }

            })
            .catch(error => {
              //异常处理
              console.log("error: ", error);
            })


        }
      })

    </script>
    <!-- //热门 -->
    <script>
      var isHotOnLoad = 0;
      var tabsBar = document.getElementById("tabsBar");
      tabsBar.addEventListener('change', function (event) {
        //console.log(tabsBar.value);
        if (tabsBar.value == 'tab-2') {
          var app_hot = document.getElementById("app_hot");
          // fetch请求
          var url = "../api/api_searchApp.php?key=0&type=AppType";
          if (isHotOnLoad == 0) {
            fetch(url, {
              method: "GET",
            })
              .then(response => response.json())
              .then(data => {
                //console.log(data);
                if (data.code !== 1) {
                  //未能成功
                  //(data.message);
                  console.log(data);
                } else {
                  //成功请求
                  data = data.data;
                  for (let i = 0; i < data.length; i++) {
                    //console.log(data[i]);
                    let AppName = data[i]["AppName"];
                    let AppOneSentenceIntroduction = data[i]["AppOneSentenceIntroduction"];
                    let AppDownloadNum = data[i]["AppDownloadNum"];
                    let AppDownloadUrl = data[i]["AppDownloadUrl"];
                    let AppLogoUrl = data[i]["AppLogoUrl"];
                    let AppId = data[i]["AppId"];

                    // fetch请求
                    var url = `../api/api_getPicture.php?id=${AppLogoUrl}`;
                    fetch(url, {
                      method: "GET",
                    })
                      .then(response => response.json())
                      .then(data => {
                        //console.log(data);
                        if (data.code !== 1) {
                          //未能成功
                          //alert(data.message);
                        } else {
                          //成功请求
                          AppLogoUrl = data.data[0]['data'];



                          var html = `
              <div id="app" style="text-align: center;display: block; width: 100%;"onclick="location.href = '../page/app_content.php?AppId=${AppId}'">
          <div style="height: 70px;" align="left">
            <mdui-card
              style="width: 70px;height: 70px;background-color: #fff;margin-left: 4%;margin-right: 16px;float: left;">
              <img src="${AppLogoUrl}" style="width: 100%;height: 100%;" alt="AppLogoImg">
            </mdui-card>
            <div style="width: 130px;float: left;">
              <text style="font-size: 18px;font-weight: 800;display: block;">${AppName}</text>
              <text style="font-size: 14px;display: block; color: gray;">${AppOneSentenceIntroduction}</text>
              <div style="margin-top: -1px;">
                <mdui-icon name='file_download--outlined'
                  style="color: gray;font-size: 16px;float: left;margin-top: 4px;"></mdui-icon> <text
                  style="font-size: 14px; color: gray;margin-left: 5px;margin-top: -1px;">${AppDownloadNum}次</text>
              </div>
            </div>
            <div style="height: 70px;float:right;margin-right:20px;">
              <mdui-button variant="filled" style="height:34px;margin-top: 16px;" onclick="location.href = '${AppDownloadUrl}'" >获取</mdui-button>
            </div>
          </div>
        </div>
        </br>
        
              
              `;

                          var app_hot = document.getElementById("app_hot");
                          app_hot.innerHTML += html;
                        }
                      })
                      .catch(error => {
                        //异常处理
                        console.log("error: ", error);
                      })


                  }

                  isHotOnLoad = 1;
                }

              })
              .catch(error => {
                //异常处理
                console.log("error: ", error);
              })
          }
        }
      })

    </script>
    <!-- //分类 -->
    <script>
      var isTypeOnLoad = 0;
      var tabsBar = document.getElementById("tabsBar");
      tabsBar.addEventListener('change', function (event) {
        //console.log(tabsBar.value);
        if (tabsBar.value == 'tab-3' && isTypeOnLoad == 0) {
          // fetch请求
          var url = "../api/api_searchApp.php?key=1&type=AppType";

          fetch(url, {
            method: "GET",
          })
            .then(response => response.json())
            .then(data => {
              //console.log(data);
              if (data.code !== 1) {
                //未能成功
                //alert(data.message);
                console.log(data);
              } else {
                //成功请求
                data = data.data;
                for (let i = 0; i < data.length; i++) {
                  //console.log(data[i]);
                  let AppName = data[i]["AppName"];
                  let AppOneSentenceIntroduction = data[i]["AppOneSentenceIntroduction"];
                  let AppDownloadNum = data[i]["AppDownloadNum"];
                  let AppDownloadUrl = data[i]["AppDownloadUrl"];
                  let AppLogoUrl = data[i]["AppLogoUrl"];
                  let AppId = data[i]["AppId"];

                  // fetch请求
                  var url = `../api/api_getPicture.php?id=${AppLogoUrl}`;
                  fetch(url, {
                    method: "GET",
                  })
                    .then(response => response.json())
                    .then(data => {
                      //console.log(data);
                      if (data.code !== 1) {
                        //未能成功
                        //alert(data.message);
                      } else {
                        //成功请求
                        AppLogoUrl = data.data[0]['data'];



                        var html = `
              <div id="app"
          style="text-align: center;display: block; width: 100%;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;" onclick="location.href = '../page/app_content.php?AppId=${AppId}'">
          <div style="height: 60px;" align="left">
            <mdui-card
              style="width: 60px;height: 60px;background-color: #fff;margin-left: 5%;margin-right: 16px;float: left;">
              <img src="${AppLogoUrl}" style="width: 100%;height: 100%;" alt="AppLogoImg">
            </mdui-card>
            <div style="width: 160px;float: left;margin-top: 5px;">
              <text style="font-size: 18px;font-weight: 800;display: block;">${AppName}</text>
              <text style="font-size: 14px;display: block; color: gray;">${AppOneSentenceIntroduction}</text>

            </div>

          </div>
        </div>
        


      </div>
        
        `;

                        var app_type1 = document.getElementById("app_type1");
                        app_type1.innerHTML += html;
                      }
                    })
                    .catch(error => {
                      //异常处理
                      console.log("error: ", error);
                    })


                }
                isTypeOnLoad = 1;
                isType1OnLoad = 1;
              }

            })
            .catch(error => {
              //异常处理
              console.log("error: ", error);
            })

        }
      })

    </script>
    <!-- //分类1 -->
    <script>
      var isType1OnLoad = 0;
      var typeBar = document.getElementById("typeBar");
      typeBar.addEventListener('change', function (event) {
        //console.log(typeBar.value);
        if (typeBar.value == 'vtab-1' && isType1OnLoad == 0) {
          // fetch请求
          var url = "../api/api_searchApp.php?key=1&type=AppType";

          fetch(url, {
            method: "GET",
          })
            .then(response => response.json())
            .then(data => {
              //console.log(data);
              if (data.code !== 1) {
                //未能成功
                //alert(data.message);
                console.log(data);
              } else {
                //成功请求
                data = data.data;
                for (let i = 0; i < data.length; i++) {
                  //console.log(data[i]);
                  let AppName = data[i]["AppName"];
                  let AppOneSentenceIntroduction = data[i]["AppOneSentenceIntroduction"];
                  let AppDownloadNum = data[i]["AppDownloadNum"];
                  let AppDownloadUrl = data[i]["AppDownloadUrl"];
                  let AppLogoUrl = data[i]["AppLogoUrl"];
                  let AppId = data[i]["AppId"];

                  // fetch请求
                  var url = `../api/api_getPicture.php?id=${AppLogoUrl}`;
                  fetch(url, {
                    method: "GET",
                  })
                    .then(response => response.json())
                    .then(data => {
                      //console.log(data);
                      if (data.code !== 1) {
                        //未能成功
                        //alert(data.message);
                      } else {
                        //成功请求
                        AppLogoUrl = data.data[0]['data'];



                        var html = `
              <div id="app"
          style="text-align: center;display: block; width: 100%;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;" onclick="location.href = '../page/app_content.php?AppId=${AppId}'">
          <div style="height: 60px;" align="left">
            <mdui-card
              style="width: 60px;height: 60px;background-color: #fff;margin-left: 5%;margin-right: 16px;float: left;">
              <img src="${AppLogoUrl}" style="width: 100%;height: 100%;" alt="AppLogoImg">
            </mdui-card>
            <div style="width: 160px;float: left;margin-top: 5px;">
              <text style="font-size: 18px;font-weight: 800;display: block;">${AppName}</text>
              <text style="font-size: 14px;display: block; color: gray;">${AppOneSentenceIntroduction}</text>

            </div>

          </div>
        </div>
        


      </div>
        
        `;

                        var app_type1 = document.getElementById("app_type1");
                        app_type1.innerHTML += html;
                      }
                    })
                    .catch(error => {
                      //异常处理
                      console.log("error: ", error);
                    })


                }
                isType1OnLoad = 1;
              }

            })
            .catch(error => {
              //异常处理
              console.log("error: ", error);
            })


        }
      })

    </script>
    <!-- //分类2 -->
    <script>
      var isType2OnLoad = 0;
      var typeBar = document.getElementById("typeBar");
      typeBar.addEventListener('change', function (event) {
        //console.log(typeBar.value);
        if (typeBar.value == 'vtab-2' && isType2OnLoad == 0) {
          // fetch请求
          var url = "../api/api_searchApp.php?key=2&type=AppType";

          fetch(url, {
            method: "GET",
          })
            .then(response => response.json())
            .then(data => {
              //console.log(data);
              if (data.code !== 1) {
                //未能成功
                //alert(data.message);
                console.log(data);
              } else {
                //成功请求
                data = data.data;
                for (let i = 0; i < data.length; i++) {
                  //console.log(data[i]);
                  let AppName = data[i]["AppName"];
                  let AppOneSentenceIntroduction = data[i]["AppOneSentenceIntroduction"];
                  let AppDownloadNum = data[i]["AppDownloadNum"];
                  let AppDownloadUrl = data[i]["AppDownloadUrl"];
                  let AppLogoUrl = data[i]["AppLogoUrl"];
                  let AppId = data[i]["AppId"];

                  // fetch请求
                  var url = `../api/api_getPicture.php?id=${AppLogoUrl}`;
                  fetch(url, {
                    method: "GET",
                  })
                    .then(response => response.json())
                    .then(data => {
                      //console.log(data);
                      if (data.code !== 1) {
                        //未能成功
                        //alert(data.message);
                      } else {
                        //成功请求
                        AppLogoUrl = data.data[0]['data'];



                        var html = `
              <div id="app"
          style="text-align: center;display: block; width: 100%;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;" onclick="location.href = '../page/app_content.php?AppId=${AppId}'">
          <div style="height: 60px;" align="left">
            <mdui-card
              style="width: 60px;height: 60px;background-color: #fff;margin-left: 5%;margin-right: 16px;float: left;">
              <img src="${AppLogoUrl}" style="width: 100%;height: 100%;" alt="AppLogoImg">
            </mdui-card>
            <div style="width: 160px;float: left;margin-top: 5px;">
              <text style="font-size: 18px;font-weight: 800;display: block;">${AppName}</text>
              <text style="font-size: 14px;display: block; color: gray;">${AppOneSentenceIntroduction}</text>

            </div>

          </div>
        </div>
        


      </div>
        
        `;
                        var app_type2 = document.getElementById("app_type2");
                        app_type2.innerHTML += html;
                      }
                    })
                    .catch(error => {
                      //异常处理
                      console.log("error: ", error);
                    })


                }
                isType2OnLoad = 1;
              }

            })
            .catch(error => {
              //异常处理
              console.log("error: ", error);
            })




        }
      })

    </script>
    <!-- //分类3 -->
    <script>
      var isType3OnLoad = 0;
      var typeBar = document.getElementById("typeBar");
      typeBar.addEventListener('change', function (event) {
        //console.log(typeBar.value);
        if (typeBar.value == 'vtab-3' && isType3OnLoad == 0) {
          // fetch请求
          var url = "../api/api_searchApp.php?key=3&type=AppType";

          fetch(url, {
            method: "GET",
          })
            .then(response => response.json())
            .then(data => {
              //console.log(data);
              if (data.code !== 1) {
                //未能成功
                //alert(data.message);
                console.log(data);
              } else {
                //成功请求
                data = data.data;
                for (let i = 0; i < data.length; i++) {
                  //console.log(data[i]);
                  let AppName = data[i]["AppName"];
                  let AppOneSentenceIntroduction = data[i]["AppOneSentenceIntroduction"];
                  let AppDownloadNum = data[i]["AppDownloadNum"];
                  let AppDownloadUrl = data[i]["AppDownloadUrl"];
                  let AppLogoUrl = data[i]["AppLogoUrl"];
                  let AppId = data[i]["AppId"];

                  // fetch请求
                  var url = `../api/api_getPicture.php?id=${AppLogoUrl}`;
                  fetch(url, {
                    method: "GET",
                  })
                    .then(response => response.json())
                    .then(data => {
                      //console.log(data);
                      if (data.code !== 1) {
                        //未能成功
                        //alert(data.message);
                      } else {
                        //成功请求
                        AppLogoUrl = data.data[0]['data'];



                        var html = `
              <div id="app"
          style="text-align: center;display: block; width: 100%;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;" onclick="location.href = '../page/app_content.php?AppId=${AppId}'">
          <div style="height: 60px;" align="left">
            <mdui-card
              style="width: 60px;height: 60px;background-color: #fff;margin-left: 5%;margin-right: 16px;float: left;">
              <img src="${AppLogoUrl}" style="width: 100%;height: 100%;" alt="AppLogoImg">
            </mdui-card>
            <div style="width: 160px;float: left;margin-top: 5px;">
              <text style="font-size: 18px;font-weight: 800;display: block;">${AppName}</text>
              <text style="font-size: 14px;display: block; color: gray;">${AppOneSentenceIntroduction}</text>

            </div>

          </div>
        </div>
        


      </div>
        
        `;

                        var app_type3 = document.getElementById("app_type3");
                        app_type3.innerHTML += html;
                      }
                    })
                    .catch(error => {
                      //异常处理
                      console.log("error: ", error);
                    })


                }
                isType3OnLoad = 1;
              }

            })
            .catch(error => {
              //异常处理
              console.log("error: ", error);
            })



        }
      })

    </script>
    <!-- //分类4 -->
    <script>
      var isType4OnLoad = 0;
      var typeBar = document.getElementById("typeBar");
      typeBar.addEventListener('change', function (event) {
        //console.log(typeBar.value);
        if (typeBar.value == 'vtab-4' && isType4OnLoad == 0) {
          // fetch请求
          var url = "../api/api_searchApp.php?key=4&type=AppType";

          fetch(url, {
            method: "GET",
          })
            .then(response => response.json())
            .then(data => {
              //console.log(data);
              if (data.code !== 1) {
                //未能成功
                //alert(data.message);
                console.log(data);
              } else {
                //成功请求
                data = data.data;
                for (let i = 0; i < data.length; i++) {
                  //console.log(data[i]);
                  let AppName = data[i]["AppName"];
                  let AppOneSentenceIntroduction = data[i]["AppOneSentenceIntroduction"];
                  let AppDownloadNum = data[i]["AppDownloadNum"];
                  let AppDownloadUrl = data[i]["AppDownloadUrl"];
                  let AppLogoUrl = data[i]["AppLogoUrl"];
                  let AppId = data[i]["AppId"];

                  // fetch请求
                  var url = `../api/api_getPicture.php?id=${AppLogoUrl}`;
                  fetch(url, {
                    method: "GET",
                  })
                    .then(response => response.json())
                    .then(data => {
                      //console.log(data);
                      if (data.code !== 1) {
                        //未能成功
                        //alert(data.message);
                      } else {
                        //成功请求
                        AppLogoUrl = data.data[0]['data'];



                        var html = `
              <div id="app"
          style="text-align: center;display: block; width: 100%;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;" onclick="location.href = '../page/app_content.php?AppId=${AppId}'">
          <div style="height: 60px;" align="left">
            <mdui-card
              style="width: 60px;height: 60px;background-color: #fff;margin-left: 5%;margin-right: 16px;float: left;">
              <img src="${AppLogoUrl}" style="width: 100%;height: 100%;" alt="AppLogoImg">
            </mdui-card>
            <div style="width: 160px;float: left;margin-top: 5px;">
              <text style="font-size: 18px;font-weight: 800;display: block;">${AppName}</text>
              <text style="font-size: 14px;display: block; color: gray;">${AppOneSentenceIntroduction}</text>

            </div>

          </div>
        </div>
        


      </div>
        </br>
        `;

                        var app_type4 = document.getElementById("app_type4");
                        app_type4.innerHTML += html;
                      }
                    })
                    .catch(error => {
                      //异常处理
                      console.log("error: ", error);
                    })


                }
                isType4OnLoad = 1;
              }

            })
            .catch(error => {
              //异常处理
              console.log("error: ", error);
            })



        }
      })

    </script>
  </body>

  <?php
  require("../page/footer.php");
  ?>


</html>