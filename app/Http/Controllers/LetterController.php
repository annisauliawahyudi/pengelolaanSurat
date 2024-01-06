<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Letter;
use App\Models\Letter_type;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $letters = Letter::query();

        if ($search) {
            // Sesuaikan dengan kolom yang ingin Anda cari
            $letters->where('letter_perihal', 'like', '%' . $search . '%')
                    ->orWhere('recipients', 'like', '%' . $search . '%');
        }

        $letters = $letters->orderBy('id', 'ASC')->paginate(10);

        return view('data_surat.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tambahkan logika jika diperlukan untuk tampilan tambah surat
        $lettertypes = Letter_type::with('letter')->get();
        $users = User::all();
        $gurus = User::where('role','guru')->get();

        return view('data_surat.create', compact('lettertypes', 'users', 'gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Tambahkan logika untuk menyimpan data surat yang baru dibuat
    //     $request->validate([
    //         'letter_type_id' => 'required|alpha_num',
    //         'letter_perihal' => 'required',
    //         'content' => 'required',
    //         'recipients' => 'required',
    //         // 'attachment' => 'required',
    //         'notulis' => 'required',
    // ],

    // [
    //     'letter_type_id.required' => 'Kode Surat harus diisi!',
    //     'letter_type_id.alpha_num' => 'Kode Surat hanya boleh berisi huruf dan angka!',
    //     'letter_perihal.required' => 'Perihal Surat harus diisi!',
    //     'content.required' => 'isi Surat harus diisi!',
    //     'recipients.required' => 'Penerima Surat harus diisi!',
    //     // 'attachment.required' => 'Perihal Surat harus diisi!',
    //     'notulis.required' => 'notulis Surat harus diisi!',
    // ]);

    //     Letter::create([
    //         'letter_type_id' => $request->letter_type_id,
    //         'letter_perihal' => $request->letter_perihal,
    //         'recipients' => $request->recipients,
    //         'content' => $request->content,
    //         // 'attachment' => $request->attachment,
    //         'notulis' => $request->notulis
    //     ]);

    //     return redirect()->route('letter.index')->with('success', 'Surat berhasil ditambahkan');
    // }

    public function store(Request $request)
{
    // Validasi dan proses lainnya ...
    $request->validate([
        'letter_perihal' => 'required',
        'letter_type_id' => 'required|exists:letter_types,id',
        'content' => 'required',
        'recipients' => 'required',
        // 'attachment' => 'file|image',
        'notulis' => 'required|exists:users,id',
    ]);

    // Ambil data guru yang dipilih dari input 'recipients'
    $selectedRecipients = $request->input('recipients');

    // Konversi array guru yang dipilih menjadi format JSON
    $recipientsJson = json_encode($selectedRecipients);

    // Check if an attachment file has been uploaded
    if ($request->hasFile('attachment')) {
        // Store the attachment file and get its path
        $attachmentPath = $request->file('attachment')->store('attachment-images');
    
        // Simpan ke database dan ambil ID letter yang baru dibuat
        $newLetter = Letter::create([
            'letter_perihal' => $request->letter_perihal,
            'letter_type_id' => $request->letter_type_id,
            'content' => $request->content,
            'recipients' => $recipientsJson,
            // 'attachment' => $attachmentPath,
            'notulis' => $request->notulis,
            // 'meeting_minutes_status' => 'Belum Dibuat',
        ]);
    
        // Ambil ID letter yang baru dibuat
        $newLetterId = $newLetter->id;
    
    } else {
        // Handle the case when no attachment file is uploaded
        $newLetterId = Letter::create([
            'letter_perihal' => $request->letter_perihal,
            'letter_type_id' => $request->letter_type_id,
            'content' => $request->content,
            'recipients' => $recipientsJson,
            'notulis' => $request->notulis,
            // 'meeting_minutes_status' => 'Belum Dibuat',
        ])->id;
    }
    
    return redirect()->route('letter.index', ['id' => $newLetterId])->with('success', 'Berhasil menambahkan Surat');
}

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        // Tampilkan detail surat
        return view('data_surat.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter, $id)
    {
        // Tambahkan logika jika diperlukan untuk tampilan edit surat
        
        $letter = Letter::where('id', $id)->first();
        return view('data_surat.edit', compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Letter $id)
{
    // Validasi dan proses lainnya ...
    $request->validate([
        'letter_perihal' => 'required',
        'letter_type_id' => 'required|exists:letter_types,id',
        'content' => 'required',
        'recipients' => 'required',
        'notulis' => 'required|exists:users,id',
    ]);

    // Ambil data guru yang dipilih dari input 'recipients'
    $selectedRecipients = $request->input('recipients');

    // Konversi array guru yang dipilih menjadi format JSON
    $recipientsJson = json_encode($selectedRecipients);

    // Update data surat
    Letter::where('id', $id)->update([
        'letter_perihal' => $request->letter_perihal,
        'letter_type_id' => $request->letter_type_id,
        'content' => $request->content,
        'recipients' => $recipientsJson,
        'notulis' => $request->notulis,
    ]);

    // Redirect ke halaman index surat dengan pesan sukses
    return redirect()->route('letter.index')->with('success', 'Surat berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter, $id)
    {
        // Tambahkan logika untuk menghapus data surat
        
        Letter::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Surat berhasil dihapus');
    }
}
