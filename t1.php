<?php
	//Show Errors for Debugging, this option overwrite the Server Configuration that has wrotten in the php.ini fille!
	ini_set('error_reporting', E_ALL);
	if($_GET["id"] == "phpinfo")
	{
	  phpinfo();
	  die();
	}
	$site = mysql_escape_string($_GET["id"]);
	if($site == NULL)
	{
	  $site = 1;
	}
	function include_config()
	{
	  if(file_exists("jh_conf.php") == true)
	  {
	    include("jh_conf.php");
	    include("db.php");  
	  }
	  else
	  {
	    if($_GET["chmod"] != "setup")
	    {
	      header("location:?chmod=setup");
	    }
	  }
	}
	function do_setup()
	{
	  include("setupx.php");
	}
	include_config();
	function color()
	{
		$color = $_GET["c"];
		if($color != NULL)
		{
			return "#" . $color;
		}
		else
		{
			return "#FF0000;";
		}
	}
?>
<html>
	<head>
		<title>PHP-Test!</title>
		<link rel="stylesheet" href="t1.css" type="text/css"/>
		<?php if($site == "add"){ echo('<script src="editor/ckeditor.js"></script>');}?>
		<?php if($site == "add"){ echo('<link rel="stylesheet" href="editor/toolbarconfigurator/lib/codemirror/neo.css">');}?>
	</head>
	<body>
		<div id="top">
			<h2>Jenni-CMS</h2>
			<ul id="master_navset">
				<!--<li><a href="index.php">Home</a></li>-->
				<!--IncludePHPBasedNavigationSublinksHere-->
				<?php
				  if(file_exists("jh_conf.php") == true)
				  {
				    $abfrage = "SELECT * FROM rootLevel_Sites";
				    $ergebnis = mysql_query($abfrage);
				    while($row = mysql_fetch_object($ergebnis))
				    {
				      if($row->Parrent == NULL)
				      {
					echo('<li><a href="?id=' . $row->ID . '">' . $row->Title . '</a></li>');
				      }
				    }
				  }
				  else
				  {
				    echo('<li><a href="?chmod=setup">Installation</a></li>');
				  }
				?>
			</ul>
		</div>
		<div id="wraper">
			<?php
			  $mode = $_GET[chmod];
			  switch($mode)
			  {
			    case "setup": do_setup(); break;
			    default: include("site.php"); break;
			  }
			?>
		</div>
	</body>
</html>
