<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image to Base64</title>
  </head>

  <body>
    <input type="file" id="inputImage" accept=".jpeg,.jpg,.png" />

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
  </body>

</html>