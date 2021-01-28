<?php

namespace App\Exports;

use App\Transaction_report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID',
            'Editor_NIK',
            'Editor_Name',
            'Editor_Email',
            'Program',
            'Date',
            'Shift',
            'System_Kerja',
            'Segment',
            'Episode',
            'User_Pendamping',
            'Request_ID',
            'Remark',
            'Booth',
            'Alasan_WFO',
            'Alat_WFH',
            'Provider_WFH',
            'Download Speed_WFH',
            'Quotausage_WFH',
            'Screenshoot_WFH',
            'Remark_WFH',
            'Copy_Size',
            'Copy_Segment',
            'Copy_Date',
            'Copy_Remark'
        ];
    }
    public function collection()
    {
        return Transaction_report::all();
    }
    
}
