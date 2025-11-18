<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
        </h2>
    </x-slot>

    

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h3 class="text-lg font-medium text-gray-900">Total Unpaid Invoices: 
                    €{{ number_format(Auth::user()->invoices->whereIn('status', ['unpaid', 'overdue'])->sum('amount') / 100, 2) }}
                </h3>
                <div class="mt-4">
                    <h3 class="text-lg font-medium text-gray-900">Total Paid Invoices: 
                        €{{ number_format(Auth::user()->invoices->where('status', 'paid')->sum('amount') / 100, 2) }}
                    </h3>
                </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto border-collapse border border-gray-200 w-full">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Invoice #</th>
                                <th class="border border-gray-300 px-4 py-2">Amount</th>
                                <th class="border border-gray-300 px-4 py-2">Date</th>
                                <th class="border border-gray-300 px-4 py-2">Type</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Auth::user()->invoices as $invoice)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $invoice->number }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">€{{ number_format($invoice->amount / 100, 2) }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $invoice->created_at->format('m/d/Y') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ ucfirst($invoice->type) }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ ucfirst($invoice->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
