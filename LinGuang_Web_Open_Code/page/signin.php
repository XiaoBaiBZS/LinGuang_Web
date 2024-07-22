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
    </style>
  </head>

  <body style="text-align:center;">
    <div style="text-align: left;">
      <div style="float: left;width: 100%;">
        <h1 style="margin-left: 5%; float: left;margin-top: 40px; " id="page_title">注册</h1>
      </div>
    </div>

    <form action=" " id="submit_form" method="post" style="margin-left: 5%;margin-right: 5%;"
      onsubmit="SubmitForm(event)">
      <div style="width:100%;">
        <span style="font-size:20px;">昵称：</sapn>
          <mdui-text-field label="请输入您的用户名" placeholder="请输入" style="width:80%" clearable type="text" name="name"
            id="name" class="text_box"></mdui-text-field>
      </div>
      <div style="width:100%;margin-top:20px;">
        <span style="font-size:20px;">账号：</sapn>
          <mdui-text-field label="请输入您的QQ号" placeholder="请输入" style="width:80%" clearable type="text" name="qq" id="qq"
            class="text_box"></mdui-text-field>
      </div>
      <div style="width:100%;margin-top:20px;">
        <span style="font-size:20px;">密码：</sapn>
          <mdui-text-field toggle-password label="请输入您的密码" placeholder="请输入" style="width:80%" clearable type="password"
            name="password" class="text_box"></mdui-text-field>
      </div>
      <mdui-button type="submit" value="注册" style="margin-top:20px;">注册</mdui-button>
    </form>
    <mdui-button variant="text" style="margin-top:5px" href="login.php">我有账号，去登录</mdui-button><br>
    <a style="margin-top:5px" href="serviceitem.php">当您继续操作即代表您同意<br>《粼光用户协议及隐私条款》</a>
    <mdui-dialog headline="请重新输入" description="有未完成输入的项目。" close-on-overlay-click class="dialog_empty"></mdui-dialog>
    <mdui-dialog headline="请重新输入" description="用户名应为2-6位的合法字符。" close-on-overlay-click
      class="dialog_namelength"></mdui-dialog>
    <mdui-dialog headline="请重新输入" description="账号应为合法QQ号码。" close-on-overlay-click
      class="dialog_qqregular"></mdui-dialog>
    <mdui-dialog headline="请重新输入" description="密码应为8-16位，至少包含数字、字母、特殊符号中的两项。" close-on-overlay-click
      class="dialog_passwordregular"></mdui-dialog>

    <script>
      const dialog_empty = document.querySelector(".dialog_empty");
      const dialog_namelength = document.querySelector(".dialog_namelength");
      const dialog_qqregular = document.querySelector(".dialog_qqregular");
      const dialog_passwordregular = document.querySelector(".dialog_passwordregular");
      const text_boxes = document.querySelectorAll(".text_box");
      const qq_input = document.getElementById("qq");
      const name_input = document.getElementById("name");

      function sendWelcomeMail() {
        // fetch请求
        var url = "../api/api_sendMail.php";
        fetch(url, {
          method: "POST",
          // body: `${qq_input.value}@qq.com,杭城迹忆密码找回,您正在找回密码，您的验证码是：${num}`
          body: `${qq_input.value}@qq.com,杭城迹忆与您一起探索杭城,
          <div style="width: 90%;
    background-color: #fef7ff;border-radius: 10px;text-align: left;">
      <div style="margin: 20px;">
        <div style="width: 100%;
        height: 5px;"></div>
        <p style="font-size: 26px;font-weight: 800;">粼光欢迎您的加入</p>
        <p style="font-size: 26px;font-weight: 800;">发现应用趣味，探索科技魅力</p>
        <p style="font-size: 20px;">
          ${name_input.value}，很高兴认识您！当您收到此封信件，代表您成功使用QQ号码注册了粼光，我们将会通过邮件与您取得联系，您可以在网站-个人中心-订阅功能中设置我们向您推送邮件的频率。同时，您也可以回复此邮件告诉我们您的建议。
        </p>
        <p style="font-size: 20px;color: gray;">
          邮件相关功能正在测试中，目前正在开发通过邮件找回密码、订阅我们的推送等功能，由于腾讯QQ邮箱限制，您可能无法收到我们的邮件，我们正在加快测试。若您开启了订阅功能，您可能会在网站重大版本更新、每周末前/节假日前收到关于出行的建议。更多功能，敬请期待！
        </p>
      </div>
      <br>
    </div>
          `
        })

      }

      //不能在头尾输入空格trim();
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

      function IsEmpty(str) {
        return str === undefined || str === null || str.trim() === '';
      }

      function SubmitForm(event) {

        // 阻止页面跳转
        event.preventDefault();
        // 抓取表单数据;

        var form = document.getElementById("submit_form");
        var form_data = new FormData(form);
        var datas = form_data.entries();
        var qq;
        var regular_name = /([A-Za-z0-9_\-\u4e00-\u9fa5]{2,6})/;
        var regular_qq = /[1-9]([0-9]{4,10})/;
        var regular_password = /^(?![a-zA-Z]+$)(?!\d+$)(?![^\da-zA-Z\s]+$).{8,16}$/;
        for (const iterator of datas) {
          // console.log(iterator);

          //表单验证
          //非空
          if (IsEmpty(iterator[1])) {
            //alert(`${iterator[0]}不能为空`);
            dialog_empty.open = true;
            return 0;
            break;
          }
          //正则
          if (iterator[0].indexOf("name") >= 0) {
            if (iterator[1].match(regular_name) != null) {
              if (iterator[1].match(regular_name)[0] != iterator[1]) {
                dialog_namelength.open = true;
                return 0;
                break;
              }
            } else {
              dialog_namelength.open = true;
              return 0;
              break;
            }
          }
          if (iterator[0].indexOf("qq") >= 0) {
            if ((iterator[1].match(regular_qq)) != null) {
              if ((iterator[1].match(regular_qq))[0] != iterator[1]) {
                dialog_qqregular.open = true;
                return 0;
                break;
              } else {
                qq = iterator[1];
              }
            } else {
              dialog_qqregular.open = true;
              return 0;
              break;
            }
          }
          if (iterator[0].indexOf("password") >= 0) {
            if ((iterator[1].match(regular_password)) != null) {
              if ((iterator[1].match(regular_password))[0] != iterator[1]) {
                dialog_passwordregular.open = true;
                return 0;
                break;
              }
            } else {
              dialog_passwordregular.open = true;
              return 0;
              break;
            }
          }
        }
        // console.log(form_data);
        // console.log(datas);
        // console.log(qq);
        // fetch请求
        // form_data.append('name',name);
        // form_data.append('qq',qq);
        // form_data.append('password',password);
        var url = "../api/api_userSignIn.php";
        fetch(url, {
          method: "POST",
          body: form_data
        })
          .then(response => response.json())
          .then(data => {
            console.log(data);
            if (data.code !== 1) {
              alert(data.message);
            } else {
              alert("注册成功");
              sendWelcomeMail();
              location.href = "./login.php?qq=" + qq;


            }
          })
          .catch(error => {
            console.log("error: ", error);
          })

      }




    </script>
  </body>
  <?php
require("../page/footer.php");
  ?>

</html>