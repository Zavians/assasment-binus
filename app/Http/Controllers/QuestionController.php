<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class QuestionController extends Controller
{
    public function index()
{
    $dataPertanyaan = Question::all();
    $banyakPertanyaan = $dataPertanyaan->count();

    return view('pages.questionupload.index', compact('dataPertanyaan', 'banyakPertanyaan'));
}

    public function store(Request $request)
    {
        // Log file upload process
        Log::info('File upload started');

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // max 10MB file size
        ]);

        try {
            // Store the uploaded file in the public storage folder with a random name
            $file = $request->file('file');

            // Generate a random filename with the same extension as the uploaded file
            $randomName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            Log::info('Generated random filename: ' . $randomName);

            // Define the file path in 'public/files' folder
            $filePath = 'storage/files/' . $randomName;  // File path from public directory

            // Store the file in the correct public folder
            $file->storeAs('public/files', $randomName);
            Log::info('File stored successfully at: ' . storage_path('app/public/files/' . $randomName));

            // Load the file using PhpSpreadsheet
            $spreadsheet = IOFactory::load(storage_path('app/public/files/' . $randomName));
            Log::info('File loaded successfully');

            // Process the spreadsheet
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Loop through the rows and save data into the database
            foreach ($rows as $row) {
                // Log row data to check what is being processed
                Log::debug('Processing row: ' . implode(', ', $row));

                // Make sure the row has valid data
                if (!empty($row[0]) && !empty($row[1])) {
                    $question = new Question();
                    $question->pertanyaan = $row[0]; // First column is Pertanyaan
                    $question->point = $row[1]; // Second column is Point
                    $question->save();
                    Log::info('Question saved: ' . $row[0] . ', ' . $row[1]);
                } else {
                    Log::warning('Row skipped due to missing data: ' . implode(', ', $row));
                }
            }

            return redirect()->back()->with('success', 'File uploaded and data saved successfully!');
        } catch (\Exception $e) {
            // Log the error if something goes wrong
            Log::error('Error processing file: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error processing the file. ' . $e->getMessage());
        }
    }

    public function update(Request $request)
{
    // Validate the request for bulk update
    $request->validate([
        'questions' => 'required|array|min:1', // Ensure at least one question is selected
        'questions.*' => 'exists:question,id', // Validate question IDs (correct table name here)
        'new_point' => 'required|integer|min:1', // Validate the new point value
    ]);

    try {
        // Update points for selected questions
        $updated = Question::whereIn('id', $request->questions)
            ->update(['point' => $request->new_point]);

        if ($updated) {
            Log::info('Bulk update successful for questions: ' . implode(', ', $request->questions));
            return redirect()->back()->with('success', 'Points updated successfully!');
        } else {
            Log::warning('No questions were updated.');
            return redirect()->back()->with('warning', 'No questions were updated.');
        }
    } catch (\Exception $e) {
        Log::error('Error during bulk update: ' . $e->getMessage());
        return redirect()->back()->with('error', 'There was an error updating the points.');
    }
}




public function destroy(Request $request)
{
    // Validate the request for bulk delete
    $request->validate([
        'questions' => 'required|array|min:1', // Ensure at least one question is selected
        'questions.*' => 'exists:question,id', // Validate the question IDs
    ]);

    try {
        // Delete the selected questions
        $deleted = Question::whereIn('id', $request->questions)->delete();

        if ($deleted) {
            Log::info('Bulk delete successful for questions: ' . implode(', ', $request->questions));
            return redirect()->back()->with('success', 'Questions deleted successfully!');
        } else {
            Log::warning('No questions were deleted.');
            return redirect()->back()->with('warning', 'No questions were deleted.');
        }
    } catch (\Exception $e) {
        Log::error('Error during bulk delete: ' . $e->getMessage());
        return redirect()->back()->with('error', 'There was an error deleting the questions.');
    }
}

public function bulkUpdateAndDelete(Request $request)
{
    // Validate the questions
    $request->validate([
        'questions' => 'required|array|min:1', // Ensure at least one question is selected
        'questions.*' => 'exists:question,id', // Validate question IDs
    ]);

    try {
        // Perform action based on 'action' input
        if ($request->action == 'update') {
            // Update points
            $request->validate([
                'new_point' => 'integer|min:1',
            ]);
            Question::whereIn('id', $request->questions)
                ->update(['point' => $request->new_point]);

            Log::info('Bulk update successful for questions: ' . implode(', ', $request->questions));
            return redirect()->back()->with('success', 'Points updated successfully!');
        } elseif ($request->action == 'delete') {
            // Delete selected questions
            Question::whereIn('id', $request->questions)->delete();

            Log::info('Bulk delete successful for questions: ' . implode(', ', $request->questions));
            return redirect()->back()->with('success', 'Questions deleted successfully!');
        }

        // Default response for unknown action
        return redirect()->back()->with('error', 'Invalid action!');
    } catch (\Exception $e) {
        Log::error('Error during bulk operation: ' . $e->getMessage());
        return redirect()->back()->with('error', 'There was an error performing the action.');
    }
}


}

