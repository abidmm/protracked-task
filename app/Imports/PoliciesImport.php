<?php

namespace App\Imports;

use App\Models\Policy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PoliciesImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Log::info($row);
        // Normalize the keys to lowercase
        // $row = array_change_key_case($row, CASE_LOWER);

        return new Policy([
           'customer_id' =>  $row['customer_id'], 
            'customer_name' => $row['customer_name'], 
            'transaction_date' => Carbon::parse($row['transaction_date']), 
            'policy_premium' => $row['policy_premium'],  
            'policy_commission' => $row['policy_commission_percentage'],
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
