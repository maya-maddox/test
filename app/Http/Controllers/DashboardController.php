<?php

namespace App\Http\Controllers;

use App\Ingestors\CrowdOx\CrowdOxProjectCustomFieldIngestor;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Returns main application dashboard
     *
     * @return Response
     */
    public function dashboard() {
        return view('dashboard');
    }


    /**
     * Returns main application services
     *
     * @return Response
     */
    public function services() {
        return view('services');
    }
}
