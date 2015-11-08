<?php
  $table = "rootLevel_Sites";
  $rootTable = '
  CREATE TABLE IF NOT EXISTS `' . $table . '` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(94) DEFAULT NULL,
  `Content` text,
  `Parrent` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=big5 AUTO_INCREMENT=12 ;';
  function CreateDataBase()
  {
   
  }
  function CreateConfigFille($dbServer,$dbName,$dbUser,$dbPassword)
  {
    $configFille = '
<?php
/**
 This is the Configuration PHP Fille.
**/
  
 /**Database Relevanted Stuf**/
 $server = "%server%"; //The MySQL-Server that running the database;
 $database = "%database%"; //The Database;
 $user = "%user%"; //The Username to access the MySQL Server;
 $password = "%password%"; //The Password to autenthicate you user on the MySQL Server;
 $table = "%table%"; //The table the sotres the Sites;
 
 /**Jenni-CMS relevanted config Stuff**/
 $installed=%installed%; //has value true or false, if flase the install screen is unlooct otherwise the install screen is open	
 ?>
    ';
    $myConfig = str_replace("%server%",$dbServer,str_replace("%database%",$dbName,str_replace("%user%",$dbUser,str_replace("%password%",$dbPassword,str_replace("%table%","Jenni-CMS",str_replace("%installed%","true",$configFille))))));
    $xConfig = fopen("jh_conf.php","w");
    fwrite($xConfig,$myConfig);
  }
  //Comment out for Debug!
  CreateConfigFille("server","Jenni-CMS","user","password");
?>
<div id="content">
  <div id="innerContent">
    <h2>Jenni-CMS Installation</h2>
    <p>Das ist die Instalations-Seite des Jenni-CMS, hier werden iniziale Einstellungen vorgenommen wie Datenbank und sonstige umbedingt benötigten einstellungen.</p>
    <hr style="color:#FF0000;"/>
    <form method="post">
      <table>
	<tr>
	  <td>Installations Art</td>
	  <td>
	    <ul>
	      <li><input type="radio" name="setupMode" value="install">Neu Installieren</input></li>
	      <li><input type="radio" name="setupMode" value="join">Mit Existierender Datenbank Verbinden</input></li>
	    </ul>
	  </td>
	</tr>
	<tr>
	  <td><p>MySQL Server</p></td>
	  <td><input type="text" name="dbServer"/></td>
	</tr>
	<tr>
	  <td><p>MySQL Datenbank Name</p></td>
	  <td><input type="text" name="dbName"/></td>
	</tr>
	<tr>
	  <td><p>MySQL Benutzername</p></td>
	  <td><input type="text" name="dbUser"/></td>
	</tr>
	<tr>
	  <td><p>MySQL Password</p></td>
	  <td><input type="password" name="dbPassword"/></td>
	</tr>
      </table>
      <input type="submit" value="Speichern"/>
    </form>
  </div>
</div>
<?php
  $dbServer = $_POST["dbServer"];
  $dbName = $_POST["dbName"];
  $dbUser = $_POST["dbUser"];
  $dbPassword = $_POST["dbPassword"];
  $setupMode = $_POST["setupMode"];
  function JoinDB()
  {
    try
    {
      CreateConfigFille($dbServer,$dbName,$dbUser,$dbPassword);
    }
    catch($e0)
    {
      echo("Beim Beiträten der Datenbank Domäne ist ein Fehler aufgetreten!");
    }
  }
  function CreateDB()
  {
  
  }
  if($setupMode != NULL)
  {
    switch($setupMode)
    {
      switch "join": JoinDB(); break;
      switch "install": CreateDB(); break;
    }
  }
?>