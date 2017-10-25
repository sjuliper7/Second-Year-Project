<?php
function	 execPrint($command)	{
$result	=	shell_exec($command."	 2>&1");
echo	$result;		
}
echo	"<pre>";
execPrint("/usr/bin/git pull https://if415014:dreamon1*@gitlab.del.ac.id/juliper19/pa2d4ti06.git master");
echo	"</pre>";
?>