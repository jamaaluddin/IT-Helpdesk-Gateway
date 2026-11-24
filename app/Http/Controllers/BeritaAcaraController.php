<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeritaAcaraController extends Controller
{
    /**
     * Menampilkan daftar Berita Acara.
     */
    public function index(Request $request)
    {
        $query = BeritaAcara::with('creator');

        // Pencarian dokumen
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('document_number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('document_type', 'like', "%{$search}%");
            });
        }

        // Filter jenis dokumen
        if ($request->filled('type')) {
            $query->where('document_type', $request->type);
        }

        // Filter tanggal awal
        if ($request->filled('start_date')) {
            $query->whereDate(
                'document_date',
                '>=',
                $request->start_date
            );
        }

        // Filter tanggal akhir
        if ($request->filled('end_date')) {
            $query->whereDate(
                'document_date',
                '<=',
                $request->end_date
            );
        }

        $documents = $query
            ->latest('document_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $documentTypes = BeritaAcara::select('document_type')
            ->distinct()
            ->orderBy('document_type')
            ->pluck('document_type');

        return view('it-support.berita-acara.index', compact(
            'documents',
            'documentTypes'
        ));
    }

    /**
     * Menampilkan form tambah dokumen.
     */
    public function create()
    {
        return view('it-support.berita-acara.create');
    }

    /**
     * Menyimpan dokumen baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document_type' => 'required|string|max:100',
            'document_date' => 'required|date',
            'content' => 'required|string',

            'related_parties' => 'nullable|array',
            'signature_blocks' => 'nullable|array',
        ]);

        $document = DB::transaction(function () use ($validated) {
            $year = date(
                'Y',
                strtotime($validated['document_date'])
            );

            $prefix = "BA-GW-{$year}-";

            $latestDocument = BeritaAcara::where(
                'document_number',
                'like',
                $prefix . '%'
            )
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            $lastNumber = 0;

            if ($latestDocument) {
                $lastNumber = (int) substr(
                    $latestDocument->document_number,
                    -4
                );
            }

            $nextNumber = str_pad(
                $lastNumber + 1,
                4,
                '0',
                STR_PAD_LEFT
            );

            return BeritaAcara::create([
                'document_number' => $prefix . $nextNumber,
                'title' => $validated['title'],
                'document_type' => $validated['document_type'],
                'document_date' => $validated['document_date'],
                'content' => $validated['content'],
                'related_parties' => $validated['related_parties'] ?? null,
                'signature_blocks' => $validated['signature_blocks'] ?? null,
                'created_by' => auth()->id(),
            ]);
        });

        return redirect()
            ->route('it-support.berita-acara.show', $document)
            ->with('success', 'Berita Acara berhasil dibuat.');
    }

    /**
     * Menampilkan detail dokumen.
     */
    public function show(BeritaAcara $beritaAcara)
    {
        $beritaAcara->load('creator');

        return view(
            'it-support.berita-acara.show',
            compact('beritaAcara')
        );
    }

    /**
     * Menampilkan form edit dokumen.
     */
    public function edit(BeritaAcara $beritaAcara)
    {
        return view(
            'it-support.berita-acara.edit',
            compact('beritaAcara')
        );
    }

    /**
     * Memperbarui dokumen.
     */

    public function update(Request $request, BeritaAcara $beritaAcara)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document_type' => 'required|string|max:100',
            'document_date' => 'required|date',
            'content' => 'required|string',
            'related_parties' => 'nullable|array',
            'signature_blocks' => 'nullable|array',
        ]);

        $validated['related_parties'] = $validated['related_parties'] ?? null;
        $validated['signature_blocks'] = $validated['signature_blocks'] ?? null;

        $beritaAcara->update($validated);

        return redirect()
            ->route('it-support.berita-acara.show', $beritaAcara)
            ->with('success', 'Berita Acara berhasil diperbarui.');
    }


    /**
     * Menghapus dokumen.
     */
    public function destroy(BeritaAcara $beritaAcara)
    {
        $beritaAcara->delete();

        return redirect()
            ->route('it-support.berita-acara.index')
            ->with('success', 'Berita Acara berhasil dihapus.');
    }
}
