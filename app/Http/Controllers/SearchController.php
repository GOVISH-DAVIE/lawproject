<?php

namespace App\Http\Controllers;

use App\Models\Records;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function title($data)
    {
      $s =   Records::query()
            ->where('clientname', 'LIKE', "%{$data}%")
            ->where('title', 'LIKE', "%{$data}%")
            ->orWhere('email', 'LIKE', "%{$data}%")
            ->get();
            return $s;
    }
}
