<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $dashboard_cards = array_map(function ($card) {
            return $card;
        }, config("dashboard.cards"));

        $view->with('dashboard_cards', $dashboard_cards);
    }
}
