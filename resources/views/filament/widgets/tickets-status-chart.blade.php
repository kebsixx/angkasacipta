<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Tickets by Status</h2>
        <a 
            href="{{ route('export.tickets.status') }}" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Export to Excel
        </a>
    </div>

    <canvas id="ticketsStatusChart"></canvas>

    <script>
        const data = @json($this->getData());
        new Chart(document.getElementById('ticketsStatusChart'), {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: data.datasets,
            },
            options: {
                responsive: true,
            },
        });
    </script>
</div>
