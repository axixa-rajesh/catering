<?php 
$a="/-/-//-abc/s/t/s/a/df/--//-";
echo $a,"\n";
echo strlen($a),"\n";
$a=trim($a,'/-af'); //remove space from both side(default) if you passed second argument then it will remove that charactors from string both side
echo $a, "\n";
echo strlen($a);
?>