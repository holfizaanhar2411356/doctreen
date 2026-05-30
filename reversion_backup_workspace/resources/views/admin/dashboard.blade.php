  } else if (button.dataset.dokumenPath) {
    docInfo = `Dokumen saat ini: <a href="${button.dataset.dokumenPath}" target="_blank" style="color:inherit;text-decoration:underline;">Lihat dokumen</a>`;
  }
  document.getElementById('editDokumenInfo').innerHTML = docInfo;
  
  document.getElementById('editKonsultanDokumen').value = null;
  document.getElementById('prevFotoKonsultanEdit').innerHTML = '<div class="ph"><span>👨‍🌾</span>Ganti</div>';
  openModal('modalEditKonsultan');
}

function lihatUlasanKonsultan(id, nama) {
  document.getElementById('ulasanTitle').textContent = 'Ulasan & Rating: ' + nama;
  const container = document.getElementById('ulasanListContainer');
  container.innerHTML = '<div style="color:var(--gray400);text-align:center;padding:2rem 0;">🔄 Memuat ulasan...</div>';
  document.getElementById('ulasanAvg').textContent = '⭐ -';
  document.getElementById('ulasanTotal').textContent = '(— ulasan)';
  
  openModal('modalLihatUlasan');
  
  fetch(`/admin/konsultan/${id}/ulasan`)
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        document.getElementById('ulasanAvg').textContent = '⭐ ' + Number(data.avg_rating).toFixed(1);
        document.getElementById('ulasanTotal').textContent = `(${data.total} ulasan)`;
        
        if (data.ulasans.length === 0) {
          container.innerHTML = '<div style="color:var(--g
<truncated 38174 bytes>
       stops: [0, 90, 100],
        colorStops: [
          {
            offset: 0,
            color: '#639922', // var(--g400)
            opacity: 0.4
          },
          {
            offset: 100,
            color: '#EAF3DE', // var(--g50)
            opacity: 0.0
          }
        ]
      }
    },
    series: [{
      name: 'Pendapatan',
      data: @json($chartData)
    }],
    xaxis: {
      categories: @json($chartLabels),
      labels: {
        style: {
          colors: '#888780', // var(--gray400)
          fontSize: '11px'
        }
      },
      axisBorder: { show: false },
      axisTicks: { show: false }
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return "Rp " + (value / 1000).toFixed(0) + "rb";
        },
        style: {
          colors: '#888780',
          fontSize: '11px'
        }
      }
    },
    grid: {
      borderColor: '#F1EFE8', // var(--gray50)
      strokeDashArray: 4,
      xaxis: { lines: { show: true } },
      yaxis: { lines: { show: true } }
    },
    tooltip: {
      y: {
        formatter: function (value) {
          return "Rp " + new Intl.NumberFormat('id-ID').format(value);
        }
      }
    }
  };

  const chart = new ApexCharts(chartEl, options);
  chart.render();

  const videoUrlInput = document.getElementById('videoUrl');
  if (videoUrlInput) {
    videoUrlInput.addEventListener('input', updateVideoPreview);
  }
});
</script>
</body>
</html>
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.