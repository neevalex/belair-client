<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {   
        // return dashboard view with events
        return view('dashboard', [
            'events' => $this->events(
                request()
            ),
        ]);
    }

    public function events(Request $request): JsonResponse
    {

        $user = $request->user();

        if (! $user || $user->role !== 'client') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }


        $invoices = Invoice::query()
            ->where('user_id', $user->id)
            ->get();

        $events = $invoices->map(function (Invoice $invoice) {
            $status = (string) $invoice->status;
            $amount = is_numeric($invoice->amount) ? number_format((float) $invoice->amount, 2) : (string) $invoice->amount;
            $date = $invoice->date;

            //convert Y-m-d string to timestamp
            $dateFormatted = $date;

            return [
                'id' => (string) $invoice->id,
                'title' => trim(sprintf('%s • $%s • %s', $invoice->invoice_number ?? 'Invoice', $amount, Str::title($status))),
                'start' => $dateFormatted,
                'allDay' => true,
                'extendedProps' => [
                    'invoice_number' => $invoice->number,
                    'amount' => $amount,
                    'status' => $status,
                    'due_date' => $invoice->date,
                    'issued_at' => optional($invoice->created_at)->toDateString(),
                ],
                'color' => match ($status) {
                    'paid' => '#16a34a',      // green-600
                    'pending' => '#f59e0b',   // amber-500
                    'overdue' => '#dc2626',   // red-600
                    default => '#6b7280',     // gray-500
                },
            ];
        });

        return response()->json($events);
    }
}