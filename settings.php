<!doctype html>
<head>
<style type="text/css">
    body{
        font-family: "Segoe UI",Arial;
        text-align: center;
    }
    .optionSlot
    {
      width:90%;
      padding:5%;
      
    }
.optionSlot .option
{
  float:left;
  width:10em;
  height:10em;
  background: skyblue;
  line-height:10em;
  box-shadow:0 0 6px black;
  cursor:pointer;
  margin:1em;
}
.optionSlot .option:hover
{
    box-shadow:0 0 6px blue;
color:blue;
}
.optionSlot .option[type="reset"]
{
  background:()
}
</style>
<script>
  function navigate(url)
  {
    window.location=url;
  }
  </script>
</head><body>
<div align="center" class="spinner"></div>
<div class="optionSlot">
<div class="option" onclick="navigate('accountReset.php')">Account Reset</div>
<div class="option" onclick="navigate('accountReset.php')">Change Password</div>


</div>
</body>
</html>
