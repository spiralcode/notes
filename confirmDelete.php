<script src = "notey.js">
	</script>
	<style>
		div
		{
			margin:1em;
		}
		.title
		{
			text-align:center;
				font-family: "Segoe UI light",Arial;
		}
		.subTitle
		{
						text-align:center;
							font-family: "Segoe UI light",Arial;
		}
		.options
		{
				padding:.2em;
						text-align:center;
							font-family: "Segoe UI light",Arial;
		}
		.options span
		{
	background: cornflowerblue;
		padding:.2em;
		cursor:pointer;

		}
		.done
		{
					text-align:center;
							font-family: "Segoe UI light",Arial;
							color:red;
		}
		</style>
	<body>
		<div class="title">Are you sure ?</div>
		<div class="subTitle">You will not be able to recover this file after deletion. </div>
		<div class="options"><span onclick="dl8File()">I understand</span> <span onclick="goBack()">Cancel</span></div> 
		</body>
		<script>
			function dl8File()
			{
				notey.post('delete_image.php',{
					id:<?php echo $_GET['id']; ?>
				},function(data){
					if(data.responseText==1)
					{
						document.getElementsByTagName('body')[0].innerHTML="<div class=\"done\">File deleted.</div>";
					}
					else
					{
						alert('Unable to delete this file, encountered an error on-course, please try again.');
					}
				});
			}
			function goBack()
			{
				window.location = "helloFile.php?id=<?php echo $_GET['id']; ?>";
			}
			</script>