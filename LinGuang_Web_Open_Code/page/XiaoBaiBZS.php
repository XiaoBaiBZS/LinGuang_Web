<?php
?>

<!DOCTYPE html>
<html lang="zh-cn">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>杭城迹忆</title>
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

      @font-face {
        font-family: "HLFont";
        src: url("../src/font/HongLeiXingShuJianTi-2.otf");
      }
    </style>
  </head>

  <body>
    <div style="text-align: left;">
      <div style="float: left;width: 100%;">
        <h1 style="margin-left: 10%; float: left;margin-top: 40px; " id="page_title">
        </h1>
      </div>
    </div>

    <mdui-card style="width: 80%;height: 100px ;margin-left: 10%;margin-right: 10%;">
      <div style="float: left;width: 100px;
      height: 100px;">
        <img src="http://q.qlogo.cn/headimg_dl?dst_uin=1298589907&spec=640&img_type=jpg"
          style="width: 60px;height:60px;border-radius:60px;margin:20px;" />


        <!-- 
        <mdui-icon name="verified_user--rounded"
          style="position: absolute; left: 60px; top: 60px; color: #6449A3;"></mdui-icon>');
 -->

      </div>
      <div style="margin-left: 100px;" class="useinfo_div">

        <img src="../src/title.png" style="width: 65px;margin-left: 0px;margin-top: 16px" alt="">


        <p style="margin-top: 0px;">XiaoBaiBZS 粼光 合作作品</p>

      </div>
    </mdui-card>

    <p style="margin-left:10%;font-size: 16px;margin-top: 20px;font-weight: 800;color:rgb(84, 84, 84)">开发者信息</p>
    <mdui-list style="margin-left: 10%;margin-right: 10%;margin-top: 10px;">
      <mdui-list-item rounded alignment="center" class="optionlist_like">
        <mdui-avatar src="../src/zjut_logo.png"></mdui-avatar>
        浙江工业大学
      </mdui-list-item>

    </mdui-list>

    <p style="margin-left:10%;font-size: 16px;margin-top: 20px;font-weight: 800;color:rgb(84, 84, 84)">开发者参与的其他作品</p>

    <mdui-list style="margin-left: 10%;margin-right: 10%;margin-top: 10px;">
      <mdui-list-item rounded alignment="center" class="optionlist_like">
        <mdui-avatar src="../src/hangzhoumemory_logo.png"></mdui-avatar>
        杭城迹忆
      </mdui-list-item>

    </mdui-list>
    <mdui-tabs value="tab-1" placement="top" class="example-placement" style="margin-left:20px;margin-right: 20px;">
      <mdui-tab value="tab-1">
        <p style="font-size: 16px;font-weight: 800;color:rgb(84, 84, 84)">历程</p>
      </mdui-tab>
      <mdui-tab value="tab-2">
        <p style="font-size: 16px;font-weight: 800;color:rgb(84, 84, 84)">编程</p>
      </mdui-tab>
      <mdui-tab value="tab-3">
        <p style="font-size: 16px;font-weight: 800;color:rgb(84, 84, 84)">旅途</p>
      </mdui-tab>
      <mdui-tab value="tab-4">
        <p style="font-size: 16px;font-weight: 800;color:rgb(84, 84, 84)">未来</p>
      </mdui-tab>

      <mdui-tab-panel slot="panel" value="tab-1">
        <p
          style="margin-left:10%;font-size: 16px;margin-top: 20px;color:rgb(84, 84, 84);font-family: 'HLFont', Arial, sans-serif; font-size: 26px;">
          作品历程</p>
        <p style="margin-left: 10%;margin-right: 10%;">
          <br>

          项目起自大一上期末，闲的无聊系统学习了一下JavaScript，介于之前的HTML基础，花了3天左右就过了一年基础JavaScript，上手写了杭城迹忆V1.0版本，学会了静态页面，所有数据信息都存储在一个“data.json”的文件中，读取生成页面。
          <br>
          <br>

          经过学习，我可以读取json文件了，那么我是不是可以写一个用户系统呢？似乎可行，但是如何把信息写到这个json文件中困难重重，促使我开始了后端的学习。
          <br>
          <br>
          介于“PHP是世界上最好的语言”doge，加之我并不清楚后端语言的选择，就先从PHP语言学起来了，跟着哔站猫叔的视频，简单跟着写了写Demo，就开始着手杭城迹忆的用户系统。历时3个月，一个崭新的前后端分离的网站初见雏形。
          <br>
          <br>
          小的时候看了txt觉得丑，看了word又少有麻烦，于是接触了markdown语法，接着就发现HTML超文本标记语言我似乎也能看懂，然后就可以写静态网页了，简单的HTML有点丑，学学CSS吧；HTML没有交互，学学JavaScript吧，静态网页没什么意思，学学后端吧，又开始学PHP；网站似乎有点落后，学学小程序开发……
          学无止境，尤其是爱好程序员上面，这类程序员本着对编程的热爱，对算法的研究，对创意的实现而孜孜不倦。
          <br>
          <br>
          为什么做这样一个项目？本地存储照片无法更好的分类，便想到了用WPS智能文档（类似一种markdown语法的云文档）来收藏照片。这个项目记载着我在杭城迹忆的探索和在杭生活的点点滴滴，也是我第一个完全独立搭建的网页，更是我JavaScript、PHP、SQL、网站前后端技术学习的实践成果。
          <br>
          <br>
          从2022年接触FusionApp使用lua脚本语言编写Android小程序时开始接触到了编程，在2023年初接触到了粼光项目，开始摸索了纯前端静态网页的基本编写，照猫画虎找来抄来HTML和CSS代码，偶尔也生搬硬套一些JavaScript，实现了静态网页的编写。在2024年末，开始了杭城迹忆项目，实现了我独立自主建站（甚至网页代码都用的原生JavaScript和PHP，没有用框架/至少目前是这样），从服务器的选择、服务器的参数配置、网站域名的购买、网站的公安备案、SSL证书的配置、宝塔面板的安装、我从头走了一遍个人开发者使用云服务器搭建网站的合法合规流程，悉知了如何在法律范围内运营网站。
          <br>
          <br>
          回首往昔，似乎一切都是自娱自乐，似乎就没有什么实质性的东西拿的出手，曾经的我甚至会为一个套壳应用而心满意足，为一个post请求而沾沾自喜，多文言Duo、E测评、课程时钟……我甚至都不会用数组啊！为了一个功能我甚至写了600个变量！曾经的我啊！
          <br>
          <br>
          随着各种法律条款的制订和实施，不得不说，如此环境对个人开发者无疑是不利的，事事要备案，国内服务器/应用程序无备案则无法访问甚至无法安装，按照这个流程跑下来，如果网站内容得当，舍得花钱（阿里云不为白嫖的服务器免费提供备案服务/哭，找了个第三方平台9块9买了个服务码）还是能较快办下来备案的。即使有盈利途径，个人开发者往往也难以平衡服务器开支，大多都是“为爱发电”，也似乎越来越多的个人开发者隐去，也许这个项目就是我的自娱自乐吧，希望能坚持的久一些。

        </p>

        <br>
      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-2">
        <p
          style="margin-left:10%;font-size: 16px;margin-top: 20px;color:rgb(84, 84, 84);font-family: 'HLFont', Arial, sans-serif; font-size: 26px;">
          编程意义</p>
        <p style="margin-left: 10%;margin-right: 10%;">
          <br>
          我想可能是编程是实现我一些天马行空的想象的一种途径吧，硬件嵌入式我也接触过，也很有趣，stm32、esp82我都有所涉猎，从免费打样电路板到自动化专业智能车竞赛，但是有的事情一旦涉及到和别人比就瞬间累人和无聊（就说的是智能车，一个周末，花费了若干时辰画的PCB把芯片放上去就烫手、stm32核心板烧了两个、电机驱动焊坏一个、干电池干废一板没电了、手被排针扎出来4个洞、被烙铁烫出来两个小口，真的一个周末失去所有，看着别人在我旁边调车而我什么也不能做，看着一群混子都比我从头学过来的做得好，我有多难受啊，在公园坐了40分钟没缓过来，第二天去西湖边上坐了一上午，才略有缓解，也许我很久都没上心做某些事情了），也可能我的兴趣并非硬件吧或者说是兴趣没有软件高。
          <br>
          <br>
          高考结束，我有了很多时间，我尝试学习C#和WPF，想使用WinUI3写一个笔记类Windows应用，勉勉强强翻WinUI3的示例写了一个，终不了了之。我曾经认为Windows没有好用的手写笔应用，我想为班级希沃大屏开发一个更好用的，但是现在想想我纯纯功力不足，空有想象，没有能力。我想为了能不能去做一个更好的教学类APP呢？支持色弱人士（高中班级有两三个色弱的同学，如果有更好的方案配色会不会提高授课效果呢）？享做笔记有的功能全都有，更流畅，更适合Windows？
          <br>
          <br>
          大一上玩，想上手Kotlin和Android studio，终在gradle下载而草草了事，加之网上系统资料又少，学起来报错重重。
          <br>
          <br>
          玩了一圈才发现，网页编程真的是比较简单了，也是很多其他项目的基础。比如：标签式页面元素样式、API编写等等。越是学习编程，尤其是这种小项目，越会发现，编程就是一个巨大的增删改查排doge笑哭。
          C语言作为工科学生大多都会学习的一门课，似乎对软件层面开发没有任何帮助，甚至学习过程中老师都没有教你如何能让C语言有图形界面的效果。但是无疑C语言是很多语言的基，学了C语言不会让你写一个网站写一个APP，但是一定可以极大的加快你掌握其他语言的速度（尤其是这门语言还是弱数据类型语言doge原谅ta），学习C语言的你可能会觉得这种“面向console编程”有什么意思？我曾经也这么认为，于是我学习了C语言图形库（但是实际上C语言在嵌入式等领域用处极大，如果只是为了写个网站和小应用，恐怕会有人用C语言，也可能用不了C语言），C语言基本学习过程中的语法伴你更轻松的上手一门新的语言。JavaScript课程我两天就刷了50节课，前面的基本语法大致一刷就过，项目中的list页面各种排序无非就是对数据的排序，应用C语言中的知识也就是冒泡。C语言学习中建立的思维逻辑是不可或缺的。

          <br>
          <br>之前看过一个说法，
          <span style="font-family: 'HLFont', Arial, sans-serif; font-size: 20px;">
            人一定要有作品。不管这个作品是不是能够被折算成金钱，或是一种价值上的证明。在这个人的内心，他一定要有一个力量是作品带给他的。是他的可以站直了说话的底气。这个作品不一定是他独立的某一个形式的作品，但是一定是他为之骄傲和付出时间和精力去做成的。除开文艺类这种传统意义上的作品，做菜，练字，健身，跑步，弹吉他，都是作品。甚至经营个人设，构建个社交圈，都可当作品。
            关键是持续不断的投入，让自己从平均线上稍微翘起一点点，再一点点。即便这种凸起无法被人认知，但自己能感知到。 我们就是通过这种方式，重获对人生的掌控感，甚至构建出新的人生的。
          </span>
          <br>
          <br>
          这是我的作品，也是我的自娱自乐。发现身边，为自己的“作品”付出努力，尽管这可能没有表面上的回报。永远相信美好的事情即将发生。



        </p>
      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-3">
        <p
          style="margin-left:10%;font-size: 16px;margin-top: 20px;color:rgb(84, 84, 84);font-family: 'HLFont', Arial, sans-serif; font-size: 26px;">
          永在旅途</p>
        <p style="margin-left: 10%;margin-right: 10%;">
          <br>
          在杭州出行，我的想法是杭州求学4年，总要了解这个城市的一切，无论是城市文化底蕴还是城市历史，而杭州又恰巧是一个“交通发达城市”，杭州的单位时间出行成本要相较于其他城市要低一些，2个小时在杭州你甚至可以到达50多公里外的地方（使用公共交通），这便极大的扩展了我在杭州的探索面。
          <br> <br>
          了解一个城市的最快方式就是公共交通，坐上村村通，便能领略到杭州城郊之烟火气息，也不得不感叹，如此小村都有公共交通，公共交通的发展无疑是提高了杭州城郊村落的发展。像所前三泉王、龙坞龙门坎、萧山楼塔镇、富阳渔山乡……多少村落建设的干净整洁而又富烟火气息。这是主城区的人向往的慢生活。
          <br> <br>
          杭州不只有西湖，西湖不只有湖滨，居住在西湖不到5公里，偶得小闲，西湖旁坐，可谓是晴雨雾雪，各为不同，西湖有“欲把西湖比西子，淡妆浓抹总相宜”亦有“暖风熏得游人醉，直把杭州作汴州。”
          <br> <br>
          一片油菜花黄（富阳渔山乡），一山樱花粉红（玲珑米积村），你不想去亲身看看吗？一个城区的边界（萧山楼塔镇、之江绿道杭州段），你不想去亲身探索吗？一座你曾远眺的山（瓜沥航坞山），你不想亲身征服吗？一个烟火气的古镇（塘栖、楼塔），你不想亲自走走吗？一个千百年的古塔（六和塔），你不想亲手摸摸吗？一个大山里的村村通，你不想亲身乘坐一下吗？……旅行是投入大自然的怀抱，旅行是民俗文化的体验，旅行是身体素质的提高。清明节借着高中老师前来杭州旅游的光体验了一下采茶，颇有感受，真的体会到了《临安春雨初霁》，时间是清明，地点是杭州，天气是雨后初晴，活动是采茶点茶，真的就是“晴窗细乳戏分茶”，这些历史体验唯有亲身实践才能发自内心的感动。追寻历史，保有好奇，在这个网站的建立过程中，我查询了很多地方的人文历史，地名路名起源，“笕桥”“潮王”“所前”“半道红”“拱墅”……细细查询，便能感受地名文化历史。在做这个网站的时候，写的文章引用了很多百度百科的内容，往往都是“先去某个地方，回来才搜索”干这种“马后炮”的事情，如果能把搜索地方文化这一步放在出行之前，恐怕对出行会更有意义。“读万卷书，行万里路”，所行之路，定会呼应所读之书，小时读过背过的课文古文诗词，就在这“万里路”中重现。再发现，一种莫名的感动涌上心。
          <br> <br>
          凡所事，早起便成了大半，大多我一人独行（或者说是全都是我自己出行），往往没人能与我合得来，出去玩必定要早起，早起便可以错过人山人海，看到更好的景色，也可以早一点回来。但往往没人能在5点乃至4点起来准备出行。在大学中坚持自律（尤其是早睡早起）是尤其重要的，人往往是在堕落中不能自拔，愈发颓唐，那种颓废气息是能让人感受到的，是绝对不一样的。早起就比较别人多了时间（有效时间）去做事情，早睡就比较别人多了时间去休息。
          <br> <br>
          能在出行中遇到的人，大多是积极的朋友，在外出行，不妨合理的结识志同道合的朋友。空闲时间出去做志愿者，出去旅行的人，大抵不会是一个消极的人。
          <br> <br>
          相比于打游戏这种最廉价的获取快乐的方式，我认为通过编程把创造力实现和出门旅行是一种较为高质量的获取快乐的方式，获取快乐是人之所需，低廉的快乐方式会逐渐降低人对快乐的接收阈值，高质量的获取快乐的方式绝对是值得也有意义的，他至少能让人少一分颓废气，多一分积极性。

        </p>

      </mdui-tab-panel>
      <mdui-tab-panel slot="panel" value="tab-4">

        <p
          style="margin-left:10%;font-size: 16px;margin-top: 20px;color:rgb(84, 84, 84);font-family: 'HLFont', Arial, sans-serif; font-size: 26px;">
          未来期许</p>
        <p style="margin-left: 10%;margin-right: 10%;">
          <br>
          目前是在学习UniAPP，尽管小程序这个东西并不太让人认可（甚至我对小程序都深恶痛绝），UniAPP也似乎评价褒贬不一，更多朋友推荐我学学flutter，但是我又没有相关基础，网上资源也少得可怜，我仍然打算先从UniAPP学起，顺带学一下Vue，不知道能不能挤出来时间坚持下去。（如果有人愿意出于爱好接收网站，帮忙维护或者添加新功能，欢迎各位）

          幻想一波：网站不在用WPS的iframe内嵌，改成md文档解析，网站有小程序，网站新增用户数据自定义可视化，用户可以自己设置数据，记录所有走过的路。照片管理，把照片按照地点分类（这个功能有朋友在做，我也想入手，但是一个网站做本地文件的操作总有点“德不配位”的感觉）。

        </p>

      </mdui-tab-panel>
    </mdui-tabs>





  </body>
  <?php
require("../page/footer.php");
  ?>




</html>