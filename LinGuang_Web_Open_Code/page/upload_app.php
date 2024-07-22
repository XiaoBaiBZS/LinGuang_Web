<?php
  session_start();
  //print_r($user);
/*

if(!isset($_SESSION["userinfo"])){
  header("location= ./login.php?end_url=./upload_app.php");
  die();
}

*/
  if(!isset($_SESSION["userinfo"])){
    header("location: ./login.php");
    die();
  }
  
  $DS = DIRECTORY_SEPARATOR;
  require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
  $userinfo = $_SESSION["userinfo"];
  $user = Db::table("user")->where([["id","=",$userinfo["id"]]])->select()[0];
?>

<!DOCTYPE html>
<html lang="zh-cn">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼光-应用提单</title>
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
    </style>
  </head>

  <body style="text-align:center;">
    <div style="text-align: left;">
      <div style="float: left;width: 100%;">
        <h1 style="margin-left: 5%; float: left;margin-top: 40px; " id="page_title">应用提单</h1>
      </div>
    </div>
    <mdui-card style="margin-left: 5%;margin-right: 5%;width: 90%;height: 140px;">
      <mdui-card style="width: 100px;height: 100px;margin-left: 20px;margin-top: 20px;  float: left;" clickable>
        <input type="file" id="inputImage" accept=".jpeg,.jpg,.png" style="display: none;" />

        <img src="../src/AppLogoPicTip.webp" alt="" id="AppLogoImg"
          style="border-radius: 10px;width: 100%;height: 100%;">
      </mdui-card>
      <div style="margin-left: 140px;width: 100%;height: 100px;margin-top: 26px;margin-right: 20px;" align="left">

        <text class="app-name" id="AppNameTip">AppName</text>
        <br>
        <text class="app-one-sentence-introduction" id="AppOneSentenceIntroductionTip">This is the slogan of app.</text>
        <br>
        <text class="app-one-sentence-introduction" id="AppVersionTip">1.0.0</text>


      </div>
    </mdui-card>

    <div style="margin-left: 5%;margin-right: 5%;margin-top: 20px;" align="left">
      <h3>基本信息</h3>
      <mdui-text-field class="text_box" clearable label="*应用名称" id="AppName"></mdui-text-field>
      <mdui-text-field class="text_box" clearable label="*应用包名" id="AppPackageName"
        helper="包名作为应用的唯一标识若您上传应用提示应用已经存在，并您确需上传差异应用，您可以在包名后加上您的QQ号码，如“com.linguang.cn.1298589907”，若包名不符合规范，粼光管理员保留手动修改而不通知您的权利。"></mdui-text-field>
      <mdui-text-field class="text_box" clearable label="*下载链接" id="AppDownloadUrl"></mdui-text-field>
      <mdui-text-field class="text_box" clearable label="*当前安装包版本名" id="AppVersion"></mdui-text-field>
      <mdui-text-field class="text_box" clearable label="*该应用最新版本名" id="AppNewVersion"
        helper="仅供给用户展示，不作为更新算法参数"></mdui-text-field>
      <h3>应用介绍</h3>
      <mdui-text-field class="text_box" clearable label="*应用一句话介绍（Slogan）" id="AppOneSentenceIntroduction"
        maxlength="30"></mdui-text-field>
      <mdui-text-field class="text_box" clearable label="*应用介绍" autosize min-rows="1" max-rows="5"
        id="AppIntroduction"></mdui-text-field>
      <mdui-text-field class="text_box" clearable label="版本更新介绍" autosize min-rows="1" max-rows="5"
        id="AppUpdateIntroduction"></mdui-text-field>
      <mdui-select multiple class="example-multiple" variant="filled" clearable label="介绍图片" align="left"
        id="AppIntroductionPicInput">
        <mdui-button variant="text" style="margin-left: 20px;margin-top: 5px;" id="AppIntroductionPicBtn"
          onclick="inputImage.click();">上传图片</mdui-button>

      </mdui-select>
      <h3>补充信息</h3>
      <mdui-select multiple class="example-multiple" variant="filled" clearable label="应用分类" align="left" id="AppType">
        <div style="margin-left: 20px;margin-right: 20px;">
          <a href="" style="color: gray;">无合适的分类？此项可不填，您也可以联系管理人员添加分类。</a>
        </div>
        <br>
        <?php 
        if($user["status"]==1){
          echo('<mdui-menu-item value="0">推广（管理员）</mdui-menu-item>');
        }
        ?>
        <mdui-menu-item value="1">实用工具</mdui-menu-item>
        <mdui-menu-item value="2">学习工具</mdui-menu-item>
        <mdui-menu-item value="3">休闲娱乐</mdui-menu-item>
        <mdui-menu-item value="4">编程开发</mdui-menu-item>


      </mdui-select>
      <mdui-select multiple class="example-multiple" variant="filled" clearable label="兼容平台" align="left"
        id="AppPlatform">
        <div style="margin-left: 20px;margin-right: 20px;">
          <a href="" style="color: gray;">无合适的平台？此项可不填，您也可以联系管理人员添加分类。</a>
        </div>
        <br>
        <mdui-menu-item value="1">Andriod</mdui-menu-item>
        <mdui-menu-item value="2">Windows</mdui-menu-item>
        <mdui-menu-item value="3">Web</mdui-menu-item>
        <mdui-menu-item value="4">Linux</mdui-menu-item>
        <mdui-menu-item value="5">iOS</mdui-menu-item>
        <mdui-menu-item value="6">Mac</mdui-menu-item>
        <mdui-menu-item value="7">iPadOS</mdui-menu-item>


      </mdui-select>

      <mdui-text-field class="text_box" clearable label="应用开发者（不是应用上传者）" id="AppDeveloper"></mdui-text-field>
      <mdui-text-field class="text_box" clearable label="应用开发者主页" id="AppDeveloperUrl"></mdui-text-field>

      <mdui-checkbox style="margin-left: 5%;margin-right: 5%;margin-top: 20px;width: 90%;" id="check">
        <p><b>我已阅读并同意《粼光应用上传协议》，</b>您将会提交一个新的应用，请<b>再次检查</b>上传信息是否有误！确认无误请点击下方提交按钮。</p>
      </mdui-checkbox>
      <div style="width: 100%;text-align: center;">
        <mdui-button icon="cloud_upload--rounded" disabled end-icon="arrow_forward" id="uploadAppBtn"
          style="margin-top: 20px;">提交应用</mdui-button>
      </div>
    </div>


    <script>
      var AppLogoImg = document.getElementById("AppLogoImg");
      var inputImage = document.getElementById("inputImage");
      var AppIntroductionPicBtn = document.getElementById("AppIntroductionPicBtn");

      var AppNameTip = document.getElementById("AppNameTip");
      var AppOneSentenceIntroductionTip = document.getElementById("AppOneSentenceIntroductionTip");
      var AppVersionTip = document.getElementById("AppVersionTip");

      var AppNameInput = document.getElementById("AppName");
      var AppPackageNameInput = document.getElementById("AppPackageName");
      var AppDownloadUrlInput = document.getElementById("AppDownloadUrl");
      var AppVersionInput = document.getElementById("AppVersion");
      var AppNewVersionInput = document.getElementById("AppNewVersion");
      var AppOneSentenceIntroductionInput = document.getElementById("AppOneSentenceIntroduction");
      var AppIntroductionInput = document.getElementById("AppIntroduction");
      var AppUpdateIntroductionInput = document.getElementById("AppUpdateIntroduction");
      var AppTypeInput = document.getElementById("AppType");
      var AppPlatformInput = document.getElementById("AppPlatform");
      var AppDeveloperInput = document.getElementById("AppDeveloper");
      var AppDeveloperUrlInput = document.getElementById("AppDeveloperUrl");
      var AppIntroductionPicInput = document.getElementById("AppIntroductionPicInput");

      var check = document.getElementById("check");
      var uploadAppBtn = document.getElementById("uploadAppBtn");

      check.addEventListener("click", function () {
        if (!check.checked) {
          uploadAppBtn.disabled = false;
        } else {
          uploadAppBtn.disabled = true;
        }
      });


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

      var base64;
      var imgNum = 0;
      var isAppLogoBtn = 0;
      var AppLogoValue = '';

      AppLogoImg.addEventListener('click', function (event) {
        isAppLogoBtn = 1;
        inputImage.click();
      })

      inputImage.addEventListener('change', function (event) {

        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
          base64 = e.target.result;
          //console.log(base64); // 输出图片的Base64编码
          var this_img_data = {
            data: base64
          };
          var data_post = JSON.stringify(this_img_data);
          // fetch请求
          var url = "../api/api_uploadPicture.php";

          fetch(url, {
            method: "POST",
            body: data_post,
          })
            .then(response => response.json())
            .then(data => {
              console.log(data);
              if (data.code !== 1) {
                alert(data.message);
                console.log(data);
                // location.reload();
              } else {
                //alert('ok');
                if (isAppLogoBtn == 1) {
                  AppLogoImg.src = base64;
                  AppLogoValue = data.data;
                  isAppLogoBtn = 0;
                } else {
                  imgNum++;
                  AppIntroductionPicInput.innerHTML += `
                  <mdui-menu-item value="${data.data}" >图片${imgNum} <img src="${base64}" alt="" style="height: 40px;"></mdui-menu-item>
  
                  `;
                }
              }
            })
            .catch(error => {
              console.log("error: ", error);
            })
        };
        reader.readAsDataURL(file);
      });

      AppNameInput.addEventListener("input", function (e) {
        AppNameTip.innerHTML = AppNameInput.value;
        if (AppNameInput.value == '') {
          AppNameTip.innerHTML = "AppName";
        }
      })

      AppOneSentenceIntroductionInput.addEventListener("input", function (e) {
        AppOneSentenceIntroductionTip.innerHTML = AppOneSentenceIntroductionInput.value;
        if (AppOneSentenceIntroductionInput.value == '') {
          AppOneSentenceIntroductionTip.innerHTML = "This is the slogan of app.";
        }
      })

      AppVersionInput.addEventListener("input", function (e) {
        AppVersionTip.innerHTML = AppVersionInput.value;
        if (AppVersionInput.value == '') {
          AppVersionTip.innerHTML = "1.0.0";
        }
      })


      uploadAppBtn.addEventListener("click", function (e) {
        check.checked = false;
        uploadAppBtn.disabled = true;
        var this_app_data = {
          AppName: AppNameInput.value,
          AppDownloadUrl: AppDownloadUrlInput.value,
          AppVersion: AppVersionInput.value,
          AppNewVersion: AppNewVersionInput.value,
          AppOneSentenceIntroduction: AppOneSentenceIntroductionInput.value,
          AppIntroduction: AppIntroductionInput.value,
          AppLogoUrl: AppLogoValue,
          AppIntroductionPictureUrl: JSON.stringify(AppIntroductionPicInput.value),
          AppUpdateIntroduction: AppUpdateIntroductionInput.value,
          AppDeveloper: AppDeveloperInput.value,
          AppDeveloperUrl: AppDeveloperUrlInput.value,
          AppPackageName: AppPackageNameInput.value,
          AppType: JSON.stringify(AppTypeInput.value),
          AppPlatform: JSON.stringify(AppPlatformInput.value)
        }
        //console.log(this_app_data);
        var data_post = JSON.stringify(this_app_data);
        //console.log(data_post);
        // fetch请求
        var url = "../api/api_addApp.php";
        fetch(url, {
          method: "POST",
          body: data_post,
        })
          .then(response => response.json())
          .then(data => {
            //console.log(data);
            if (data.code !== 1) {
              alert(data.message);
              console.log(data);
              // location.reload();
            } else {
              alert('上传成功');
            }
          })
          .catch(error => {
            console.log("error: ", error);
          })

      })
    </script>
  </body>
  <?php
  require("../page/footer.php");
    ?>


</html>