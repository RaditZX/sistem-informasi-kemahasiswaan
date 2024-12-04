<?php

namespace App\Http\Controllers;

use App\Models\beasiswa;
use App\Models\PenerimaBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class PenerimaBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penerima_beasiswa = PenerimaBeasiswa::All();
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();

        return view('pages.Beasiswa.pengumuman-beasiswa', compact('penerima_beasiswa', 'notificationData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notifController = new NotificationController();
        $notificationData = $notifController->getNotifData();
        return view('pages.Beasiswa.import-data-beasiswa', compact('notificationData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi file input
        $validator = Validator::make($request->all(), [
            'excelFile' => 'required|file|mimes:xlsx,csv,xls|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('excelFile');
            $penerima = (new FastExcel)->import($file, function ($line) {
                // Validasi setiap baris data
                $data = Validator::make($line, [
                    'nim' => 'required|integer',
                    'beasiswa' => 'required|string|exists:beasiswa,nama_beasiswa',
                ])->validate();

                // Ambil beasiswa_id berdasarkan nama_beasiswa
                $beasiswaID = Beasiswa::where('nama_beasiswa', '=', $data['beasiswa'])->value('id');

                if (!$beasiswaID) {
                    throw new \Exception("Beasiswa with name {$data['beasiswa']} not found.");
                }

                PenerimaBeasiswa::create([
                    'nim' => $data['nim'],
                    'beasiswa_id' => $beasiswaID,
                ]);
            });


            return response()->json([
                'success' => true,
                'message' => 'Data successfully imported',
                'data' => $penerima
            ]);
        } catch (\Throwable $e) {
            // Tangani error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during import',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(PenerimaBeasiswa $penerimaBeasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenerimaBeasiswa $penerimaBeasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenerimaBeasiswa $penerimaBeasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenerimaBeasiswa $penerimaBeasiswa)
    {
        //
    }
}
