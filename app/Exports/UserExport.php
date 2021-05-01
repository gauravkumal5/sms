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
        return User::select(['name','username','roll_no','password','gender','dob','address','contact','class'])->get();
    }
    public function headings():array{
        return[
            'name',
            'username',
            'roll_no',
            'password',
            'gender',
            'dob',
            'address',
            'contact',
            'class'];
            
        
    }
}