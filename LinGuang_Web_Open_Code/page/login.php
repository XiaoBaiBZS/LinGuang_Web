<?php
  $qq = isset($_GET["qq"])?$_GET["qq"]:'';
  $end_url = isset($_GET["end_url"])?$_GET["end_url"]:NULL;
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
        <h1 style="margin-left: 5%; float: left;margin-top: 40px; " id="page_title">登录</h1>
      </div>
    </div>

    <form action=" " method="post" style="margin-left: 5%;margin-right: 5%;" id="submit_form"
      onsubmit="SubmitForm(event)">
      <div style="width:100%;">
        <span style="font-size:20px;">账号：</sapn>
          <mdui-text-field label="请输入您的QQ号" placeholder="请输入" style="width:80%" clearable type="text" name="qq"
            class="text_box" value="<?php echo $qq ?>"></mdui-text-field>
      </div>
      <div style="width:100%;margin-top:20px;">
        <span style="font-size:20px;">密码：</sapn>
          <mdui-text-field toggle-password label="请输入您的密码" placeholder="请输入" style="width:80%" clearable type="password"
            name="password" class="text_box"></mdui-text-field>
      </div>
      <mdui-button type="submit" value="提交" style="margin-top:20px;">登录</mdui-button>
    </form>
    <mdui-button variant="text" style="margin-top:5px" href="signin.php">还没有账号，去注册</mdui-button><br>
    <!-- <mdui-button variant="text" style="margin-top:5px" href="forget_password.php">忘记密码</mdui-button><br> -->
    <a style="margin-top:5px" href="serviceitem.php">当您继续操作即代表您同意<br>《粼光用户协议及隐私条款》</a>
    <br>
    <br>



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

      function IsEmpty(str) {
        return str === undefined || str === null || str.trim() === '';
      }

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

      function SubmitForm(event) {
        // 阻止页面跳转
        event.preventDefault();
        // 抓取表单数据
        var form = document.getElementById("submit_form");
        var form_data = new FormData(form);
        var datas = form_data.entries();
        var regular_name = /([A-Za-z0-9_\-\u4e00-\u9fa5]{2,6})/;
        var regular_qq = /[1-9]([0-9]{4,10})/;
        var regular_password = /^(?![a-zA-Z]+$)(?!\d+$)(?![^\da-zA-Z\s]+$).{8,16}$/;
        var pass;
        var username;
        for (const iterator of datas) {
          // console.log("iterator",iterator);

          // 表单验证
          // 非空
          if (IsEmpty(iterator[1])) {
            //alert(`${iterator[0]}不能为空`);
            dialog_empty.open = true;
            return 0;
            break;
          }
          //正则
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
          // fetch请求
          var url = "../api/api_userLogIn.php";
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
                // alert("登录成功");
                location.href = "<?php if($end_url != NULL){echo($end_url);}else{echo('./user_center.php');}?>";

              }
            })
            .catch(error => {
              console.log("error: ", error);
            })

        }
      }
    </script>
  </body>
  <?php
  require("../page/footer.php");
  ?>

</html>