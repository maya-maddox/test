<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxProject;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxProjectIngestor;
use App\Ingestors\CrowdOx\CrowdOxProjectCustomFieldIngestor;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Http\Request;

class CrowdOxProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.projects.index', ["crowdox_projects" => CrowdOxProject::all()]);
    }

    public function import()
    {
        $ingestor = new CrowdOxProjectIngestor();
        $ingestor->ingest();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxProject  $project
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxProject $project)
    {
        return view('stores.crowdox.projects.show', ["crowdox_project" => $project]);
    }

    public function importCustomFields(CrowdOxProject $project)
    {
        $ingestor = new CrowdOxProjectCustomFieldIngestor($project->crowd_ox_id);
        $ingestor->ingest();

        return redirect()->back();
    }

}
