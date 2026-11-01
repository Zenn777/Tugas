# NilaiKita — Ringkasan Nilai & IPS

Aplikasi PHP tanpa framework untuk menampilkan nilai 5 mata kuliah, konversi huruf/bobot, status kelulusan, ringkasan IPS berbobot SKS, dan batas SKS semester berikutnya.

## Menjalankan secara lokal

Pastikan PHP 8.1+ tersedia, lalu dari folder proyek jalankan:

```bash
php -S localhost:8000
```

Buka http://localhost:8000.

## Konversi nilai

- A: 80–100 (4,0)
- B: 70–79 (3,0)
- C: 60–69 (2,0)
- D: 50–59 (1,0)
- E: di bawah 50 (0,0)

IPS dihitung sebagai jumlah (SKS × bobot) dibagi total SKS. Nilai IPS minimal 3,00 mendapat batas 24 SKS; selain itu maksimal 20 SKS.

