<?php

namespace App\Http\Controllers;

use App\Models\letter_type;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exports\dataExport;
use Excel;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');
        // Query to fetch letter types based on search criteria
        $query = letter_type::with('letter');

        if (!empty($search)) {
            $query->where('letter_code', 'like', '%' . $search . '%')
                ->orWhere('name_type', 'like', '%' . $search . '%');
        }
        $letter_type = $query->simplePaginate(3);
        return view('letter_type.index', compact('letter_type'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('letter_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_code' => 'required|alpha_num',
            'name_type' => 'required',
    ],

    [
        'letter_code.required' => 'Kode Surat harus diisi!',
        'letter_code.alpha_num' => 'Kode Surat hanya boleh berisi huruf dan angka!',
        'name_type.required' => 'Klasifikasi Surat harus diisi!',
    ]);

       $contLetter = letter_type::count();

        letter_type::create([
            'letter_code' => $request->letter_code . '-' . $contLetter + 1,
            'name_type' => $request->name_type
        ]);

        return redirect()->route('letter_type.index')->with('success', 'Berhasil menambahkan data!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(letter_type $letter_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(letter_type $letter_type, $id)
    {
        // $letter_type = letter_type::find($id)->first();

        // return view('letter_type.edit', ['letter_type'=> $letter_type]);
        $letter_type = letter_type::where('id', $id)->first();

        return view('letter_type.edit', compact('letter_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, letter_type $letter_type, $id)
    {
        $request->validate([
	        
	        'name_type' => 'required',
        ]);

        letter_type::where('id', $id)->update([
            
            'name_type'=>$request->name_type
        ]);

        // letter_type::find($id)->update($data);
        
        return redirect()->route('letter_type.index')->with('success', 'Berhasil mengubah data!');
        // $request->validate([
	    //     'letter_code' => 'required|numeric',
	    //     'name_type' => 'required',   
        // ]);

        // letter_type::where('id', $id)->update([
        //     'letter_code'=>$request->letter_code,
        //     'name_type'=>$request->name_type
        // ]);

        // return redirect()->route('leter_type')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(letter_type $letter_type, $id)
    {
        letter_type::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function searchLetter(Request $request)
    {

        if ($request->has('search_letter')) {
                $searchTerm = $request->input('search_letter');
                $results->whereDate('search_letter', $searchTerm);
            }

        // Perform the search using the LIKE operator in the SQL query
        $results = letter_type::where('letter_code', 'LIKE', "%$searchTerm%")
                    ->orWhere('name_type', 'LIKE', "%$searchTerm%")
                    ->get();

        // You can customize this based on your search requirements and fields

        return view('search_results', compact('results'));
    }

    public function exportExcel()
    {
        $file_name = 'Klasifikasi Surat'.'.xlsx';

        return Excel::download(new dataExport, $file_name);
    }

    public function detai()
    {
        return view('letter_type.detail');
    }

    
}
