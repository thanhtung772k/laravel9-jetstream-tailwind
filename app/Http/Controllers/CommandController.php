<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class CommandController extends Controller
{
    /**
     * Batch 01.
     *
     * @return RedirectResponse
     */
    public function insert()
    {
        Artisan::call('insert:cron');

        return redirect()->route('command');
    }
}
