<?php
$DS = DIRECTORY_SEPARATOR;
require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";

  $AppId = isset($_GET["AppId"])?$_GET["AppId"]:'';
  $data = Db::table("app_data")->where([["AppId","=",$AppId]])->select()[0];
  //print_r($data);
  
?>


<!DOCTYPE html>
<html lang="zh-cn">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼光-<?php echo($data["AppName"]); ?></title>
    <link rel="icon" href="../src/favicon.png">
    <link rel="stylesheet" href="https://unpkg.com/mdui@2.0.3/mdui.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Two+Tone" rel="stylesheet">
    <script src="https://unpkg.com/mdui@2.0.3/mdui.global.js"></script>
    <style>
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

      .search-btn:hover {
        transition: all .3s ease-in-out;
      }

      .search-btn:hover {
        width: 100px;
      }

      .text-title {
        font-size: 22px;
        font-weight: 400;
      }


      .app-name {
        font-size: 24px;
        font-weight: 800;
      }

      .app-one-sentence-introduction {
        font-size: 18px;
        color: gray;
      }

      body {
        margin: 0px;
      }
    </style>
  </head>

  <body style="text-align:center;">

    <div id="fab_btn" style="z-index: 9999; position: fixed ! important; bottom:0px ;width: 100%;">
      <div
        style="width: 100%;padding-top: 40px;padding-bottom: 40px; background:linear-gradient(rgba(255, 255, 255, 0),rgba(255, 255, 255, 0.8),rgb(255, 255, 255))"
        align="center">
        <mdui-button-icon variant="standard" icon="warning_amber--rounded"></mdui-button-icon>
        <mdui-button variant="filled" icon='download--rounded' id="AppDownloadBtn"
          style="width: 50%;margin-left: 20px;margin-right: 20px;">

          <h3>获取应用</h3>

        </mdui-button>
        <mdui-button-icon variant="standard" icon="share--rounded"></mdui-button-icon>
      </div>

    </div>

    <div style="margin-left: 5%;margin-right: 5%;width: 90%;height: 140px;margin-top: 60px;">
      <mdui-card style="width: 100px;height: 100px;margin-left: 20px;margin-top: -10px;  float: left;">

        <img src="" alt="" id="AppLogoImg" style="border-radius: 10px;width: 100%;height: 100%;">
      </mdui-card>
      <div style="margin-left: 140px;height: 100px;margin-top: 20px;margin-right: 20px;" align="left">

        <text class="app-name" id="AppNameTip"><?php echo($data["AppName"]); ?></text>
        <br>
        <text class="app-one-sentence-introduction"
          id="AppOneSentenceIntroductionTip"><?php echo($data["AppOneSentenceIntroduction"]); ?></text>
        <br>
        <text class="app-one-sentence-introduction" id="AppVersionTip"><?php echo($data["AppVersion"]); ?></text>


      </div>
    </div>
    <mdui-card style="width: 90%;height: 88px;margin-left:5%;margin-right: 5%; margin-top: -20px;">
      <div
        style="width: 30%;height: 100%; margin-left: 0%;display: inline-block;vertical-align: top;padding-top: 15px;padding-bottom: 10px;">
        <text
          style="font-size: 20px;font-weight: 800;color: rgb(81, 81, 81);"><?php echo(($data["AppScore"]==0)?'暂无评':round($data["AppScore"], 1)); ?>分</text>
        <br>
        <text style="font-size: 16px;font-weight: 400;color:gray;"><?php echo($data["AppScoreNum"]); ?>个评分</text>
      </div>
      <div
        style="width: 30%;height: 100%; margin-left: 0%;display: inline-block;vertical-align: top;padding-top: 15px;padding-bottom: 10px;">
        <text
          style="font-size: 20px;font-weight: 800;color: rgb(81, 81, 81);"><?php echo($data["AppDownloadNum"]); ?>次</text>
        <br>
        <text style="font-size: 16px;font-weight: 400;color:gray;">下载次数</text>
      </div>
      <div
        style="width: 30%;height: 100%; margin-left: 0%;display: inline-block;vertical-align: top;padding-top: 15px;padding-bottom: 10px;">
        <text
          style="font-size: 20px;font-weight: 800;color: rgb(81, 81, 81);"><?php echo((($data["AppDeveloper"]==0||$data["AppDeveloper"]=="")?'未知作者':$data["AppDeveloper"])); ?></text>
        <br>
        <text style="font-size: 16px;font-weight: 400;color:gray;">开发者</text>
      </div>
    </mdui-card>

    <mdui-tabs value="tab-1" placement="top" class="example-placement" style="margin-left:20px;margin-right: 20px; ">
      <mdui-tab value="tab-1">
        <p style="font-size: 16px;font-weight: 800;color:rgb(84, 84, 84)">详情</p>
      </mdui-tab>
      <mdui-tab value="tab-2">
        <p style="font-size: 16px;font-weight: 800;color:rgb(84, 84, 84)">评分</p>
      </mdui-tab>
      <mdui-tab value="tab-3">
        <p style="font-size: 16px;font-weight: 800;color:rgb(84, 84, 84)">信息</p>
      </mdui-tab>

      <mdui-tab-panel slot="panel" value="tab-1" align="left">
        <br>
        <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
          应用截图
        </text>
        <div id="AppIntroductionPictureBar" style="width: 90%;
        height: 200px;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 20px;
        white-space: nowrap;
        overflow-x: scroll;
        overflow-y: hidden;">

        </div>
        <br>
        <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
          最近更新
        </text>
        <text style="margin-left: 20px;color: gray; font-size: 16px;">
          <?php echo($data["AppVersion"]); ?> -> <?php echo($data["AppNewVersion"]); ?>

        </text>
        <div style="margin-left: 20px;margin-right: 20px;">
          <text>
            <?php echo($data["AppUpdateIntroduction"]); ?>
          </text>
        </div>
        <br>
        <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
          应用介绍
        </text>
        <div style="margin-left: 20px;margin-right: 20px;">
          <text>
            <?php echo($data["AppIntroduction"]); ?>
          </text>
        </div>

      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-2">
        <br>
        <mdui-card
          style="width: 90%;margin-top: 20px;padding-top: 10px;height: 160px;padding-bottom: 10px;opacity: 1;transition: opacity 0.5s;"
          align="left" id="ScoreBar">
          <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
            应用评分
          </text>
          <br>
          <mdui-slider tickmarks step="0.5" step="0.5" min="1" max="5" value="5"
            style="margin-left: 20px;margin-right: 20px; width: 90%;margin-top: 14px;" id="score"></mdui-slider>
          <br>
          <text style="margin-left: 20px;font-size: 26px;font-weight: 800;" id="scoreText">
            5分
          </text>
          <mdui-button variant="text" style="float: right;margin-right: 20px;" id="okBtn">确定</mdui-button>
        </mdui-card>
        <mdui-card
          style="width: 90%;height: 160px; margin-top: 20px;padding-top: 10px;padding-bottom: 10px;opacity: 0;transition: opacity 0.5s;"
          align="center" id="ScoreBarIsOK">
          <img src="../src/ScoreOk.webp" style="width: 300px;float: center; margin-top: 20px;" alt="">
        </mdui-card>
        <div style="width: 90%;height: 160px; margin-top: 20px;padding-top: 10px;padding-bottom: 10px;display: none;"
          id="white">
        </div>
      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-3" align="left">
        <br>
        <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
          类别
        </text>
        <br>
        <div style="margin-top: 10px;margin-left: 20px;" id="AppTypeBar">
        </div>
        <br>
        <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
          提供者
        </text>
        <br>
        <div style="margin-left: 20px;margin-right: 20px;">
          <text id="AppUpUserText">

          </text>
        </div>
        <br>
        <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
          应用包名
        </text>
        <br>
        <div style="margin-left: 20px;margin-right: 20px;">
          <text>
            <?php echo($data["AppPackageName"]); ?>
          </text>
        </div>
        <br>
        <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
          兼容性
        </text>
        <br>
        <div style="margin-left: 20px;margin-right: 20px;">
          <div id="AppPlatformText"></div>

        </div>
        <br>
        <text style="margin-left: 20px;font-size: 16px;font-weight: 800;">
          安全性
        </text>
        <br>
        <div style="margin-top: 10px;margin-left: 20px;">
          <div style="margin-top: 10px;">
            <mdui-icon name='gpp_good--rounded' style="color: rgb(115, 94, 171);float: left;"></mdui-icon><text
              style="margin-left: 0px;" elevated>通过粼光平台官方检验</text>
          </div>
          <div style="margin-top: 10px;">
            <mdui-icon name='gpp_good--rounded' style="color: rgb(115, 94, 171);float: left;"></mdui-icon><text
              style="margin-left: 0px;" elevated>无开屏恶意广告</text>
          </div>
          <div style="margin-top: 10px;">
            <mdui-icon name='gpp_good--rounded' style="color: rgb(115, 94, 171);float: left;"></mdui-icon><text
              style="margin-left: 0px;" elevated>无过度索要权限</text>
          </div>
          <!-- <div style="margin-top: 10px;">
            <mdui-icon name='gpp_good--rounded' style="color: rgb(115, 94, 171);float: left;"></mdui-icon><text
              style="margin-left: 0px;" elevated>无捆绑下载</text>
          </div> -->


        </div>
      </mdui-tab-panel>

    </mdui-tabs>
    <mdui-snackbar id="snackbarScore" placement="center">感谢您的评分！</mdui-snackbar>
    <?php 
$html =<<<eof
    <script>
      var AppPlatformValue = {$data['AppPlatform']};

    </script>
eof;
        echo($html);
        ?>
    <script>
      var AppPlatformExcel = ['Andriod', 'Windows', 'Web', 'Linux', 'iOS', 'MacOS', 'iPadOS'];
      var AppPlatformText = document.getElementById("AppPlatformText");
      for (let i = 0; i < AppPlatformValue.length; i++) {
        AppPlatformText.innerHTML += `
        <text>适用于 ${AppPlatformExcel[AppPlatformValue[i]]} 平台</text>
        </br>
        `;
      }

      var AppLogoImg = document.getElementById("AppLogoImg");
      // fetch请求
      var url = "../api/api_getPicture.php?id=<?php echo($data['AppLogoUrl']); ?>";
      fetch(url, {
        method: "GET",
      })
        .then(response => response.json())
        .then(data => {
          //console.log(data);
          if (data.code !== 1) {
            //未能成功
            alert(data.message);
          } else {
            //成功请求
            //console.log(data.data[0]['data']);

            AppLogoImg.src = data.data[0]['data'];
          }
        })
        .catch(error => {
          //异常处理
          console.log("error: ", error);
        })
    </script>
    <?php
    $html=<<<eof
    <script>
      var AppType = {$data['AppType']};
      var AppIntroductionPictureUrl = {$data['AppIntroductionPictureUrl']};
      var scoreSum = {$data["AppScore"]}*{$data["AppScoreNum"]};
      var scoreNum = {$data["AppScoreNum"]};
      var PackageName = "{$data["AppPackageName"]}";
      var AppDownloadNum = {$data["AppDownloadNum"]};
    </script>
    eof;
    echo $html;
    ?>
    <script>
      for (let i = 0; i < AppIntroductionPictureUrl.length; i++) {
        var url = `../api/api_getPicture.php?id=${AppIntroductionPictureUrl[i]}`;
        fetch(url, {
          method: "GET",
        })
          .then(response => response.json())
          .then(data => {
            //console.log(data);
            if (data.code !== 1) {
              //未能成功
              alert(data.message);
            } else {
              //成功请求
              //console.log(data.data[0]['data']);


              var AppIntroductionPictureBar = document.getElementById("AppIntroductionPictureBar");
              AppIntroductionPictureBar.innerHTML += `
              <mdui-card style="height: 200px;display: inline-block;vertical-align: top;margin-left:10px">
          <img src=${data.data[0]["data"]} alt="" id="AppIntroductionPicture_${i}" style="height: 100%;" clicked>
        </mdui-card>
              `;
            }
          })
          .catch(error => {
            //异常处理
            console.log("error: ", error);
          })
      }
      var score = document.getElementById("score");
      var scoreText = document.getElementById("scoreText");
      var okBtn = document.getElementById("okBtn");
      var snackbarScore = document.getElementById("snackbarScore");

      score.addEventListener("input", function () {
        scoreText.innerHTML = score.value + '分';
      })


      okBtn.addEventListener("click", function () {
        var data_post = JSON.stringify({ AppScore: ((scoreSum + score.value) / (scoreNum + 1)), AppScoreNum: (scoreNum + 1), AppPackageName: PackageName });
        //console.log(PackageName);
        //console.log(data_post);
        // fetch请求
        var url = "../api/api_setAppScore.php";
        fetch(url, {
          method: "POST",
          body: data_post,
        })
          .then(response => response.json())
          .then(data => {
            //console.log(data);
            if (data.code !== 1) {
              //未能成功
              alert(data.message);
              console.log(data);
            } else {
              //成功请求
              //snackbarScore.open = true;
              var ScoreBar = document.getElementById("ScoreBar");
              var ScoreBarIsOK = document.getElementById("ScoreBarIsOK");
              var white = document.getElementById("white");
              ScoreBar.style.opacity = 0;
              ScoreBar.style.display = "none";
              white.style.display = "block";
              ScoreBarIsOK.style.opacity = 1;

            }
          })
          .catch(error => {
            //异常处理
            console.log("error: ", error);
          })
      })

    </script>

    <script>
      var AppTypeBar = document.getElementById("AppTypeBar");
      var AppTypeExcel = ["", "实用工具", "学习工具", "休闲娱乐", "编程开发", "休闲娱乐"];
      if (AppType == 0) {
        AppTypeBar.innerHTML = `
        <mdui-chip elevated>暂无分类</mdui-chip>
        `;
      } else {
        for (let i = 0; i < AppType.length; i++) {
          AppTypeBar.innerHTML += `
        <mdui-chip elevated>${AppTypeExcel[AppType[i]]}</mdui-chip>
        `;
        }
      }
    </script>

    <script>
      var AppUpUserText = document.getElementById("AppUpUserText");
      // fetch请求
      var url = "../api/api_getUserName.php?id=<?php echo($data['AppUpUserId']);?>";
      fetch(url, {
        method: "GET",

      })
        .then(response => response.json())
        .then(data => {
          //console.log(data);
          if (data.code !== 1) {
            //未能成功
            alert(data.message);
            console.log(data);
          } else {

            //成功请求
            AppUpUserText.innerHTML = data.data;
          }
        })
        .catch(error => {
          //异常处理
          console.log("error: ", error);
        })

    </script>

    <script>
      var AppDownloadBtn = document.getElementById("AppDownloadBtn");
      AppDownloadBtn.addEventListener("click", function () {
        window.location.href = "<?php echo($data['AppDownloadUrl']); ?>";
        var data_post = JSON.stringify({ AppPackageName: PackageName, AppDownloadNum: AppDownloadNum + 1 });
        // fetch请求
        var url = "../api/api_setAppDownloadNum.php";
        fetch(url, {
          method: "POST",
          body: data_post,
        })
          .then(response => response.json())
          .then(data => {
            //console.log(data);
            if (data.code !== 1) {
              //未能成功
              alert(data.message);
              console.log(data);
            } else {
              //成功请求

            }
          })
          .catch(error => {
            //异常处理
            console.log("error: ", error);
          })
      });

    </script>
  </body>
  <?php
  require("../page/footer.php");
  ?>

</html>