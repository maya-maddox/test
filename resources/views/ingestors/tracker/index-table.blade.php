@include('components.data-table', [
    "headers" => ["Service", "Comments", "Status", "Created"],
    "data" => $ingestions,
    "keys" => ["service", "comments", "status", "created_at"],
    "key_style" => ["comments" => "escaped"],
    "routes" => ["route" => "ingestors.tracker", "show"],
    "name" => "Ingestion Tracks"
])
