<?php

if (!function_exists('generateProductCode')) {
  function generateProductCode()
  {
    return 'PRD-' . date('Y') . '-' . strtoupper(uniqid());
  }
}
