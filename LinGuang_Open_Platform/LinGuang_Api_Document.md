# 文档说明
## 介绍
本文档旨在合理合规的开发和使用粼光接口API，通过本手册，您可以更好的使用相关api，甚至您可以使用api开发粼光第三方应用。
## 更新
### 最近更新：`2024/7/7`
## 反馈与修正
## 开源与使用
## 常见问题
### 前端常用的正则表达式
```javascript
var regular_name = /([A-Za-z0-9_\-\u4e00-\u9fa5]{2,6})/;
var regular_qq = /[1-9]([0-9]{4,10})/;
var regular_password = /^(?![a-zA-Z]+$)(?!\d+$)(?![^\da-zA-Z\s]+$).{8,16}$/;
```
### 更新应用的逻辑和前端处理
由于POST传入参数与新增应用完全相同，所以推荐前端按照：调用 [[#搜索应用数据]]->使用form表单控件默认值功能展示->用户对需要更新的值进行修改->调用[[#更新应用]]来进行应用更新。应用更新的逻辑是在数据库中新增一条应用，通过包名与之前上传的应用关联，通过`AppInerVersion`值自增来判断更新，此值无需也不能自行填写或修改。请注意，若数据库中未存在包名相同的应用或者包名相同的应用未通过审核，将无法调用此接口进行更新，此情况返回值为-4。
### 用户身份认证更新
粼光默认不会对已登录用户做退出处理，除非您手动退出登录，无论登录多久都不会在浏览器清除身份信息。所以在进行必要需进行SESSION更新。详见：[[#更新用户登录态]]
# 数据库数据说明
### `app_data`表
此表是粼光所包含的所有应用数据

| 列名                         | 数据类型     | 长度  | 默认值 | 是否为主键 | 是否非空 | 是否自增 | 描述                                      |
| -------------------------- | -------- | --- | --- | ----- | ---- | ---- | --------------------------------------- |
| AppId                      | int      |     |     | 是     | 是    | 是    | 数据库索引                                   |
| AppName                    | varchar  | 24  |     | 否     | 是    | 否    | 应用名称                                    |
| AppDownloadUrl             | varchar  | 64  |     | 否     | 否    | 否    | 应用下载地址                                  |
| AppVersion                 | varchar  | 24  |     | 否     | 是    | 否    | 应用当前版本名                                 |
| AppNewVersion              | varchar  | 24  |     | 否     | 否    | 否    | 应用最新版本名                                 |
| AppOneSentenceIntroduction | varchar  | 128 |     | 否     | 是    | 否    | 应用一句话介绍（Slogan）                         |
| AppIntroduction            | text     |     |     | 否     | 是    | 否    | 应用介绍                                    |
| AppLogoUrl                 | text     |     |     | 否     | 是    | 否    | 应用Logo图片                                |
| AppIntroductionPictureUrl  | text     |     |     | 否     | 否    | 否    | 应用介绍图片                                  |
| AppUpdateIntroduction      | text     |     |     | 否     | 否    | 否    | 应用新版本更新介绍                               |
| AppInerVersion             | varchar  | 64  | 0   | 否     | 是    | 否    | 应用内部版本号（用于更新），仅在粼光存在一版则为0，每次更新迭代自增1     |
| AppUpUserId                | varchar  | 64  | 0   | 否     | 是    | 否    | 应用上传者唯一身份标识，0为系统默认，非0为对应用户              |
| AppDeveloper               | varchar  | 128 | 0   | 否     | 否    | 否    | 应用开发者名称                                 |
| AppDeveloperUrl            | varchar  | 128 | 0   | 否     | 否    | 否    | 应用开发者主页链接                               |
| AppPackageName             | varchar  | 64  |     | 否     | 是    | 否    | 应用包名（应用唯一身份标识）                          |
| AppType                    | varchar  | 64  |     | 否     | 否    | 否    | 应用分类数组，0为推广                             |
| IsAvailable                | int      |     | 0   | 否     | 是    | 否    | 应用是否可被检索（用于认证开发者上传的应用管理与检查）0为无法检索，1为可检索 |
| OnloadDate                 | datetime |     |     | 否     | 否    | 否    | 应用上传日期                                  |
| UpdateDate                 | datetime |     |     | 否     | 否    | 否    | 应用更新日期                                  |
| AppScore                   | varchar  | 16  | 0   | 否     | 是    | 否    | 应用评分                                    |
| AppScoreNum                | varchar  | 16  | 0   | 否     | 是    | 否    | 应用评分数量                                  |
| IsLastest                  | int      |     | 1   | 否     | 是    | 否    | 应用是否是最新版本                               |

### `user`表
此表是粼光所包含的所有用户数据

| 列名          | 数据类型     | 长度  | 默认值 | 是否为主键 | 是否非空 | 是否自增 | 描述                        |
| ----------- | -------- | --- | --- | ----- | ---- | ---- | ------------------------- |
| id          | int      |     |     | 是     | 是    | 是    | 用户唯一身份标识                  |
| username    | varchar  | 64  |     | 否     | 是    | 否    | 用户昵称（2-6合法字符）             |
| password    | varchar  | 64  |     | 否     | 是    | 否    | 用户密码（有加密）                 |
| phone       | varchar  | 64  |     | 否     | 否    | 否    | 用户手机号（预留）                 |
| qq          | varchar  | 64  |     | 否     | 是    | 否    | 用户QQ号（用于邮件推送和头像调用）        |
| status      | int      |     | 0   | 否     | 是    | 否    | 用户身份，0为普通用户，1为管理员，2为认证开发者 |
| create_date | datetime |     |     | 否     | 否    | 否    | 用户注册日期                    |
| rss         | int      |     | 0   | 否     | 否    | 否    | 用户接受邮件推送频率，0为接收全部推广邮件（预留） |

### `log_login`表
此表是粼光登录日志

| 列名          | 数据类型     | 长度  | 默认值 | 是否为主键 | 是否非空 | 是否自增 | 描述     |
| ----------- | -------- | --- | --- | ----- | ---- | ---- | ------ |
| id          | int      |     |     | 是     | 是    | 是    | 数据库索引  |
| userid      | int      |     |     | 否     | 是    | 否    | 登录用户id |
| ip          | varchar  | 32  |     | 否     | 否    | 否    | 用户登录ip |
| create_date | datetime |     |     | 否     | 否    | 否    | 用户登录日期 |

# 前端接口调用参考
## 构造POST请求
以下是一个前端通过fetch构造POST请求向后端发送数据的参考代码，一般情况下推荐使用json格式传递数据，首先使用`JSON.stringify(字典)`函数构造json字符串变量 `data_post`，构造fetch请求将`data_post`传递给api，api会返回一个json格式的返回参数，可以通过`data.code`访问请求标识码，`data.message`获取信息，`data.data`获取返回数据等。
```javascript
<script>
  var data_post = JSON.stringify({ a: '1', b: '2' });
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
        //未能成功
        alert(data.message);
        console.log(data);
      } else {
        //成功请求
        alert('ok');
      }
    })
    .catch(error => {
      //异常处理
      console.log("error: ", error);
    })
</script>
```
## 构造GET请求
以下是一个前端通过fetch构造GET请求向后端请求数据的参考代码，与POST请求不同，使用fetch构造GET请求没有body体，只需要通过`请求链接?请求参数=值&请求参数=值`格式构造url即可，api会返回一个json格式的返回参数，可以通过`data.code`访问请求标识码，`data.message`获取信息，`data.data`获取返回数据等。
```JavaScript
<script>
  // fetch请求
  var url = "../api/api_searchApp.php?key=测试&type=AppName&format=json";
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
        alert('ok');
      }
    })
    .catch(error => {
      //异常处理
      console.log("error: ", error);
    })
</script>
```
# 接口调用手册
## 应用类
### 获取应用数据
#### 描述
通过应用唯一数据库表示序号`AppId`请求到对应应用的全部数据。
#### 调用地址
```
api/api_getAppData.php
```
#### 参数传递
| 传入参数 | 传入方式 | 是否必须 | 数据类型 | 描述 |
| ---- | ---- | ---- | ---- | ---- |
| AppId | GET | 是 | int | 应用在数据库中的序列标识 |
| format | GET | 否 | string | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数 | 数据类型 | 描述 |
| ---- | ---- | ---- |
| code | int | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释 |
| data | array | 获取到应用的信息 |

#### 调用示例

**构造链接：** 
```
api/api_getAppData.php?AppId=1
```
**返回数据**：
``` PHP
Array
(
    [code] => 1
    [data] => Array
        (
            [0] => Array
                (
                    [AppId] => 1
                    [AppName] => 粼光
                    [AppDownloadUrl] => linlight.cn
                    [AppVersion] => 3.0
                    [AppNewVersion] => 3.0
                    [AppOneSentenceIntroduction] => 个人开发者交流平台
                    [AppIntroduction] => 粼光是一个基于个人应用分发的交流平台
                    [AppLogoUrl] => ./page/src/app_data/app_logo.png
                    [AppIntroductionPictureUrl] => 
                    [AppUpdateIntroduction] => 
                    [AppInerVersion] => 0
                    [AppUpUserId] => 0
                    [AppUniqueId] => 0
                    [AppType] => 
                )
        )
    [message] => Successful!
)
```

### 搜索应用数据
#### 描述
通过关键字`key`、搜索方向`type`来在指定方向搜索应用，返回搜索到应用的全部信息（请注意：该API可能在未来会修改为返回搜索到应用的部分信息，比如：AppID、AppName等，而并非全部，请注意规避）。
#### 调用地址
```
api/api_searchApp.php
```
#### 参数传递
| 传入参数 | 传入方式 | 是否必须 | 数据类型 | 描述 |
| ---- | ---- | ---- | ---- | ---- |
| key | GET | 是 | string | 关键词，支持模糊包含关系的模糊搜索 |
| type | GET | 是 | string | 搜索方向（比如：应用名等）需要在下面数组中选择一项查找。array("AppId","AppName","AppDownloadUrl","AppVersion","AppNewVersion","AppOneSentenceIntroduction","AppIntroduction","AppLogoUrl","AppIntroductionPictureUrl","AppUpdateIntroduction","AppInerVersion","AppUpUserId","AppUniqueId","AppType") |
| format | GET | 否 | string | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数 | 数据类型 | 描述 |
| ---- | ---- | ---- |
| code | int | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释 |
| data | array | 获取到应用的信息 |
#### 调用示例

**构造链接：** 
```
api/api_searchApp.php?key=测试&type=AppName
```
**返回数据**：
``` PHP

Array
(
    [code] => 1
    [data] => Array
        (
            [0] => Array
                (
                    [AppId] => 2
                    [AppName] => 测试应用
                    [AppDownloadUrl] => test.com
                    [AppVersion] => 1.0
                    [AppNewVersion] => 2.0
                    [AppOneSentenceIntroduction] => TEST TEXT
                    [AppIntroduction] => INTRODUCTION TEXT
                    [AppLogoUrl] => ./test.png
                    [AppIntroductionPictureUrl] => 
                    [AppUpdateIntroduction] => 
                    [AppInerVersion] => 0
                    [AppUpUserId] => 0
                    [AppUniqueId] => 1
                    [AppType] => TESTTYPE
                )
            [1] => Array
                (
                    [AppId] => 3
                    [AppName] => 测试应用（NEW）
                    [AppDownloadUrl] => test_new.com
                    [AppVersion] => 2.0
                    [AppNewVersion] => 2.0
                    [AppOneSentenceIntroduction] => TEST TEXT
                    [AppIntroduction] => INTRODUCTION TEXT
                    [AppLogoUrl] => ./test.png
                    [AppIntroductionPictureUrl] => 
                    [AppUpdateIntroduction] => 
                    [AppInerVersion] => 0
                    [AppUpUserId] => 0
                    [AppUniqueId] => 1
                    [AppType] => TESTTYPE
                )
        )
    [message] => Successful!
)

```
### 新增应用
#### 描述
在认证开发者或管理员身份下可用，在数据库中新添加一个应用。认证开发者上传后将不会直接在列表页面显示，需等待管理员审核后显示，管理员身份添加的应用将会直接显示。
#### 调用地址
```
api/api_addApp.php
```
#### 参数传递
| 传入参数                       | 传入方式 | 是否必须 | 数据类型         | 描述                                   |
| -------------------------- | ---- | ---- | ------------ | ------------------------------------ |
| AppName                    | POST | 是    | string(json) | 应用名称                                 |
| AppDownloadUrl             | POST | 是    | string(json) | 应用下载地址                               |
| AppVersion                 | POST | 是    | string(json) | 应用当前版本名                              |
| AppNewVersion              | POST | 是    | string(json) | 应用最新版本名                              |
| AppOneSentenceIntroduction | POST | 是    | string(json) | 应用一句话介绍（Slogan）                      |
| AppIntroduction            | POST | 是    | string(json) | 应用介绍                                 |
| AppLogoUrl                 | POST | 是    | string(json) | 应用Logo图片                             |
| AppIntroductionPictureUrl  | POST | 是    | string(json) | 应用介绍图片                               |
| AppUpdateIntroduction      | POST | 否    | string(json) | 应用新版本更新介绍                            |
| AppDeveloper               | POST | 否    | string(json) | 应用开发者名称                              |
| AppDeveloperUrl            | POST | 否    | string(json) | 应用开发者主页链接                            |
| AppPackageName             | POST | 是    | string(json) | 应用包名（应用唯一身份标识）                       |
| AppType                    | POST | 否    | string(json) | 应用分类                                 |
| format                     | GET  | 否    | string       | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数 | 数据类型 | 描述 |
| ---- | ---- | ---- |
| code | int | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释 |
| data | array | 空 |
#### 调用示例
以下是一个前端页面像后端请求新增应用的参考示例，传递参数请使用字典转换json格式传递。
```javascript
<script>
  var this_app_data = {
    AppName: '测试应用3',
    AppDownloadUrl: 'https://ceshi.com/test.apk',
    AppVersion: '1.0.0',
    AppNewVersion: '1.0.0',
    AppOneSentenceIntroduction: '测试应用3的一句话介绍',
    AppIntroduction: '测试应用3的详细介绍',
    AppLogoUrl: 'https://ceshi.com/test.png',
    AppIntroductionPictureUrl: 'https://ceshi.com/test.png',
    AppUpdateIntroduction: '测试应用3的更新介绍',
    AppPackageName: 'com.test.test',
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
```
### 更新应用
#### 描述
在认证开发者或管理员身份下可用，对数据库已有并且审核通过应用的应用进行更新。认证开发者上传后将不会直接在列表页面显示，需等待管理员审核后显示，管理员身份更新的应用将会直接显示。
#### 调用地址
```
api/api_updateApp.php
```
#### 参数传递
| 传入参数                       | 传入方式 | 是否必须 | 数据类型         | 描述                                   |
| -------------------------- | ---- | ---- | ------------ | ------------------------------------ |
| AppName                    | POST | 是    | string(json) | 应用名称                                 |
| AppDownloadUrl             | POST | 是    | string(json) | 应用下载地址                               |
| AppVersion                 | POST | 是    | string(json) | 应用当前版本名                              |
| AppNewVersion              | POST | 是    | string(json) | 应用最新版本名                              |
| AppOneSentenceIntroduction | POST | 是    | string(json) | 应用一句话介绍（Slogan）                      |
| AppIntroduction            | POST | 是    | string(json) | 应用介绍                                 |
| AppLogoUrl                 | POST | 是    | string(json) | 应用Logo图片                             |
| AppIntroductionPictureUrl  | POST | 是    | string(json) | 应用介绍图片                               |
| AppUpdateIntroduction      | POST | 否    | string(json) | 应用新版本更新介绍                            |
| AppDeveloper               | POST | 否    | string(json) | 应用开发者名称                              |
| AppDeveloperUrl            | POST | 否    | string(json) | 应用开发者主页链接                            |
| AppPackageName             | POST | 是    | string(json) | 应用包名（应用唯一身份标识）                       |
| AppType                    | POST | 否    | string(json) | 应用分类                                 |
| format                     | GET  | 否    | string       | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数 | 数据类型 | 描述 |
| ---- | ---- | ---- |
| code | int | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释 |
| data | array | 空 |
#### 调用示例
由于POST传入参数与新增应用完全相同，所以推荐前端按照：调用 [[#搜索应用数据]]->使用form表单控件默认值功能展示->用户对需要更新的值进行修改->调用[[#更新应用]]来进行应用更新。应用更新的逻辑是在数据库中新增一条应用，通过包名与之前上传的应用关联，通过`AppInerVersion`值自增来判断更新，此值无需也不能自行填写或修改。请注意，若数据库中未存在包名相同的应用或者包名相同的应用未通过审核，将无法调用此接口进行更新，此情况返回值为-4。以下是一个前端页面像后端请求更新的参考示例，传递参数请使用字典转换json格式传递。
```javascript
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
    AppPackageName: 'com.test5.test',
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
```
### 删除应用
#### 描述
在管理员身份下可用，对数据库已有并且审核通过应用的应用进行隐藏。本接口仅仅会对对应的应用`IsAvailable`值修改赋0，而不会在数据库中删除，若需要在数据库中删除数据，需联系管理员处理。通常情况下，前端应按照调用 [[#搜索应用数据]]->用户对需要删除的应用进行选择->调用[[#删除应用]]。
#### 调用地址
```
api/api_deleteApp.php
```
#### 参数传递
| 传入参数   | 传入方式 | 是否必须 | 数据类型   | 描述                                   |
| ------ | ---- | ---- | ------ | ------------------------------------ |
| AppId  | GET  | 是    | string | 应用唯一标识                               |
| format | GET  | 否    | string | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数    | 数据类型   | 描述            |
| ------- | ------ | ------------- |
| code    | int    | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释      |
| data    | array  | 空             |

## 用户类
### 用户注册
#### 描述
注册一个粼光普通用户
#### 调用地址
```
api/api_userSignIn.php
```
#### 参数传递
| 传入参数 | 传入方式 | 是否必须 | 数据类型 | 描述 |
| ---- | ---- | ---- | ---- | ---- |
| name | POST | 是 | string(FormData) | 2-6字符 |
| qq | POST | 是 | string(FormData) | 不允许与数据库已存在账户重复 |
| password | POST | 是 | string(FormData) | 英文大写、英文小写、标点、数字任选2 |
| format | GET | 否 | string | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数 | 数据类型 | 描述 |
| ---- | ---- | ---- |
| code | int | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释 |
| data | array | 空 |
#### 调用示例
以下是一个前端页面像后端请求注册的参考示例，传递参数请使用form表单组件格式传递。
```html
    <form action=" " id="submit_form" method="post" style="margin-left: 5%;margin-right: 5%;"
      onsubmit="SubmitForm(event)">
      <div style="width:100%;">
        <span style="font-size:20px;">昵称：</sapn>
          <mdui-text-field label="请输入您的用户名" placeholder="请输入" style="width:80%" clearable type="text" name="name"
            id="name" class="text_box"></mdui-text-field>
      </div>
      <div style="width:100%;margin-top:20px;">
        <span style="font-size:20px;">账号：</sapn>
          <mdui-text-field label="请输入您的QQ号" placeholder="请输入" style="width:80%" clearable type="text" name="qq" id="qq" class="text_box"></mdui-text-field>
      </div>
      <div style="width:100%;margin-top:20px;">
        <span style="font-size:20px;">密码：</sapn>
          <mdui-text-field toggle-password label="请输入您的密码" placeholder="请输入" style="width:80%" clearable type="password" name="password" class="text_box"></mdui-text-field>
      </div>
      <mdui-button type="submit" value="注册" style="margin-top:20px;">注册</mdui-button>
    </form>
```
```javascript
var form_data = new FormData(form);//form是一个表单组件
var url = "../api/api_userSignIn.php";
        fetch(url, {
          method: "POST",
          body: form_data //请前端使用表单体
        })
          .then(response => response.json())
          .then(data => {
            console.log(data);
            if (data.code !== 1) {
              alert(data.msg);
            } else {
              alert("注册成功");
            }
          })
          .catch(error => {
            console.log("error: ", error);
          })
```
### 用户登录
#### 描述
粼光用户登录，登录后将会有SESSION信息
#### 调用地址
```
api/api_userLogIn.php
```
#### 参数传递
| 传入参数 | 传入方式 | 是否必须 | 数据类型 | 描述 |
| ---- | ---- | ---- | ---- | ---- |
| qq | POST | 是 | string(FormData) |  |
| password | POST | 是 | string(FormData) | 英文大写、英文小写、标点、数字任选2 |
| format | GET | 否 | string | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数 | 数据类型 | 描述 |
| ---- | ---- | ---- |
| code | int | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释 |
| data | array | 空 |
#### 调用示例
以下是一个前端页面像后端请求登录的参考示例，传递参数请使用form表单组件格式传递。
```html
    <form action=" " method="post" style="margin-left: 5%;margin-right: 5%;" id="submit_form"
      onsubmit="SubmitForm(event)">
      <div style="width:100%;">
        <span style="font-size:20px;">账号：</sapn>
          <mdui-text-field label="请输入您的QQ号" placeholder="请输入" style="width:80%" clearable type="text" name="qq" class="text_box" value="<?php echo $qq ?>"></mdui-text-field>
      </div>
      <div style="width:100%;margin-top:20px;">
        <span style="font-size:20px;">密码：</sapn>
          <mdui-text-field toggle-password label="请输入您的密码" placeholder="请输入" style="width:80%" clearable type="password" name="password" class="text_box"></mdui-text-field>
      </div>
      <mdui-button type="submit" value="提交" style="margin-top:20px;">登录</mdui-button>
    </form>
```
```javascript
// fetch请求
          var form_data = new FormData(form);//form是一个表单组件
          var url = "../api/api_userLogIn.php";
          fetch(url, {
            method: "POST",
            body: form_data
          })
            .then(response => response.json())
            .then(data => {
              console.log(data);
              if (data.code !== 1) {
                alert(data.msg);
              } else {
                // alert("登录成功");
              }
            })
            .catch(error => {
              console.log("error: ", error);
            })
```
### 更改用户名
#### 描述
粼光用户更改用户名
#### 调用地址
```
api/api_changeUserName.php
```
#### 参数传递
| 传入参数   | 传入方式 | 是否必须 | 数据类型             | 描述                                   |
| ------ | ---- | ---- | ---------------- | ------------------------------------ |
| name   | POST | 是    | string(FormData) | 2-6合法字符                              |
| format | GET  | 否    | string           | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数    | 数据类型   | 描述            |
| ------- | ------ | ------------- |
| code    | int    | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释      |
| data    | array  | 空             |
### 退出登录
#### 描述
粼光用户退出登录
#### 调用地址
```
api/api_userLogOut.php
```
#### 参数传递
| 传入参数   | 传入方式 | 是否必须 | 数据类型   | 描述                                   |
| ------ | ---- | ---- | ------ | ------------------------------------ |
| format | GET  | 否    | string | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数 | 数据类型 | 描述 |
| ---- | ---- | ---- |
| code | int | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释 |
| data | array | 空 |

### 更新用户登录态
#### 描述
更新用户身份认证SESSION
#### 调用地址
```
api/api_updateSession.php
```
#### 参数传递
| 传入参数   | 传入方式 | 是否必须 | 数据类型   | 描述                                   |
| ------ | ---- | ---- | ------ | ------------------------------------ |
| format | GET  | 否    | string | 可填array使返回数据为array格式，未填写则返回数据为json格式 |

#### 返回参数
| 返回参数 | 数据类型 | 描述 |
| ---- | ---- | ---- |
| code | int | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释 |
| data | array | 空 |

## 资源类
### 上传图片资源
#### 描述
向数据库上传一张图片资源文件，仅在管理员身份或者认证开发者身份下有效。
#### 调用地址
```
api/api_uploadPicture.php
```
#### 参数传递
| 传入参数   | 传入方式 | 是否必须 | 数据类型                | 描述                                   |
| ------ | ---- | ---- | ------------------- | ------------------------------------ |
| data   | POST | 是    | string(base64,json) | 图片资源的base64编码文件                      |
| format | GET  | 否    | string              | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数    | 数据类型   | 描述            |
| ------- | ------ | ------------- |
| code    | int    | 获取成功为1，不成功为非1 |
| message | string | 对应错误码的解释      |
| data    | array  | 上传图片的唯一标识id   |
#### 调用示例
以下是一个前端调用图片上传接口的示例，首先使用input控件收集文件，并监听控件，当文件选择器收到文件后将图片文件转换为base64编码格式并通过fetch请求调用接口完成上传。请注意，使用本接口需登录并确保身份组为管理员或认证开发者，并且确保传入数据为带有标头的base64格式，形如：
```base64
data:image/png;base64,（后接数据...）
```
若没有`data:image/png;base64,`规范标头将会返回错误值-6。
```html
<input type="file" id="inputImage" accept=".jpeg,.jpg,.png" />
```
```javascript
<script>
      const inputImage = document.getElementById('inputImage');
      var base64;
      inputImage.addEventListener('change', function (event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
          base64 = e.target.result;
          console.log(base64); // 输出图片的Base64编码
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
        };
        reader.readAsDataURL(file);
      });
</script>
```
### 获取图片资源
#### 描述
从数据库获取一张图片资源文件。
#### 调用地址
```
api/api_getPicture.php
```
#### 参数传递
| 传入参数   | 传入方式 | 是否必须 | 数据类型   | 描述                                   |
| ------ | ---- | ---- | ------ | ------------------------------------ |
| id     | GET  | 是    | int    | 图片资源的唯一标识                            |
| format | GET  | 否    | string | 可填array使返回数据为array格式，未填写则返回数据为json格式 |
#### 返回参数
| 返回参数    | 数据类型   | 描述                 |
| ------- | ------ | ------------------ |
| code    | int    | 获取成功为1，不成功为非1      |
| message | string | 对应错误码的解释           |
| data    | array  | 图片资源的base64编码文件字符串 |
#### 调用示例
以下是一个调用获取图片接口的前端示例。
```html
<img src="" alt="" id="pic">
```
```javascript
<script>
      // fetch请求
      var url = "../api/api_getPicture.php?id=1";
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
            console.log(data.data[0]['data']);
            var pic = document.getElementById('pic');
            pic.src = data.data[0]['data'];
          }
        })
        .catch(error => {
          //异常处理
          console.log("error: ", error);
        })
</script>
```
### 发送邮件
#### 描述
使用粼光平台给指定邮箱或用户发送邮件（内部API，暂时不对外开放）。

