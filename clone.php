<?php
function execPrint($command) {
$result = shell_exec($command." 2>&1");
echo $result;
}
echo "<pre>";
execPrint("/usr/bin/git clone https://if415014@students.del.ac.id:dreamon1*@gitlab.del.ac.id/juliper19/Test.git");
echo "</pre>";
?>