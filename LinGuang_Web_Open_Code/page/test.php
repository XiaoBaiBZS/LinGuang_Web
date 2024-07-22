<!-- <script>
  var this_app_data = {
    AppName: '测试应用4(NEW)',
    AppDownloadUrl: 'https://ceshi.com/test.apk',
    AppVersion: '3.0.0',
    AppNewVersion: '4.0.0',
    AppOneSentenceIntroduction: '测试应用4的新一句话介绍',
    AppIntroduction: '测试应用4的详细介绍',
    AppLogoUrl: 'https://ceshi.com/test.png',
    AppIntroductionPictureUrl: 'https://ceshi.com/test.png',
    AppUpdateIntroduction: '测试应用4的更新介绍',
    AppPackageName: 'com.test4.test',
    AppType: "TSET"
  };
  var data_post = JSON.stringify(this_app_data);
  // fetch请求
  var url = "../api/api_updateApp.php";

  fetch(url, {
    method: "POST",
    body: data_post,
  })
    .then(response => response.json())
    .then(data => {
      //console.log(data);
      if (data.code !== 0) {
        alert(data.message);
        console.log(data);
        // location.reload();
      } else {
        alert('ok');
      }
    })
    .catch(error => {
      console.log("error: ", error);
    })
</script> -->
<script>
  var this_app_data = {
    AppName: '测试应用5(NEW)',
    AppDownloadUrl: 'https://ceshi.com/test.apk',
    AppVersion: '3.0.0',
    AppNewVersion: '3.0.0',
    AppOneSentenceIntroduction: '测试应用5的一句话介绍',
    AppIntroduction: '测试应用5的详细介绍',
    AppLogoUrl: 'https://ceshi.com/test.png',
    AppIntroductionPictureUrl: 'https://ceshi.com/test.png',
    AppUpdateIntroduction: '测试应用5的更新介绍',
    AppPackageName: 'com.test6.test',
    AppType: "TSET"
  };
  var data_post = JSON.stringify(this_app_data);
  // fetch请求
  var url = "../api/api_updateApp.php";

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
        alert('ok');
      }
    })
    .catch(error => {
      console.log("error: ", error);
    })
</script>
<!-- <script>
  var this_app_data = {
    AppName: '测试应用5',
    AppDownloadUrl: 'https://ceshi.com/test.apk',
    AppVersion: '1.0.0',
    AppNewVersion: '1.0.0',
    AppOneSentenceIntroduction: '测试应用5的一句话介绍',
    AppIntroduction: '测试应用5的详细介绍',
    AppLogoUrl: 'https://ceshi.com/test.png',
    AppIntroductionPictureUrl: 'https://ceshi.com/test.png',
    AppUpdateIntroduction: '测试应用5的更新介绍',
    AppPackageName: 'com.test5.test',
    AppType: "TSET"
  };
  var data_post = JSON.stringify(this_app_data);
  // fetch请求
  var url = "../api/api_addApp.php";

  fetch(url, {
    method: "POST",
    body: data_post,
  })
    .then(response => response.json())
    .then(data => {
      //console.log(data);
      if (data.code !== 0) {
        alert(data.message);
        console.log(data);
        // location.reload();
      } else {
        alert('ok');
      }
    })
    .catch(error => {
      console.log("error: ", error);
    })
</script> -->

<!-- <script>
  var data_post = JSON.stringify({ key: '测试', type: 'AppName', format: 'json' });
  // fetch请求
  var url = "../api/api_searchApp.php?key=测试&type=AppName&format=json";
  fetch(url, {
    method: "GET",

  })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      if (data.code !== 1) {
        //未能成功
        alert(data.message);

      } else {
        //成功请求
        console.log(data.data);
      }
    })
    .catch(error => {
      //异常处理
      console.log("error: ", error);
    })
</script> -->