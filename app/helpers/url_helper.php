<?php
  // Simple page redirect
  function internal_redirect($page){
    header('location: ' . URLROOT . '/' . $page);
  }

  function external_redirect($url){
    header('location: ' . $url);
  }

  function remove_http($url) {
    $disallowed = array('http://', 'https://');
    foreach($disallowed as $d) {
       if(strpos($url, $d) === 0) {
          return str_replace($d, '', $url);
       }
    }
    return $url;
 }