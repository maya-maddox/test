<?php

namespace App\Http\Middleware;

use App\Ingestors\Facade\IngestorTracker;
use App\Trackers\Facade\TrackerStore;
use Closure;

class TrackerSaver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Save the ingestor tracker
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    public function terminate($request, $response)
    {
        foreach (TrackerStore::all() as $tracker) {
            $tracker->save();
        }
    }
}
