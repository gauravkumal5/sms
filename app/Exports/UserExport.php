<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();
        return User::select(['name','roll_no','email','password','gender','dob','address','contact','class'])->get();
    }
    public function headings():array{
        return[
            'name',
            'roll_no',
            'email',
            'gender',
            'dob',
            'address',
            'contact',
            'class'];
            
        
    }
}