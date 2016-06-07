<?php

$content = $_GET['hack'];
file_put_contents('/tmp/hack.log', $content . "\n", FILE_APPEND);