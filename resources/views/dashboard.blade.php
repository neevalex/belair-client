<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="calendar"></div>
                    
                    <div class="mt-6 bg-gray-50 p-4 rounded">
                        <h3 class="font-semibold mb-2">Event Details</h3>
                        <div id="event-details" class="text-sm text-gray-600">
                            Click an event to see details
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const detailsEl = document.getElementById('event-details');

        const eventsData = @json($events->original);

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: eventsData,
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                const e = info.event;
                const p = e.extendedProps || {};
                detailsEl.innerHTML = `
                    <div class="space-y-1">
                        <div><span class="font-medium">Invoice:</span> ${p.invoice_number ?? 'N/A'}</div>
                        <div><span class="font-medium">Amount:</span> $${p.amount ?? '0.00'}</div>
                        <div><span class="font-medium">Status:</span> ${p.status ?? '—'}</div>
                        <div><span class="font-medium">Due Date:</span> ${p.due_date ?? '—'}</div>
                        <div><span class="font-medium">Issued:</span> ${p.issued_at ?? '—'}</div>
                    </div>
                `;
            },
        });

        calendar.render();
    });
    </script>
</x-app-layout>
