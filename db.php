<?php
  /**
  This is the Confiuration fille vor Database Connections, currently you must use this fille, but in futor
  versions this fille will be replaced witha confiruation php fille. Also make sure that you do't use this
  settings in a productive system.
  **/
  $verbindung = mysql_connect("<server>","<user>","<password>");
  mysql_select_db("jh_site"); //Default database is preselected, but you can enter you own database
?>
