<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pod;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan sudah install barryvdh/laravel-dompdf
use Maatwebsite\Excel\Facades\Excel; // pastikan sudah install maatwebsite/excel
use App\Exports\PodsExport;

class PodController extends Controller
{
    /** ==============================
     *  INDEX + FILTER + SEARCH
     *  ============================== */
    public function index(Request $request)
    {
        $query = Pod::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_pod', 'like', "%$search%")
                    ->orWhere('departemen', 'like', "%$search%")
                    ->orWhere('jenis_pod', 'like', "%$search%")
                    ->orWhere('tipe_pod', 'like', "%$search%")
                    ->orWhere('kategori_perawatan', 'like', "%$search%")
                    ->orWhere('lokasi', 'like', "%$search%");
            });
        }

        if ($request->filled('filter_jenis')) {
            $query->where('jenis_pod', $request->filter_jenis);
        }

        $pods = $query->orderBy('created_at', 'desc')->paginate(10);
        $pods->appends($request->all());

        // generate kode otomatis
        $lastPod = Pod::latest()->first();
        $lastNumber = 0;
        if ($lastPod && preg_match('/POD-(\d+)/', $lastPod->nomor_pod, $matches)) {
            $lastNumber = (int) $matches[1];
        }
        $kodeAuto = 'POD-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return view('pods.index', compact('pods', 'kodeAuto'));
    }

    /** ==============================
     *  STORE DATA (dengan upload foto opsional)
     *  ============================== */
    public function store(Request $request)
    {
        $request->validate([
            'kode_auto' => 'required',
            'kode_manual' => 'required',
            'tanggal' => 'required|date',
            'jenis_pod' => 'required',
            'kategori_perawatan' => 'required|string|max:255',
            'tipe_pod' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'daftar_pekerjaan' => 'required|string',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $nomor_pod = $request->kode_auto . '-' . $request->kode_manual;

        $data = [
            'nomor_pod' => $nomor_pod,
            'tanggal' => $request->tanggal,
            'jenis_pod' => $request->jenis_pod,
            'kategori_perawatan' => $request->kategori_perawatan,
            'tipe_pod' => $request->tipe_pod,
            'departemen' => $request->departemen,
            'lokasi' => $request->lokasi,
            'daftar_pekerjaan' => $request->daftar_pekerjaan,
            'uraian' => $request->uraian,
            'dibuat_oleh' => auth()->user()->name,
        ];

        // ✅ Upload lampiran jika ada
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pods'), $filename);
            $data['lampiran'] = $filename;
        }

        Pod::create($data);

        return redirect()->route('pods')->with('success', 'Plan of Development berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pod = Pod::findOrFail($id);
        return view('pods.show', compact('pod'));
    }

    public function edit($id)
    {
        $pod = Pod::findOrFail($id);
        return view('pods.edit', compact('pod'));
    }

    /** ==============================
     *  UPDATE DATA (dengan update foto opsional)
     *  ============================== */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pod' => 'required',
            'kategori_perawatan' => 'required|string|max:255',
            'tipe_pod' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'daftar_pekerjaan' => 'required|string',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pod = Pod::findOrFail($id);

        $data = [
            'tanggal' => $request->tanggal,
            'jenis_pod' => $request->jenis_pod,
            'kategori_perawatan' => $request->kategori_perawatan,
            'tipe_pod' => $request->tipe_pod,
            'departemen' => $request->departemen,
            'lokasi' => $request->lokasi,
            'daftar_pekerjaan' => $request->daftar_pekerjaan,
            'uraian' => $request->uraian,
        ];

        // ✅ Ganti lampiran jika upload baru
        if ($request->hasFile('lampiran')) {
            if ($pod->lampiran && file_exists(public_path('uploads/pods/' . $pod->lampiran))) {
                unlink(public_path('uploads/pods/' . $pod->lampiran));
            }

            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pods'), $filename);
            $data['lampiran'] = $filename;
        }

        $pod->update($data);

        return redirect()->route('pods')->with('success', 'Plan of Development berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pod = Pod::findOrFail($id);

        // Hapus file lampiran juga (opsional)
        if ($pod->lampiran && file_exists(public_path('uploads/pods/' . $pod->lampiran))) {
            unlink(public_path('uploads/pods/' . $pod->lampiran));
        }

        $pod->delete();

        return redirect()->route('pods')->with('success', 'Plan of Development berhasil dihapus!');
    }

    /** ==============================
     *  EXPORT PDF
     *  ============================== */
    public function exportPdf()
    {
        $pods = Pod::orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('pods.export_pdf', compact('pods'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('Data_POD.pdf');
    }

    /** ==============================
     *  EXPORT EXCEL
     *  ============================== */
    public function exportExcel()
    {
        return Excel::download(new PodsExport, 'Data_POD.xlsx');
    }
}