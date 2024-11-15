<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Question([
            'pertanyaan' => $row['pertanyaan'], // assuming 'pertanyaan' is the header of the column in your Excel file
            // Add other fields here as needed
        ]);
    }
}
