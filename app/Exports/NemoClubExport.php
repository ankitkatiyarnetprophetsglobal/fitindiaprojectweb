<?php 
namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NemoClubExport implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings
{
    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $results = DB::table('users')
            ->leftJoin('usermetas', 'users.id', '=', 'usermetas.user_id')
            ->leftJoinSub(
                DB::table('event_organizations')
                    ->select('user_id', DB::raw('COUNT(*) as eventcount'))
                    ->whereIn('category', [13077, 13078, 13075])
                    ->where(function ($q) {
                        $q->where('eventimg_meta', '!=', 'a:0:{}')
                          ->orWhere('event_bg_image', '!=', '');
                    })
                    ->groupBy('user_id'),
                'event_participation',
                function ($join) {
                    $join->on('users.id', '=', 'event_participation.user_id');
                }
            )
            ->select(
                'users.name', 'users.email', 'users.role',
                'users.rolelabel', 'users.phone', 'usermetas.gender',
                'usermetas.city', 'usermetas.state', 'usermetas.district',
                'usermetas.block', 'users.created_at',
                'usermetas.kit_dispatch as kit_dispatch',
                DB::raw('IFNULL(event_participation.eventcount, 0) as event_participation')
            )
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('users.rolewise', 'like', '%cyclothon-2024%')
                      ->where('usermetas.cyclothonrole', '=', 'club');
                })->orWhere('users.role', '=', 'namo-fit-india-cycling-club');
            });

        if (!empty($this->search)) {
            $results->where(function ($q) {
                $q->where('users.name', 'like', '%' . $this->search . '%')
                  ->orWhere('users.email', 'like', '%' . $this->search . '%')
                  ->orWhere('users.phone', 'like', '%' . $this->search . '%');
            });
        }

        return $results->get();
    }

    public function headings(): array
    {
        return [
            'Name', 'Email', 'Role', 'Role Label', 'Phone', 'Gender', 'City', 'State',
            'District', 'Block', 'Created At', 'Kit Dispatch', 'Event Participation Count'
        ];
    }
}
