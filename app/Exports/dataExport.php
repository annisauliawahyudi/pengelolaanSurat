<?php

namespace App\Exports;

use App\Models\Letter_type;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class dataExport implements FromView
{
    public function view(): View
    {
        $letter_types = Letter_type::all();
        return view('letter_type.tableHtml', compact('letter_types'));
    }
}