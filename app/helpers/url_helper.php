<?php
  // Simple page redirect
  function internal_redirect($page){
    header('location: ' . URLROOT . '/' . $page);
  }

  function external_redirect($url){
    header('location: ' . $url);
  }