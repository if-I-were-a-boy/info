<?php
  $s = " -褚轰-   今天 14:26:05   发表在 [招聘信息]   最后回复  1分钟前";

preg_match('/\d{2}:\d{2}:\d{2}/', $s, $matches);
var_dump($matches);
