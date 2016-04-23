<!doctype html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.n_logo
{
	position:absolute;
	top:0px;
	left:0px;
	width:100vw;
background: rgb(19, 20, 23);
height:3vh;
}
.n_logo #logo
{
	float:left;
	font-family: "Segoe UI Light",Arial;
	color:white;
	font-size:1em;
}
.n_logo #opts
{
	float:right;
	right:0px;
	color:white;	
	font-family: "Segoe UI Light",Arial;
}
.framePlace
{
	position:absolute;
	top:calc(100vh - 97vh);
	width:100vw;
	height:calc(100vh - 3vh);

		left:0px;
	width:100vw;
}
.framePlace #iframe
{
			position:absolute;
		left:0px;
	height:calc(100vh - 3vh);
		width:100%;
	border:none;

}
</style>
</head>
<body>
	<div class="n_logo"><div id = "logo">Notes Stream</div><div id = "opts"></div></div>
	<div class="framePlace"><iframe src = "<?php echo "redirectToFile.php?id=".$_GET['id']; ?>" width="50" id = "iframe"></iframe></div>
</body>