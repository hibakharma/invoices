<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        return Invoice::all();
    }
}
