<?php
$matkul = [
    ['nama' => 'Pemrograman Web', 'sks' => 3, 'nilai' => 88],
    ['nama' => 'Basis Data', 'sks' => 3, 'nilai' => 76],
    ['nama' => 'Struktur Data', 'sks' => 3, 'nilai' => 91],
    ['nama' => 'Matematika Diskrit', 'sks' => 2, 'nilai' => 65],
    ['nama' => 'Jaringan Komputer', 'sks' => 1, 'nilai' => 42],
];

function hitungBobot(float|int $nilai): array
{
    if ($nilai >= 80) return ['huruf' => 'A', 'bobot' => 4.0];
    if ($nilai >= 70) return ['huruf' => 'B', 'bobot' => 3.0];
    if ($nilai >= 60) return ['huruf' => 'C', 'bobot' => 2.0];
    if ($nilai >= 50) return ['huruf' => 'D', 'bobot' => 1.0];
    return ['huruf' => 'E', 'bobot' => 0.0];
}

$totalSks = 0;
$totalMutu = 0.0;
$hasil = [];
foreach ($matkul as $item) {
    $nilai = max(0, min(100, (float) $item['nilai']));
    $konversi = hitungBobot($nilai);
    $status = $konversi['bobot'] >= 2.0 ? 'LULUS' : 'MENGULANG';
    $totalSks += (int) $item['sks'];
    $totalMutu += (int) $item['sks'] * $konversi['bobot'];
    $hasil[] = [...$item, 'nilai' => $nilai, ...$konversi, 'status' => $status];
}
$ips = $totalSks > 0 ? $totalMutu / $totalSks : 0;
$batasSks = $ips >= 3.00 ? 24 : 20;
$formatNilai = static fn(float $nilai): string => rtrim(rtrim(number_format($nilai, 2, ',', '.'), '0'), ',');
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ringkasan Nilai & IPS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="page-shell">
    <header class="topbar">
        <a class="brand" href="#" aria-label="Fathih Fitrah Ramadhan beranda"><span class="brand-mark">N</span><span class="brand-identity"><span class="brand-name">Fathih Fitrah Ramadhan</span><span class="student-id">NIM 3337250024</span></span></a>
        <span class="semester-pill"><span class="live-dot"></span> SEMESTER BERJALAN</span>
    </header>

    <section class="intro">
        <div class="eyebrow"><span class="eyebrow-line"></span> AKADEMIK · RINGKASAN</div>
        <h1>Nilai yang baik<br><span>membuka banyak jalan.</span></h1>
        <p>Rekap hasil belajar dan rencanakan beban SKS semester berikutnya.</p>
    </section>

    <section class="overview" aria-label="Ringkasan IPS">
        <article class="score-card">
            <div class="score-top"><span class="score-label">INDEKS PRESTASI SEMESTER</span><span class="score-icon">↗</span></div>
            <div class="score-value"><?= number_format($ips, 2, ',', '.') ?><span>/ 4,00</span></div>
            <div class="score-foot"><span class="score-dot"></span> Performa semester ini</div>
            <div class="score-decoration" aria-hidden="true"></div>
        </article>
        <article class="stat-card"><div class="stat-icon icon-blue">▤</div><div><span class="stat-label">Total mata kuliah</span><strong><?= count($hasil) ?><small> mata kuliah</small></strong></div></article>
        <article class="stat-card"><div class="stat-icon icon-lime">◷</div><div><span class="stat-label">Total beban studi</span><strong><?= $totalSks ?><small> SKS</small></strong></div></article>
    </section>

    <section class="courses-panel">
        <div class="panel-heading"><div><div class="eyebrow">HASIL BELAJAR</div><h2>Rincian mata kuliah</h2></div><span class="course-count"><?= str_pad((string) count($hasil), 2, '0', STR_PAD_LEFT) ?> KELAS</span></div>
        <div class="table-wrap"><table>
            <thead><tr><th>MATA KULIAH</th><th>SKS</th><th>NILAI ANGKA</th><th>NILAI HURUF</th><th>BOBOT</th><th>STATUS</th></tr></thead>
            <tbody>
            <?php foreach ($hasil as $i => $item): ?>
                <tr class="<?= $item['status'] === 'MENGULANG' ? 'row-fail' : '' ?>">
                    <td><span class="course-index"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span><span class="course-name"><?= htmlspecialchars($item['nama'], ENT_QUOTES, 'UTF-8') ?></span></td>
                    <td><?= (int) $item['sks'] ?><span class="muted-unit"> sks</span></td>
                    <td class="number-cell"><?= $formatNilai((float) $item['nilai']) ?></td>
                    <td><span class="grade grade-<?= strtolower($item['huruf']) ?>"><?= $item['huruf'] ?></span></td>
                    <td><?= number_format($item['bobot'], 1, ',', '.') ?></td>
                    <td><span class="status status-<?= strtolower($item['status']) ?>"><span></span><?= $item['status'] ?></span></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table></div>
        <div class="panel-foot"><span><i class="legend-dot"></i> Baris merah perlu mengulang mata kuliah</span><span>Nilai dikonversi ke skala 4,00</span></div>
    </section>

    <section class="next-step"><div class="next-icon">✦</div><div class="next-copy"><span>RENCANA SEMESTER DEPAN</span><h2>Kamu bisa mengambil hingga <strong><?= $batasSks ?> SKS</strong></h2><p><?= $ips >= 3.00 ? 'IPS kamu mencapai 3,00. Maksimalkan kesempatan belajarmu.' : 'Batas beban studi mengikuti IPS semester ini.' ?></p></div><div class="next-badge">IPS <?= $ips >= 3.00 ? '≥' : '<' ?> 3,00</div></section>
    <footer><span>Semangat terus, satu langkah setiap hari.</span><span>NilaiKita <b>·</b> 2026</span></footer>
</main>
</body>
</html>




