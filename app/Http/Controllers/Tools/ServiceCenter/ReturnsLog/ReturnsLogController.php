<?php
namespace App\Http\Controllers\Tools\ServiceCenter\ReturnsLog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tools\ServiceCenter\ReturnsLog\ReturnsLogImportFileRequest;
use App\Imports\ReturnLogImport;
use App\Jobs\Ingestors\Tools\ServiceCenter\IngestReturnsLog;
use App\Models\Returns;
use App\Models\ServiceCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ReturnsLogController extends Controller
{

    public function index(Request $request, ServiceCenter $service_center) {
        $searchQuery = $request->input('returns-search', null);
        if ($searchQuery) {
        $searched_returns = Returns::where('service_center_id', $service_center->id)
            ->where(function ($query) use ($searchQuery) {
                $query->orWhere('internal_return_id', 'LIKE', '%'.$searchQuery.'%')
                    ->orWhere('supportsync_reference', 'LIKE', '%'.$searchQuery.'%')
                    ->orWhere('zendesk_reference', 'LIKE', '%'.$searchQuery.'%')
                    ->orWhere('other_reference', 'LIKE', '%'.$searchQuery.'%');
            })
            ->limit(50)
            ->get();
        }

        return view('tools.service-center.returns-log.index', ["service_center" => $service_center,
            "checked_in_returns" => $service_center->returns()->where('technician_id', null)->get()->load('checkInUser', 'sku'),
            "in_process_returns" => $service_center->returns()->whereNotNull("technician_id")->whereNull('completed_date')->get(),
            "recent_processed_returns" => $service_center->returns()->whereNotNull('completed_date')->orderBy('completed_date', 'desc')->paginate(),
            "search_query" => $searchQuery,
            "searched_returns" => $searched_returns ?? collect()]);
    }

    public function edit(ServiceCenter $service_center, Returns $return)
    {
        return view('tools.service-center.returns-log.edit', ["service_center" => $service_center, "return" => $return]);
    }

    public function fileUpload(ServiceCenter $service_center, ReturnsLogImportFileRequest $request)
    {
        //dispatch import to a queue (because it's > 30 secs!)
        Excel::queueImport(new ReturnLogImport($service_center), $request->file('returns_log_file'));
        return redirect()->back();
    }
}