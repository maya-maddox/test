@include('components.data-table', [
    "headers" => ["Service", "Comments", "Status", "Created"],
    "data" => $discharges,
    "keys" => ["service", "comments", "status", "created_at"],
    "key_style" => ["comments" => "escaped"],
    "routes" => ["route" => "dischargers.tracker", "show"],
    "name" => "Discharge Tracks"
])
