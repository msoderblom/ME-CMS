<?php

function scriptCleaning ($str_in) {
  $search = ['<script>', '</script>'];
  $replacements = ['&lt;script&gt;', '&lt;&sol;script&gt;'];
  return str_replace($search, $replacements, $str_in);

}