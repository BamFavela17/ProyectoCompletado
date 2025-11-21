<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PlazosController extends Controller
{
    public function setTerm(Request $request): RedirectResponse
    {
        $inputString = $request->input("input_string");
        $interval = $request->input("interval");
        $base_date = Carbon::now();

        $calculateWeekly = fn(Carbon $date) => $date->copy()->addWeek();
        $calculateMonthly = fn(Carbon $date) => $date->copy()->addMonth();
        $calculateQuarterly = fn(Carbon $date) => $date->copy()->addMonths(3);

        $calculateTermDate = function () use ($interval, $base_date, $calculateWeekly, $calculateMonthly, $calculateQuarterly): Carbon {
            $functionName = "calculate" . ucfirst($interval);
            return $$functionName($base_date);
        };
        $termDate = $calculateTermDate();

        Cookie::queue("dynamic_term", $inputString, $termDate->minute);
        Cookie::queue("interval", $interval, $termDate->minute);
        Cookie::queue("termDate", $termDate->format("d/M/Y"), $termDate->minute);

        return redirect("/plazo/todos");
    }

    public function showTerm(Request $request): View
    {
        $dynamic_term = $request->cookie("dynamic_term");
        $interval = $request->cookie("interval");
        $termDate = $request->cookie("termDate");

        return view("plazosVista", [
            "term" => $dynamic_term ?? "No term set",
            "interval" => $interval ?? "No interval set",
            "future_date" => $termDate
        ]);
    }

    public function showTermForm(): View
    {
        return view("plazosForm");
    }
}
