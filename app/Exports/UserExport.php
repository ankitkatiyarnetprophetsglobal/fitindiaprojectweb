<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Usermeta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class UserExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        if(request()->has('rolesoc')){
            return collect(User::getAllclubreport());
        }
        if((request()->has('uname') || request()->has('st')) || (request()->has('dst') || request()->has('month')) || (request()->has('blk') || request()->has('role'))) {

            return collect(User::getAllSearch());

        }else{

          return collect(User::getAllUser());
		}
    }

    public function headings():array{



        if(request()->has('rolesoc')){
            return[
			'ID',
			'Name',
			// 'Email',
			'Role',
			// 'Mobile',
			'Address line one',
			'Address line two',
			'City',
			'State',
			'District',
			'Block',
			// 'Gender',
			// 'Role Label',
			'Event participation',
			'Kit dispatch',
		];

        }
		return[
			'ID',
			'Name',
			// 'Email',
			'Role',
			// 'Mobile',
			'Address line one',
			'Address line two',
			'City',
			'State',
			'District',
			'Block',
			'Gender',
			'Role_Label',
			'created_at',
			'Application Status',
		];
	}

}
