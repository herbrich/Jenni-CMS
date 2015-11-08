<div id="content">
				<div id="inner_content">
					<?php
					  if($site != "add")
					  {
					    if(file_exists("jh_conf.php") == true)
					    {
					      $query = "SELECT * FROM rootLevel_Sites WHERE ID=$site";
					      $qSiteResult = mysql_query($query);
					      while($page = mysql_fetch_object($qSiteResult))
					      {
						$page_title = mysql_escape_string($page->Title);
						$page_content = mysql_escape_string($page->Content);
						$pageParrent = mysql_escape_string($page->Parrent);
					      }
					      if($page_title == NULL && $page_content == NULL)
					      {
						$page_title = "404: Page dos't Exist!";
						$page_content = "The requestet site dos't exist or was not createt. Contact the Syste Administrator for support!";
					      }
					    }
					  }
					  else
					  {
					    $page_title = "Jenni-CMS Site Editor!";
					  }
					?>
					<h1 id="test-title" style="color:<?php echo(color());?>;"><?php echo($page_title);?></h1>
					<?php echo($page_content); ?>
					<?php
					  if($site == "add")
					  {
					    include("/var/www/html/jhcms_editor.php");
					  }
					?>
					<?php
					  if($_POST["jh-action"] == "insert")
					  {
					    echo("Insert beginns!");
					    $aTitle = $_POST["titel"];
					    $aParrent = $_POST["parrent"];
					    $aContent = $_POST["editor"];
					    if($aTitle != NULL)
					    {
					      //Eventuell noch Parrend erzwingen?!
					      if($aContent != NULL)
					      {
						$eintrag = "INSERT INTO rootLevel_Sites (Title, Content, Parrent) VALUES ('$aTitle', '$aContent', '$aParrent')";
						$eintragen = mysql_query($eintrag); $nextID = $eintragen->ID;
						header("Location: ?id=$nextID");
						die();
					      }
					      else
					      {
						die("Inhalt der neuen Seite eingeben!");
					      }
					    }
					    else
					    {
					      die("Titel Eingeben!");
					    }
					  }
					?>
				</div>
			</div>
			<div id="nav">
			  <ul>
			    <!--<li><a href="?id=1">Test 1</a></li>
			    <li><a href="?id=2">Test 2</a></li>-->
			    <?php
			      if($site != "add")
			      {
				  if($pageParrent != NULL)
				  {
				    $abfrageSub = "SELECT * FROM rootLevel_Sites WHERE Parrent = $pageParrent";
				    $ergebnisSub = mysql_query($abfrageSub);
				    while($subNavItem = mysql_fetch_object($ergebnisSub))
				    {
				      echo('<li><a href="?id=' . $subNavItem->ID . '">' . $subNavItem->Title . '</a></li>');
				    }
				  }
				  else
				  {
				    $abfrageSub = "SELECT * FROM rootLevel_Sites WHERE Parrent = $site";
				    $ergebnisSub = mysql_query($abfrageSub);
				    while($subNavItem = mysql_fetch_object($ergebnisSub))
				    {
				      echo('<li><a href="?id=' . $subNavItem->ID . '">' . $subNavItem->Title . '</a></li>');
				    }
				  }
			      }
				?>
			  </ul>
			</div>