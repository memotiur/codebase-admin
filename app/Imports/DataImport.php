<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataImport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}
