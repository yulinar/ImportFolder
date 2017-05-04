<!DOCTYPE html>
<html lang="en">
<head>
  <title>JSON to Table</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/desainjson.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    window.onload = function() {
        document.getElementById('files').onchange = function(e) {
            savePaths(e.target.files);
            uploadFiles(e.target.files);
        };
    };

    function uploadFiles(files) {
        xhr = new XMLHttpRequest();
        data = new FormData();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                alert(xhr.responseText);
            }
        };
        for (var i in files) {
            if (typeof files[i].webkitRelativePath != "undefined") {
                var lastChar = files[i].webkitRelativePath.substr(files[i].webkitRelativePath.length - 1);
                if (lastChar !== '.') {
                    data.append(i, files[i]);
                }
            }
        }
        xhr.open('POST', "upload.php", true);
        xhr.send(data);
    }

    function savePaths(files) {
        xhr = new XMLHttpRequest();
        data = new FormData();
        var paths = "";
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
               alert(xhr.responseText);
            }
        };
        for (var i in files) {
            paths += files[i].webkitRelativePath + "###";
        }
        data.append("paths", paths);
        xhr.open("POST", "savePaths.php", true);
        xhr.send(this.data);
    }
</script>
</head>
<body background="back3.jpeg">
<br>
<div class="container">
<div class="kotak">
<h4>Uploader folder</h4>
<h5>upload your folder to your master folder</h5>
<br>          
<input type="file" id="files" name="files[]" webkitdirectory directory multiple/>
<input type="hidden" name="paths" id="paths"/> 
<br>
<a href="toJSON.php" class="btn btn-primary btn-xs" role="button">JSON name file</a> 
</div>
  </div>
</body>
</html>