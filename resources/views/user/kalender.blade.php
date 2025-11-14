<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Jadwal</title>
    <link rel="stylesheet" href="{{ asset('css/kalender.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <h1 style="display:flex; align-items:center;">
        <i class="fa-solid fa-arrow-left" id="backIcon" style="cursor:pointer; font-size:24px; margin-right:10px;"></i>
        Jadwal Minum Obat
    </h1>
    
    <!-- Navigasi Bulan -->
    <div class="navigation">
        <button id="prevBtn">Sebelumnya</button>
        <button id="nextBtn">Berikutnya</button>
    </div>

    <!-- Tempat kalender akan dirender -->
    <div id="calendar"></div>

    <script>
        document.getElementById("backIcon").addEventListener("click", () => {
         window.location.href = "/dashboard";
        });
        // Variabel bulan saat ini dalam format YYYY-MM
        let currentMonth = "2025-10";

        // Array bulan dan tahun yang tersedia
        const months = [
            "2025-10",
            "2025-11",
            "2025-12",
            "2026-01",
            "2026-02",
            "2026-03",
            "2026-04",
            "2026-05",
            "2026-06",
            "2026-07",
            "2026-08",
            "2026-09",
            "2026-10",
            "2026-11",
            "2026-12"
        ];

        // Event dari server (bisa diambil dari API atau langsung dari Blade)
        const events = {
        "2025-10-20": [
        "Minum Obat Paracetamol 3x",
        "Minum Obat IbuProfen 2x",
        "Minum Obat Bodrexin 1x",
        "Minum Obat Antasida 1X"
        ],
        "2026-01-01": ["Tahun Baru"]
        };

        // Fungsi untuk render kalender
        function renderCalendar() {
            const container = document.getElementById("calendar");
            container.innerHTML = "";

            // Dapatkan bulan dan tahun saat ini
            const [year, month] = currentMonth.split("-");
            const startDate = new Date(year, month - 1, 1);
            const endDate = new Date(year, month, 0);

            // Mendapatkan hari pertama dan jumlah hari
            const firstDay = startDate.getDay();
            const daysInMonth = endDate.getDate();

            // Buat blok kalender
            const monthDiv = document.createElement("div");
            monthDiv.className = "month-block";

            const monthTitle = document.createElement("h2");
            const dateObj = new Date(year, month - 1);
            monthTitle.innerText = dateObj.toLocaleString("id-ID", { month: "long", year: "numeric" });
            monthDiv.appendChild(monthTitle);

            // Buat tabel
            const table = document.createElement("table");
            table.className = "month-table";

            // Header
            const thead = document.createElement("thead");
            const headerRow = document.createElement("tr");
            ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"].forEach(day => {
                const th = document.createElement("th");
                th.innerText = day;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            table.appendChild(thead);

            // Body
            const tbody = document.createElement("tbody");

            const totalCells = firstDay + daysInMonth;
            const rows = Math.ceil(totalCells / 7);

            for (let r = 0; r < rows; r++) {
                const tr = document.createElement("tr");
                for (let c = 0; c < 7; c++) {
                    const cellIndex = r * 7 + c;
                    const td = document.createElement("td");
                    if (cellIndex < firstDay || cellIndex >= totalCells) {
                        // Cell kosong
                        td.innerHTML = "";
                    } else {
                        const dayNumber = cellIndex - firstDay + 1;
                        const dateStr = `${year}-${String(month).padStart(2, "0")}-${String(dayNumber).padStart(2, "0")}`;
                        // Tampilkan tanggal
                        const dateDiv = document.createElement("div");
                        dateDiv.className = "date";
                        dateDiv.innerText = dayNumber;
                        td.appendChild(dateDiv);

                        // Tampilkan event
                        const dayEvents = events[dateStr] || [];
                        dayEvents.forEach(ev => {
                            const evDiv = document.createElement("div");
                            evDiv.className = "event";
                            evDiv.innerText = ev;
                            td.appendChild(evDiv);
                        });
                    }
                    tr.appendChild(td);
                }
                tbody.appendChild(tr);
            }

            table.appendChild(tbody);
            monthDiv.appendChild(table);
            container.appendChild(monthDiv);
        }

        // Navigasi
        document.getElementById("prevBtn").addEventListener("click", () => {
            const currentIndex = months.indexOf(currentMonth);
            if (currentIndex > 0) {
                currentMonth = months[currentIndex - 1];
                renderCalendar();
            }
        });

        document.getElementById("nextBtn").addEventListener("click", () => {
            const currentIndex = months.indexOf(currentMonth);
            if (currentIndex < months.length - 1) {
                currentMonth = months[currentIndex + 1];
                renderCalendar();
            }
        });

        // Render awal
        renderCalendar();
    </script>
</body>
</html>