<?php

namespace App\Http\Controllers\Stores\CrowdOx;

use App\CrowdOxOrder;
use App\Exports\CrowdOx\CrowdOxOrdersDownload;
use App\Http\Controllers\Controller;
use App\Ingestors\CrowdOx\CrowdOxOrderIngestor;
use App\Ingestors\CrowdOx\CrowdOxOrderRelationsIngestor;
use App\Ingestors\CrowdOx\CrowdOxOrderOrderLineIngestor;
use App\Ingestors\CrowdOx\CrowdOxOrderOrderSelectionIngestor;
use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxOrders;
use App\Operators\Facade\OrderLinkersStore;
use App\Support\CrowdOx\OrderCleaner\CrowdOxOrderCleaner;
use App\Support\CrowdOx\OrderExportMapper\CrowdOxOrderExportMapper;
use Carbon\Carbon;
use Illuminate\Database\Connection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CrowdOxOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stores.crowdox.orders.index', ["crowdox_orders" => CrowdOxOrder::with('crowdOxOrderTags', 'crowdOxCustomer')->paginate(50)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrowdOxOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function show(CrowdOxOrder $order)
    {
        $exporter = new CrowdOxOrderExportMapper($order);
        return view('stores.crowdox.orders.show', ["crowdox_order" => $order, "export" => $exporter->export()]);
    }


    public function import(Request $request)
    {
        $ingestor = new CrowdOxOrderIngestor($request->get('crowd_ox_order_id', null));
        $ingestor->ingest();

        return redirect()->back();
    }

    public function importWithRelations(Request $request)
    {
        $ingestor = new CrowdOxOrderRelationsIngestor($request->get('crowd_ox_order_id', null), 1, 1);
        $ingestor->ingest();

        return redirect()->back();
    }

    /**
     * Import orders via job
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importDispatch(Request $request) {
        IngestCrowdOxOrders::dispatch($request->get('page_start', 1), null); //dispatch job

        return redirect()->back();
    }

    public function importOrderLines(Request $request, CrowdOxOrder $order)
    {
        $ingestor = new CrowdOxOrderOrderLineIngestor($order->crowd_ox_id);
        $ingestor->ingest();

        return redirect()->back();
    }

    public function importOrderSelections(Request $request, CrowdOxOrder $order)
    {
        $ingestor = new CrowdOxOrderOrderSelectionIngestor($order->crowd_ox_id);
        $ingestor->ingest();

        return redirect()->back();
    }

    public function clean(CrowdOxOrder $order) {
        $cleaner = new CrowdOxOrderCleaner();
        $cleaner->order($order)->clean();

        return redirect()->back();
    }


    public function link(CrowdOxOrder $order) {
        OrderLinkersStore::link($order);
        return redirect()->back();
    }


    // public function download() {
    //     (new CrowdOxOrdersExport())->store('co_export.csv');
    //     return redirect()->back();
    // }

    public function downloadCustom(Request $request) {
        $options = [
            "with" => $request->get('with', []),
            "whereNotNull" => $request->get('whereNotNull', [])
        ];
        return Excel::download(new CrowdOxOrdersDownload($request->get('fields', []), $options), "custom_co_orders.csv");
    }

    protected $db;
    /**
     * @return StreamedResponse
     */
    public function download(Connection $db): StreamedResponse
    {
        $this->db = $db;
        return response()->stream(
            function (): void {
                $this->stream();
            }
        );
    }

    /**
     * Stream the query as CSV data to the client.
     */
    private function stream(): void
    {
        \header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        \header('Content-Description: File Transfer');
        \header('Content-type: text/csv');
        \header(
            "Content-Disposition: attachment; filename={$this->fileName()}"
        );

        $fh = \fopen('php://output', 'wb');
        foreach ($this->cursor() as $i => $row) {
            $row = (array) $row;
            if ($i === 0) {
                \fputcsv($fh, array_keys($row));
            }
            \fputcsv($fh, $row);
        }
        \flush();
        \fclose($fh);
    }

    /**
     * @return string
     */
    private function fileName(): string
    {
        return Carbon::now()->format(DATE_ATOM).'-crowdox-export.csv';
    }

    /**
     * @return \Generator|array
     */
    private function cursor()
    {
        $this->db->getDoctrineConnection()->setFetchMode(\PDO::FETCH_ASSOC);

        return $this->db->cursor(
            $this->db->raw(
                \file_get_contents(
                    \base_path('resources/queries/crowdox-export.sql')
                )
            )
        );
    }

}
