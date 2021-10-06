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
            ->where('clientname', 'like', "%{$data}%")
            ->orWhere('location', 'like', "%{$data}%")
            ->orWhere('title', 'like', "%{$data}%")
            ->orWhere('email', 'like', "%{$data}%")
            ->get();
            return $s;
    }
}
