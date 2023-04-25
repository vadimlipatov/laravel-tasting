<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
  public function __invoke(Request $request)
  {
    // dd($request->all());
    $id = $request->get('id');
    $utm_source = $request->get('utm_source');
    $utm_medium = $request->get('utm_medium');
    $utm_campaign = $request->get('utm_campaign');
    $utm_content = $request->get('utm_content');
    $utm_term = $request->get('utm_term');
    $array = $request->all();
    $message = "$id $utm_source $utm_medium $utm_campaign $utm_content $utm_term";
    // $message = collect($array)->toJson(JSON_PRETTY_PRINT);
    // dd($message);
    return view('qrcode', compact('message'));
  }
}
