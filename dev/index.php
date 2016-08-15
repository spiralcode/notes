<?php
if(isset($_GET['db_schema']))
{
header('Content-Type: text/sql');
header('Content-Disposition: attachment; filename=notes_db_schema.sql');
header('Pragma: no-cache');
readfile("notes_db_schema.sql");
echo '<p>The Database scheme will be downloaded automatically as a ".sql" file extension , incase if not downloaded <a href="notes_db_schema.sql"> click here</a>';
}

?>