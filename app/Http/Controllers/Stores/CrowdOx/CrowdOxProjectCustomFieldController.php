<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxProjectCustomField;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrowdOxProjectCustomFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.project-custom-fields.index', ["crowdox_project_custom_fields" => CrowdOxProjectCustomField::all()]);
    }
}
