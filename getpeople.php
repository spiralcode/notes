<html>
	<head>
<style>
.spinner {
 display:none;
z-index:101;
  width: 40px;
  height: 40px;
  margin: 100px auto;
  background-color: #0f0;

  border-radius: 100%;  
  -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
  animation: sk-scaleout 1.0s infinite ease-in-out;
}

@-webkit-keyframes sk-scaleout {
  0% { -webkit-transform: scale(0) }
  100% {
    -webkit-transform: scale(3.0);
    opacity: 0;
  }
}

@keyframes sk-scaleout {
  0% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 100% {
    -webkit-transform: scale(3.0);
    transform: scale(1.0);
    opacity: 0;
  }
}
.bigoptions
{
  position:absolute;
  width:90%;
  text-align:center;
  top:40px;
}
.bigoptions span
{
  font-family:Arial,serif;
  font-size:20px;
  color: #A384BD;
  margin:2%;
 min-width:60px;
 min-height:20px;

}
a
{
  text-decoration:none;
    color: #A384BD;
}
a:hover
{
  text-decoration:underline;
}
</style>
<script>

  </script>
		</head>
<body>
<div align="center" class="spinner"></div>
<div class="bigoptions"><span><a href="search_people.php">Search for people</a></span><span><a href="peoples.php">Peoples</a></span></div>
</body>
</html>