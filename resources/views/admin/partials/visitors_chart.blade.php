<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="card stat-card info mb-4">
  <div class="card-body">
    <h6 class="card-title text-uppercase mb-1">Statistik Pengunjung (30 Hari Terakhir)</h6>
    <canvas id="visitorsChart" height="80"></canvas>

    <div class="mt-3 text-end">
      <a href="{{ route('admin.visitors.index') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-chart-bar me-1"></i> Lihat Detail
      </a>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('visitorsChart').getContext('2d');
    var visitorsChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($visitorChart['labels']),
        datasets: [{
          label: 'Jumlah Pengunjung',
          data: @json($visitorChart['data']),
          borderColor: '#007bff',
          backgroundColor: 'rgba(0,123,255,0.1)',
          fill: true,
          tension: 0.3,
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  });
</script>
