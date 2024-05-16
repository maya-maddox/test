<?php

namespace App\Http\View\Composers\Tools\ServiceCenter\ReturnsLog;

use App\Models\ServiceCenter;
use App\Models\Sku;
use App\User;
use stdClass;
use Illuminate\View\View;

class ReturnsLogReturnsProcessingButtonsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->service_center = request()->route()->parameter('service_center');

        $view->with([
            "checked_in_returns" => $view->getData()["checked_in_returns"]->transform(fn ($return) => $this->buttonMap($return, "success", "START")),
            "in_process_returns" => $view->getData()["in_process_returns"]->transform(fn ($return) => $this->buttonMap($return, "warning", "CONTINUE")),
            "recent_processed_returns" => $view->getData()["recent_processed_returns"]->setCollection($view->getData()["recent_processed_returns"]->getCollection()->transform(fn ($return) => $this->buttonMap($return, "primary", "VIEW"))),
            "searched_returns" => $view->getData()["searched_returns"]->transform(fn ($return) => $this->buttonMap($return, "secondary", "DETAILS")),
        ]);
    }

    protected ServiceCenter $service_center;

    protected function buttonMap($return, $style, $text) {
        $return->button_raw = "<a href='".route('tools.servicecenter.returnslog.edit', [$this->service_center->id, $return->id])."' class='btn btn-lg btn-".$style."'><strong>".$text."</strong></a>";
        return $return;
    }
}