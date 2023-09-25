<?php

namespace App\Exports;

use App\Models\Penilaianta;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenilaianExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function collection()
    {
        if (Auth::user()->role->title=='Mahasiswa'){
            if (Request::segment(2)=='exportta_2') {
                return Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.mahasiswa_id', Auth::user()->id)            
                    ->where('penilaiantas.status', 'TA 2')
                    ->select('penilaiantas.*', 'users.name as mahasiswa', 'prodis.title as prodi', 'pengajuanjuduls.judul as judul')
                    ->get();
            } else {            
                return Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.mahasiswa_id', Auth::user()->id)            
                    ->where('penilaiantas.status', 'TA 1')
                    ->select('penilaiantas.*', 'users.name as mahasiswa', 'prodis.title as prodi', 'pengajuanjuduls.judul as judul')
                    ->get();
            }
        } elseif (Auth::user()->role->title=='Koordinator') {
            if (Request::segment(2)=='exportta_2') {
                return Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.prodi_id', Auth::user()->prodi_id)
                    ->where('penilaiantas.status', 'TA 2')
                    ->select('penilaiantas.*', 'users.name as mahasiswa', 'prodis.title as prodi', 'pengajuanjuduls.judul as judul')
                    ->get();
            } else {            
                return Penilaianta::join('users', 'penilaiantas.mahasiswa_id', 'users.id')
                    ->join('pengajuanjuduls', 'penilaiantas.pengajuanjudul_id', 'pengajuanjuduls.id')
                    ->join('prodis', 'penilaiantas.prodi_id', 'prodis.id')
                    ->where('penilaiantas.prodi_id', Auth::user()->prodi_id)
                    ->where('penilaiantas.status', 'TA 1')
                    ->select('penilaiantas.*', 'users.name as mahasiswa', 'prodis.title as prodi', 'pengajuanjuduls.judul as judul')
                    ->get();
            }
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A:J' => ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]],
        ];
    }

    public function headings(): array
    {
        if(Request::segment(2)=='exportta_2'){
            return [
                'NAMA',
                'PRODI',
                'STATUS',
                'JUDUL',
                'NILAI PRA SIDANG',
                'NILAI SIDANG',
                'NILAI PEMBIMBING',
                'NILAI ADMINISTRASI',
                'TOTAL NILAI',
                'GRADE'
            ];
        } else {
            return [
                'NAMA',
                'PRODI',
                'STATUS',
                'JUDUL',
                'NILAI SEMPRO',
                'NILAI SEMINAR',
                'NILAI PEMBIMBING',
                'NILAI ADMINISTRASI',
                'TOTAL NILAI',
                'GRADE'
            ];
        }
    }

    public function map($penilaianta): array
    {
        return [
            $penilaianta->mahasiswa,
            $penilaianta->prodi,
            $penilaianta->status,
            $penilaianta->judul,
            $penilaianta->nilai_1,
            $penilaianta->nilai_2,
            $penilaianta->nilai_3,
            $penilaianta->nilai_4,
            $penilaianta->total_nilai,
            $penilaianta->grade,
        ];
    }
}
