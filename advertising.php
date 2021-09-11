<?php
$a = 'page';
$page = isset($a['page']) ? (int) $a['page'] : 1;
echo $page;