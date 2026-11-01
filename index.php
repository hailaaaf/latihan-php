<?php
// ============================================================
// Latihan Individu PHP - Daftar Nilai Mata Kuliah
// ============================================================

// 1. Array multidimensi berisi minimal 5 mata kuliah
$matkul = [
    ["nama" => "Algoritma dan Pemrograman", "sks" => 3, "nilai" => 90],
    ["nama" => "Basis Data",                "sks" => 3, "nilai" => 84],
    ["nama" => "Statistika",                "sks" => 2, "nilai" => 58],
    ["nama" => "Sistem Operasi",            "sks" => 3, "nilai" => 78],
    ["nama" => "Bahasa Inggris",            "sks" => 2, "nilai" => 85],
    ["nama" => "Etika Profesi",             "sks" => 2, "nilai" => 88],
];

// 2. Fungsi helper: mengubah nilai angka menjadi huruf dan bobot
function hitungBobot($nilai)
{
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

// Perhitungan total SKS dan total mutu
$totalSks  = 0;
$totalMutu = 0;

foreach ($matkul as $mk) {
    $hasil = hitungBobot($mk["nilai"]);
    $totalSks  += $mk["sks"];
    $totalMutu += $hasil["bobot"] * $mk["sks"];
}

// Hitung IPS
$ips = $totalSks > 0 ? $totalMutu / $totalSks : 0;

// Batas maksimal SKS semester depan
if ($ips >= 3.00) {
    $maksSks = 24;
} else {
    $maksSks = 20;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai Mata Kuliah</title>
    <style>
        :root {
            --pink:      #f4b0b0;
            --pink-dark: #c97878;
            --pink-soft: #fbe3e3;
            --gray-bg:   #f3f3f3;
            --gray-box:  #f3f3f3;
            --gray-line: #1f1f1f;
            --gray-text: #6b6b6b;
            --ink:       #2b2b33;
            --white:     #ffffff;
            --red-bg:    #f9c9c9;
            --red-tx:    #b3001b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 40px 16px;
            font-family: "Segoe UI", Tahoma, Arial, sans-serif;
            background: var(--gray-bg);
            color: var(--ink);
        }

        .card {
            max-width: 860px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 14px;
            border-top: 6px solid var(--pink);
            padding: 32px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        h1 {
            margin: 0 0 4px;
            text-align: center;
            font-size: 26px;
            color: var(--ink);
        }

        .subtitle {
            margin: 0 0 24px;
            text-align: center;
            color: var(--gray-text);
            font-size: 14px;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead th {
            background: var(--pink);
            color: var(--white);
            padding: 12px 10px;
            text-align: center;
            font-weight: 700;
            border: 1px solid var(--gray-line);
        }

        tbody td {
            padding: 11px 10px;
            text-align: center;
            border: 1px solid var(--gray-line);
        }

        tbody td.left { text-align: left; }

        tbody tr { background: var(--white); }
        tbody tr:nth-child(odd) { background: var(--gray-box); }

        /* Baris MENGULANG berwarna merah */
        tbody tr.mengulang {
            background: var(--red-bg);
            color: var(--red-tx);
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge.lulus     { background: var(--pink-soft); color: var(--pink-dark); }
        .badge.mengulang { background: var(--red-tx); color: var(--white); }

        .ringkasan {
            margin-top: 24px;
            padding: 18px 22px;
            background: var(--gray-box);
            border-left: 5px solid var(--pink);
            border-radius: 10px;
            font-size: 14px;
            line-height: 1.9;
        }
        .ringkasan h2 {
            margin: 0 0 6px;
            font-size: 16px;
            color: var(--pink-dark);
        }
        .ringkasan .ips { color: var(--pink-dark); font-weight: 700; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Daftar Nilai Mata Kuliah</h1>
        <p class="subtitle">Katherina Smith &mdash; 3337250062</p>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Nilai</th>
                        <th>Nilai Huruf</th>
                        <th>Bobot</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matkul as $i => $mk): ?>
                        <?php
                            $hasil  = hitungBobot($mk["nilai"]);
                            $status = $hasil["bobot"] >= 2.0 ? "LULUS" : "MENGULANG";
                            $kelas  = $status === "MENGULANG" ? "mengulang" : "lulus";
                        ?>
                        <tr class="<?= $status === 'MENGULANG' ? 'mengulang' : '' ?>">
                            <td><?= $i + 1 ?></td>
                            <td class="left"><?= htmlspecialchars($mk["nama"]) ?></td>
                            <td><?= $mk["sks"] ?></td>
                            <td><?= $mk["nilai"] ?></td>
                            <td><?= $hasil["huruf"] ?></td>
                            <td><?= number_format($hasil["bobot"], 1) ?></td>
                            <td><span class="badge <?= $kelas ?>"><?= $status ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="ringkasan">
            <h2>Ringkasan IPS</h2>
            <div><strong>Total Mata Kuliah:</strong> <?= count($matkul) ?></div>
            <div><strong>Total SKS:</strong> <?= $totalSks ?></div>
            <div><strong>Total Mutu:</strong> <?= number_format($totalMutu, 2, ',', '.') ?></div>
            <div><strong>IPS:</strong> <span class="ips"><?= number_format($ips, 2, ',', '.') ?></span></div>
            <div><strong>Maksimal SKS Semester Berikutnya:</strong> <?= $maksSks ?> SKS</div>
        </div>
    </div>
</body>
</html>
