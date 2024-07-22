<?php
  session_start();
  if(!isset($_SESSION["userinfo"])){
    header("location: ./login.php");
    die();
  }
  
  $DS = DIRECTORY_SEPARATOR;
  require dirname(__DIR__)."{$DS}php{$DS}Db.class.php";
  $userinfo = $_SESSION["userinfo"];
  $user = Db::table("user")->where([["id","=",$userinfo["id"]]])->select()[0];
  //print_r($user);
?>

<!DOCTYPE html>
<html lang="zh-cn">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>粼光-个人中心</title>
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

      p {
        -webkit-margin-before: 0;
        -webkit-margin-after: 0;
      }
    </style>
  </head>

  <body>
    <div style="text-align: left;">
      <div style="float: left;width: 100%;">
        <h1 style="margin-left: 10%; float: left;margin-top: 40px; " id="page_title">
          个人中心</h1>
      </div>
    </div>

    <mdui-card style="width: 80%;height: 100px ;margin-left: 10%;margin-right: 10%;">
      <div style="float: left;width: 100px;
      height: 100px;">
        <img src="http://q.qlogo.cn/headimg_dl?dst_uin=<?php echo($user["qq"]);?>&spec=640&img_type=jpg"
          style="width: 60px;height:60px;border-radius:60px;margin:20px;" />



        <?php  
          
          if($user["status"]==2){
            echo('<mdui-icon name="verified--rounded"
            style="position: absolute; left: 60px; top: 60px; color: #6449A3;"></mdui-icon>');
          }else if($user["status"]==1){
            echo('<mdui-icon name="verified_user--rounded"
            style="position: absolute; left: 60px; top: 60px; color: #6449A3;"></mdui-icon>');

          }else if($user["status"]==3){
            echo('<mdui-icon name="verified_user--rounded"
            style="position: absolute; left: 60px; top: 60px; color: #6449A3;"></mdui-icon>');

          }
          
          ?>

      </div>
      <div style="margin-left: 100px;" class="useinfo_div">
        <p style="font-size: 24px;font-weight: 700;margin-top: 20px;"><?php echo($user["username"]); ?>

          <mdui-button-icon icon="edit--rounded" style="width: 30px;
          height: 20px;" class="username_edit_button"></mdui-button-icon>
        </p>



        <p><?php echo(date("Y年m月d日",strtotime($user["create_date"]))); ?>来到粼光</p>
      </div>
    </mdui-card>

    <mdui-list style="margin-left: 10%;margin-right: 10%;margin-top: 10px;">
      <!-- <mdui-list-item rounded alignment="center" class="optionlist_like">
        我的收藏
        <mdui-icon slot="icon" name="favorite_border--rounded"></mdui-icon>
      </mdui-list-item>
      <mdui-list-item rounded alignment="center" class="optionlist_gone">
        我曾去过
        <mdui-icon slot="icon" name="hail--rounded"></mdui-icon>
      </mdui-list-item> -->
      <mdui-list-item rounded alignment="center" class="optionlist_main">
        全部应用
        <mdui-icon slot="icon" name="explore--outlined"></mdui-icon>
      </mdui-list-item>
      <mdui-list-item rounded alignment="center" class="optionlist_society">
        粼光社区
        <mdui-icon slot="icon" name="textsms--outlined"></mdui-icon>
      </mdui-list-item>
      <!-- <mdui-list-item rounded alignment="center" class="optionlist_location">
        常用位置
        <mdui-icon slot="icon" name="fmd_good--outlined"></mdui-icon>
      </mdui-list-item> -->
      <!-- <mdui-list-item rounded alignment="center" class="optionlist_setrss">
        邮件订阅
        <mdui-icon slot="icon" name="rss_feed--rounded"></mdui-icon>
      </mdui-list-item> -->
      <!-- <mdui-list-item rounded alignment="center" class="optionlist_passwordchange">
        修改密码
        <mdui-icon slot="icon" name="password--rounded"></mdui-icon>
      </mdui-list-item> -->
      <mdui-list-item rounded alignment="center" class="optionlist_logout">
        退出登录
        <mdui-icon slot="icon" name="exit_to_app--rounded"></mdui-icon>
      </mdui-list-item>
      <!-- <mdui-list-item rounded alignment="center" class="optionlist_codewithme">
        与我同行
        <mdui-icon slot="icon" name="code--roundedd"></mdui-icon>
      </mdui-list-item> -->
      <mdui-list-item rounded alignment="center" class="optionlist_help">
        联系客服
        <mdui-icon slot="icon" name="support_agent--rounded"></mdui-icon>
      </mdui-list-item>
      <mdui-list-item rounded alignment="center" class="optionlist_upload_app" <?php 

      if($user["status"]==0){
        echo('style="display:none;"');
      }else if($user["status"]==1){
        echo('style="display:block;"');
      }else if($user["status"]==2){
        echo('style="display:block;"');
      } 
      ?>>
        <?php 

      if($user["status"]==0){
        echo('分享应用');
      }else if($user["status"]==1){
        echo('应用提单');
      }else if($user["status"]==2){
        echo('分享应用');
      } 
      ?>
        <mdui-icon slot="icon" name="cloud_upload--outlined"></mdui-icon>
      </mdui-list-item>

      <mdui-list-item rounded alignment="center" class="optionlist_admin" <?php 

      if($user["status"]==0){
        echo('style="display:none;"');
      }else if($user["status"]==1){
        echo('style="display:block;"');
      }else if($user["status"]==2){
        echo('style="display:none;"');
      }
      
      
      ?>>
        开发人员选项
        <mdui-icon slot="icon" name="admin_panel_settings--outlined"></mdui-icon>
      </mdui-list-item>
      <mdui-list-item rounded alignment="center" class="optionlist_developer" <?php 

      if($user["status"]==0){
        echo('style="display:block;"');
      }else if($user["status"]==1){
        echo('style="display:none;"');
      }else if($user["status"]==2){
        echo('style="display:none;"');
      } 
      ?>>
        认证开发者
        <mdui-icon slot="icon" name="terminal--rounded"></mdui-icon>
      </mdui-list-item>

    </mdui-list>

    <mdui-dialog close-on-overlay-click headline="修改用户名" class="username_edit_dialog">
      <form action=" " id="submit_form" method="post" style="margin-left: 5%;margin-right: 5%;"
        onsubmit="SubmitForm(event)">
        <div style="width:100%;">

          <mdui-text-field label="" id="text_box" placeholder="请输入" style="width:100%;" clearable type="text"
            name="name" value="<?php echo($user["username"]); ?>" class="text_box" </mdui-text-field>" >
        </div>
        <br>
        <div style="text-align: right;">

          <mdui-button slot="action" variant="text" onclick="username_edit_dialog.open = false">取消</mdui-button>
          <mdui-button slot="action" type="submit" variant="tonal">修改</mdui-button>
        </div>
      </form>

    </mdui-dialog>


    <mdui-dialog headline="请重新输入" description="有未完成输入的项目。" close-on-overlay-click class="dialog_empty"></mdui-dialog>
    <mdui-dialog headline="请重新输入" description="用户名应为2-6位的合法字符。" close-on-overlay-click
      class="dialog_namelength"></mdui-dialog>
    <mdui-dialog headline="请重新输入" description="账号应为合法QQ号码。" close-on-overlay-click
      class="dialog_qqregular"></mdui-dialog>
    <mdui-dialog headline="请重新输入" description="密码应为8-16位，至少包含数字、字母、特殊符号中的两项。" close-on-overlay-click
      class="dialog_passwordregular"></mdui-dialog>
    <mdui-dialog headline="请重新输入" description="与原用户名相同" close-on-overlay-click class="dialog_namesame"></mdui-dialog>
    <mdui-snackbar class="tip">请发送邮件至Zhanshuo.Bai@outlook.com，与开发者联系</mdui-snackbar>
    <br>
    <script>
      var optionlist_upload_app = document.querySelector(".optionlist_upload_app");
      var optionlist_admin = document.querySelector(".optionlist_admin");
      var optionlist_developer = document.querySelector(".optionlist_developer");
      optionlist_upload_app.addEventListener("click", function () {
        location.href = "../page/upload_app.php";
      });
      optionlist_admin.addEventListener("click", function () {
        location.href = "../page/upload_app.php";
      });
      optionlist_developer.addEventListener("click", function () {
        location.href = "../page/developer.php";
      });

    </script>
    <script>
      var useinfo_div = document.querySelector(".useinfo_div");
      var username_edit_button = document.querySelector(".username_edit_button");
      const username_edit_dialog = document.querySelector(".username_edit_dialog");
      const text_boxes = document.querySelectorAll(".text_box");
      const dialog_empty = document.querySelector(".dialog_empty");
      const dialog_namelength = document.querySelector(".dialog_namelength");
      const dialog_qqregular = document.querySelector(".dialog_qqregular");
      const dialog_passwordregular = document.querySelector(".dialog_passwordregular");
      const dialog_namesame = document.querySelector(".dialog_namesame");
      const tip = document.querySelector(".tip");
      const old_name = text_box.value;
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
            if (old_name == iterator[1]) {
              dialog_namesame.open = true;
              return 0;
              break;
            }
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

        }
        // console.log(form_data);
        // console.log(datas);
        // console.log(qq);
        // fetch请求
        // form_data.append('name',name);
        // form_data.append('qq',qq);
        // form_data.append('password',password);
        var url = "../api/api_changeUserName.php";
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
              location.reload();
              alert("修改成功");
            }
          })
          .catch(error => {
            console.log("error: ", error);
          })

      }

      function username_edit_button_display() {
        username_edit_button.style.display = "";
      }
      function username_edit_button_display_none() {
        username_edit_button.style.display = "none";
      }

      useinfo_div.onclick = function () {
        username_edit_dialog.open = true
        document.getElementById("text_box").focus();
      }


      document.querySelector(".optionlist_logout").onclick = function () {
        // fetch请求
        var url = "../api/api_userLogOut.php";
        fetch(url, {
          method: "GET",
        })
          .then(response => response.json())
          .then(data => {
            console.log(data);
            if (data.code !== 1) {
              alert(data.msg);
              // location.reload();
            } else {
              alert("退出登录成功");
              location.href = "./login.php";
              // location.reload();
            }
          })
          .catch(error => {
            console.log("error: ", error);
          })
      };
    </script>













  </body>
  <?php
require("../page/footer.php");
  ?>


</html>