<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
  public function __invoke()
  {
    return 111;
  }
}
