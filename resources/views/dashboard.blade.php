@extends('layouts.app')

@section('content')

<!-- ===== HERO SECTION ===== -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


<style>
  :root {
    --accent: #ff7a00;
    --bg: #fff8f2;
    --muted: #6b7280;
  }
  body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    color: #1f2937;
  }

  .hero {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 100px 20px 60px;
    text-align: center;
    position: relative;
  }

  .title-wrapper { position: relative; display: inline-block; padding: 10px; }
  .title {
    font-weight: 800;
    font-size: clamp(26px, 8vw, 44px);
    margin: 0;
    color: #1f2937;
  }
  .title .brand {
    background: linear-gradient(90deg, #ff8a00, #004aad);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .orbit {
    position: absolute;
    top: 50%; left: 50%;
    width: 40vw; height: 40vw;
    max-width: 280px; max-height: 280px;
    margin-left: -140px; margin-top: -140px;
    border-radius: 50%;
    z-index: 1;
  }
  .orbit img {
    position: absolute;
    width: 50px; height: 50px; /* ikon jangan kecil */
    transform: translate(-50%, -50%);
    animation: float 3s ease-in-out infinite;
  }
  @keyframes float {
    0%, 100% { transform: translate(-50%, -50%) translateY(0); }
    50% { transform: translate(-50%, -50%) translateY(-8px); }
  }
  .orbit img:nth-child(1) { top: 35%; left: -110%; }
  .orbit img:nth-child(2) { top: 35%; left: 215%; }
  .orbit img:nth-child(3) { top: 30%; left: 100%; }
  .orbit img:nth-child(4) { top: 30%; left: -20%; }

  .hero .subtitle {
    margin: 18px 0 0;
    font-size: clamp(18px, 2.4vw, 22px);
    color: #4b5563;
    font-style: italic;
  }
  .separator {
    height: 4px; width: 300px; margin: 14px auto;
    border-radius: 10px;
    background: linear-gradient(90deg, #f97316, #1e40af);
  }

  /* CHART & MAP STYLE */
  .charts-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    padding: 40px;
  }
  .chart-box {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
   /* Grid chart */
  .charts-grid {
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
    justify-content: center;   /* ⬅️ center horizontal */
    align-items: center; 
    max-width:1100px;
    margin:30px auto;
    padding:0 16px;
  }

  
  #barTotals{height:360px}
  #map{height:440px;max-width:1100px;margin:30px auto;border-radius:14px;box-shadow:0 6px 20px rgba(15,23,42,.06)}
  @media(max-width:900px){.charts-grid{grid-template-columns:1fr}}

  /* Legend scroll bawah chart */
  .legend-scroll {
    max-height: 140px;   /* atur tinggi legend */
    overflow-y: auto;
    margin-top: 12px;
  }
  .legend-scroll ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
  }
  .legend-scroll li {
    display: flex;
    align-items: center;
    margin-bottom: 4px;
    font-size: 14px;
  }
  .legend-scroll li span {
    display: inline-block;
    width: 14px;
    height: 14px;
    margin-right: 6px;
    border-radius: 3px;
  }

  {{-- PETA INTERAKTIF (LEAFLET) --}}
    #map {
        width: 1200px;
        height: 500px;
        border: 2px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .legend {
        background: white;
        padding: 10px;
        border-radius: 5px;
        line-height: 1.5;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border: 1px solid #ccc;
    }

    .legend img {
        vertical-align: middle;
        margin-right: 8px;
        width: 12px;
        height: 20px;
    }
</style>

<section class="hero">
  <div class="title-wrapper">
    <h1 class="title">
      Selamat Datang di Aplikasi <span class="brand">SUROPATI</span>
    </h1>
    <div class="orbit">
      <img src="https://cdn-icons-png.flaticon.com/512/2910/2910768.png" alt="Database">
      <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Chart Pie">
      <img src="https://cdn-icons-png.flaticon.com/512/3050/3050525.png" alt="Report">
      <img src="https://cdn-icons-png.flaticon.com/512/906/906175.png" alt="Data File">
    </div>
  </div>
  <div class="separator"></div>
  <p class="subtitle">Survei Potensi & Pemetaan Usaha Ekonomi</p>
</section>

<!-- ===== PIE CHARTS PER KELURAHAN ===== -->
<section>
 <h4 class="fw-bold text-center" 
    style="font-size: 1.0rem; margin-top:50px; margin-bottom:20px;">
  Diagram Lingkaran Kategori Usaha per Kelurahan
</h4>

  <div class="charts-grid">
    @foreach(['A','B','C','D'] as $i)
      <div class="chart-box">
        <canvas id="pie{{ $i }}"></canvas>
        <div id="legend{{ $i }}" class="legend-scroll"></div>
      </div>
    @endforeach
  </div>
</section>

<!-- ===== BAR CHART ===== -->
<section>
  <h4 class="mb-4 fw-bold text-center" style="font-size: 1.0rem;">Diagram Batang Jumlah Usaha per Kelurahan</h4>
  <div class="chart-box" style="max-width:1100px;margin:0 auto;padding:16px">
    <canvas id="barTotals"></canvas>
  </div>
</section>

<!-- ===== LEAFLET MAP ===== -->
<section>
  <h4 class="mb-2 mt-4 fw-bold text-center" style="font-size: 1.0rem;">Peta Sebaran Usaha</h4>
  <div class="d-flex justify-content-center mb-5">
    <div id="map" class="rounded shadow-sm"></div>
  </div>
</section>

<!-- ===== SCRIPTS ===== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
  // ===== DATA DARI BACKEND =====
  const KATEGORI_LIST   = @json($kategoriList ?? []);
  const REKAP_KATEGORI  = @json($rekapKategori ?? []);
  const REKAP_KEC_TOTAL = @json($rekapPerKelurahan ?? []);
  const LOKASI_USAHA    = @json($lokasiUsaha ?? []);

  const KEL_LIST = Object.keys(REKAP_KATEGORI);
  const COLORS = [
    '#FF6B00','#FF8A33','#FF9F4D','#FFB66B','#FFD7A6',
    '#FF974D','#FF6F00','#FFB86B','#FFCCA3','#FFAB66',
    '#FF9A3B','#FFC48F','#FFB377','#FF8A4D','#FFD7B0',
    '#FF6F00','#FF9F4D','#FFBF84','#FFE8C9'
  ];

  function valuesForKelurahan(kel){
    const rows = REKAP_KATEGORI[kel] || [];
    return KATEGORI_LIST.map(kat => {
      const found = rows.find(r => r.kategori_usaha === kat);
      return found ? Number(found.total) : 0;
    });
  }

  // ==== PIE CHARTS ====
  const pieIds = ['pieA','pieB','pieC','pieD'];
  const legendIds = ['legendA','legendB','legendC','legendD'];
  KEL_LIST.forEach((kel, i) => {
    const el = document.getElementById(pieIds[i]);
    if(!el) return;

    new Chart(el.getContext('2d'), {
      type:'pie',
      data:{
        labels: KATEGORI_LIST,
        datasets:[{
          data: valuesForKelurahan(kel),
          backgroundColor: COLORS,
          borderColor:'#fff',
          borderWidth:1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: {
            display: true,
            text: ' ' + kel,
            font: { size:14, weight:'bold', family:'Poppins, sans-serif' },
            color: '#1f2937'
          }
        }
      },
      plugins: [{
        id: 'htmlLegend',
        afterUpdate(chart) {
          const container = document.getElementById(legendIds[i]);
          const items = chart.data.labels.map((label, idx) => {
            const value = chart.data.datasets[0].data[idx];
            const color = chart.data.datasets[0].backgroundColor[idx];
            return `<li><span style="background:${color}"></span>${label} (${value})</li>`;
          }).join('');
          container.innerHTML = `<ul>${items}</ul>`;
        }
      }]
    });
  });

  // ==== BAR CHART ====
  const barLabels = REKAP_KEC_TOTAL.map(r => r.kelurahan);
  const barData   = REKAP_KEC_TOTAL.map(r => Number(r.total));

  new Chart(document.getElementById('barTotals').getContext('2d'), {
    type:'bar',
    data:{
      labels: barLabels,
      datasets:[{ label:'Jumlah Usaha', data: barData, backgroundColor:'#ff7a00', borderRadius:8 }]
    },
    options:{
      responsive:true,
      maintainAspectRatio: false,
      plugins:{ title:{ display:true, text:'', font:{weight:'bold',size:16} }, legend:{ display:false } },
      scales:{ y:{ 
        beginAtZero:true,
        ticks:{ font:{weight:'bold',size:14} },
       },
      
        x:{ 
        ticks:{ font:{weight:'bold',size:14} }, 
      }
    }
  }
  });

  // ==== LEAFLET MAP ====
  // Inisialisasi peta
  const map = L.map('map').setView([-7.640597, 112.911583], 13);

  // Tambahkan tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Simpan posisi default awal
  const defaultLat = -7.643147;
  const defaultLng = 112.908287;
  const defaultZoom = 13;

  let isMarkerClicked = false;
  let popupJustOpened = false;

  // Event untuk reset jika klik area kosong di map
  map.on('click', function () {
    if (!isMarkerClicked) {
      map.setView([defaultLat, defaultLng], defaultZoom, {
        animate: true,
        duration: 0.8
      });
    }
    isMarkerClicked = false; // reset flag setelah semua klik
  });

  // Data dari backend
  const dataUsaha = @json($lokasiUsaha);

  // Warna per kelurahan
  const kelurahanColors = {
    'Randusari': 'orange',
    'Gentong': 'blue',
    'Pohjentrek': 'green',
    'Mandaranrejo': 'red'
  };

  dataUsaha.forEach(item => {
    const kel = item.kelurahan?.trim();
    const warna = kelurahanColors[kel];

    if (item.latitude && item.longitude && warna) {
      // Buat custom icon
      const customIcon = L.icon({
        iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${warna}.png`,
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });

      const marker = L.marker([item.latitude, item.longitude], { icon: customIcon }).addTo(map);
      const linkMaps = `https://www.google.com/maps?q=${item.latitude},${item.longitude}`;
      marker.bindPopup(`<strong>${item.nama_usaha}</strong><br><a href="${linkMaps}" target="_blank">📍 Lihat di Google Maps</a>`);

      marker.on('click', () => {
        isMarkerClicked = true;
        popupJustOpened = true;

        // Fokus ke marker
        map.setView([item.latitude, item.longitude], 16, {
          animate: true,
          duration: 0.8
        });

        setTimeout(() => popupJustOpened = false, 500);
      });
    }
  });

  // LEGEND
  const legend = L.control({ position: 'bottomright' });
  legend.onAdd = function () {
    const div = L.DomUtil.create('div', 'legend');
    div.innerHTML += "<strong>Keterangan Kelurahan</strong><br>";

    for (const [nama, warna] of Object.entries(kelurahanColors)) {
      const iconUrl = `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${warna}.png`;
      div.innerHTML += `<img src="${iconUrl}"> ${nama}<br>`;
    }

    return div;
  };
  legend.addTo(map);
</script>
@endsection
