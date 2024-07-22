<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>
    <img src="" alt="" id="pic">
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
  </body>

</html>