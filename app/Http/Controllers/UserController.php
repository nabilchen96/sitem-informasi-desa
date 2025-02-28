<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users.index');
    }

    public function data()
    {

        $user = DB::table('users')->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'email' => 'unique:users',
            'no_wa' => 'unique:users',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'Aktif'
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $user = User::find($request->id);
            $data = $user->update([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = User::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }

    public function exportExcel()
    {
        // Ambil data dari database
        $data = DB::table('users')
            ->leftJoin('profils', 'profils.id_user', '=', 'users.id')
            ->leftJoin('unit_kerjas', 'unit_kerjas.id', '=', 'profils.id_unit_kerja')
            ->leftJoin('skpds', 'skpds.id', '=', 'unit_kerjas.id_skpd')
            ->get([
                'users.*',
                'profils.created_at',
                'profils.status_pegawai',
                'profils.nip',
                'profils.nik',
                'profils.jenis_kelamin',
                'profils.tempat_lahir',
                'profils.status_pegawai',
                'profils.pangkat',
                'profils.jabatan',
                'skpds.nama_skpd',
                'unit_kerjas.unit_kerja'
            ]);

        // Buat instance baru dari Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Tambahkan judul kolom
        $headerColumns = [
            'A1' => '#',
            'B1' => 'NAMA',
            'C1' => 'EMAIL',
            'D1' => 'NO WA',
            'E1' => 'ROLE',
            'F1' => 'STATUS',
            'G1' => 'NIP',
            'H1' => 'NIK',
            'I1' => 'JENIS KELAMIN',
            'J1' => 'TEMPAT LAHIR',
            'K1' => 'STATUS PEGAWAI',
            'L1' => 'PANGKAT',
            'M1' => 'JABATAN',
            'N1' => 'SKPD',
            'O1' => 'UNIT KERJA',
            'P1' => 'TGL DIBUAT'
        ];
        foreach ($headerColumns as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        // Tambahkan styling untuk header
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ]
        ];
        $sheet->getStyle('A1:P1')->applyFromArray($headerStyle);

        // Tambahkan data dari database ke spreadsheet
        $row = 2;
        $totalRows = $data->count();
        foreach ($data as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->name);
            $sheet->setCellValue('C' . $row, $item->email);
            $sheet->setCellValue('D' . $row, $item->no_wa);
            $sheet->setCellValue('E' . $row, $item->role);
            $sheet->setCellValue('F' . $row, $item->status_pegawai);
            $sheet->setCellValue('G' . $row, "`$item->nip");
            $sheet->setCellValue('H' . $row, "`$item->nik");
            $sheet->setCellValue('I' . $row, $item->jenis_kelamin);
            $sheet->setCellValue('J' . $row, $item->tempat_lahir);
            $sheet->setCellValue('K' . $row, $item->status_pegawai);
            $sheet->setCellValue('L' . $row, $item->status_pegawai == 'Honorer' ? '' : $item->pangkat);
            $sheet->setCellValue('M' . $row, $item->status_pegawai == 'Honorer' ? '' : $item->jabatan);
            $sheet->setCellValue('N' . $row, $item->nama_skpd);
            $sheet->setCellValue('O' . $row, $item->unit_kerja);
            $sheet->setCellValue('P' . $row, $item->created_at);

            // Terapkan garis pada setiap baris kecuali baris terakhir
            $sheet->getStyle("A$row:P$row")->applyFromArray([
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                ]
            ]);

            $row++;
        }

        // Otomatis menyesuaikan lebar kolom
        foreach (range('A', 'P') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Buat writer untuk menulis file Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'user.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Tulis file ke lokasi sementara
        $writer->save($temp_file);

        // Berikan respon file kepada pengguna
        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
    public function importExcel(Request $request)
    {
        // Validasi input file
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        // Ambil file yang diunggah
        $file = $request->file('file');

        // Baca file menggunakan PhpSpreadsheet
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true); // Kunci kolom asosiatif untuk lebih aman

        $successCount = 0;
        $failCount = 0;

        foreach ($rows as $index => $row) {
            if ($index == 1)
                continue;  // Lewati header

            // Lewati baris kosong: cek kolom yang relevan
            if (empty(trim($row['A'])) && empty(trim($row['B'])) && empty(trim($row['C'])) && empty(trim($row['D']))) {
                continue;
            }

            // Periksa duplikat berdasarkan email atau no_wa
            $existingUser = User::where('email', $row['B'])
                ->orWhere('no_wa', $row['C'])
                ->first();

            if ($existingUser) {
                $failCount++;  // Tambahkan ke hitungan gagal
                continue;
            }

            try {
                // Simpan data baru ke database
                $data = User::create([
                    'name' => trim($row['A']),
                    'email' => trim($row['B']),
                    'no_wa' => trim($row['C']),
                    'password' => Hash::make(trim($row['D'])),  // Hashing password
                    'role' => 'Pegawai',
                    'id_creator' => Auth::id()
                ]);

                Profil::create([
                    'nip' => trim($row['E']),
                    'nik' => trim($row['F']),
                    'jenis_kelamin' => trim($row['G']),
                    'tempat_lahir' => trim($row['H']),
                    'tanggal_lahir' => trim($row['I']),
                    'alamat' => trim($row['J']),
                    'id_user' => $data->id,
                    'status_pegawai' => trim($row['K']) == 'Non ASN' ? 'Honorer' : trim($row['K']),
                    'pangkat' => trim($row['L']) == 'Tidak Memiliki Pangkat' ? NULL : trim($row['L']),
                    'jabatan' => trim($row['M'])
                ]);

                $successCount++;
            } catch (\Exception $e) {
                $failCount++;
            }
        }

        return response()->json([
            'message' => 'Proses import selesai.',
            'success_count' => $successCount,
            'fail_count' => $failCount
        ]);
    }

}
