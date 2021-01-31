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
            'Editor NIK',
            'Editor Name',
            'Editor Email',
            'Program',
            'Date',
            'Shift',
            'System Kerja',
            'Segment',
            'Episode',
            'User Pendamping',
            'Request ID',
            'Remark',
            'Booth',
            'Alasan_WFO',
            'Alat_WFH',
            'Provider_WFH',
            'Download Speed_WFH',
            'Quotausage_WFH',
            'Screenshoot_WFH',
            'Remark_WFH',
            'Copy Size',
            'Copy Segment',
            'Copy Date',
            'Copy Remark'
        ];
    }
    public function collection()
    {
        return Transaction_report::all();
    }
    
}
