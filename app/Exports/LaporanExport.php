<?php

namespace App\Exports;

use App\Models\LaporanHarian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaporanExport implements FromCollection, WithMapping, WithEvents, WithCustomStartCell
{
    protected $rowNumber = 1; // Menggunakan nama variabel lebih deskriptif
    protected $statistikKategori = [];
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function startCell(): string
    {
        return 'A5'; // Data tabel dimulai dari baris ke-5
    }

    public function collection()
    {
        $data = LaporanHarian::with(['unit', 'teknisi', 'statusTiket', 'faktorMasalah', 'shift'])
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        // Kalkulasi statistik dengan pengecekan data kosong
        if ($data->isNotEmpty()) {
            $this->statistikKategori = $data->groupBy('faktorMasalah.name')
                ->map->count()
                ->toArray();
        }

        return $data;
    }

    public function map($laporan): array
    {
        return [
            $this->rowNumber++,
            \Carbon\Carbon::parse($laporan->tanggal)->format('d-m-Y'),
            $laporan->shift->name ?? '-',
            $laporan->unit->name ?? '-',
            $laporan->masalah,
            $laporan->teknisi->name ?? '-',
            $laporan->statusTiket->name ?? '-',
            $laporan->faktorMasalah->name ?? '-',
            $laporan->nama_pelapor ?? '-',
            $laporan->tindak_lanjut ?? '-',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // 1. Logo
                $drawing = new Drawing();
                $drawing->setName('Logo');
                $drawing->setPath(public_path('image/logo-rs.png'));
                $drawing->setHeight(50);
                $drawing->setCoordinates('A1');
                $drawing->setOffsetY(10); // Menambah jarak ke bawah dari top cell
                $drawing->setWorksheet($sheet);

                // 2. Judul (Kop) - Kita buat lebih rapi
                $sheet->mergeCells('A1:J3');
                $sheet->setCellValue('A1', "LAPORAN HARIAN KEGIATAN IT\nRS MITRA HUSADA");
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('A1')->getAlignment()->setWrapText(true);

                // 3. Header Tabel (Pindahkan ke baris 4)
                $headers = ['No', 'Hari & Tanggal', 'Shift', 'Unit', 'Masalah/Kegiatan', 'Teknisi IT', 'Status', 'Faktor', 'Pelapor', 'Keterangan'];
                $sheet->fromArray($headers, NULL, 'A4');
                $sheet->getStyle('A4:J4')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D3D3D3']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
                ]);

                // Dapatkan baris terakhir data (data mulai dari baris 5 karena startCell A5)
                $lastDataRow = $sheet->getHighestRow();

                // 4. Ringkasan di bawah data
                $summaryRow = $lastDataRow + 2;
                $sheet->setCellValue('A' . $summaryRow, "RINGKASAN LAPORAN");
                $sheet->getStyle('A' . $summaryRow)->getFont()->setBold(true);

                $sheet->setCellValue('A' . ($summaryRow + 1), "Total Kasus:");
                $sheet->setCellValue('B' . ($summaryRow + 1), ($this->rowNumber - 1));

                // 5. Statistik Kategori
                $catRow = $summaryRow + 3;
                $sheet->setCellValue('A' . $catRow, "Statistik Kategori Masalah:");
                $sheet->getStyle('A' . $catRow)->getFont()->setBold(true);

                $i = 1;
                foreach ($this->statistikKategori as $kategori => $jumlah) {
                    $sheet->setCellValue('A' . ($catRow + $i), $kategori);
                    $sheet->setCellValue('B' . ($catRow + $i), $jumlah);
                    $i++;
                }

                // 6. Border & Formatting Akhir
                $sheet->getStyle('A4:J' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                foreach (range('A', 'J') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
