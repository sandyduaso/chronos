<?php

namespace Submission\Support\Traits;

use Illuminate\Http\Request;
use Submission\Models\Submission;
use Submission\Support\Dompdf\PDF;

trait CanExportResultTrait
{
    /**
     * The instance of the file exporter.
     *
     * @var mixed
     */
    protected $file;

    /**
     * Export to pdf the given resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request, $id)
    {
        $resource = Submission::findOrFail($id);

        switch ($request->input('export_type')) {
            case 'spreadsheet':
            case 'xlsx':
            case 'xls':
                dd("Oops! this is not supported yet");
                break;

            case 'pdf':
            case 'PDF':
            default:
                $this->file = new PDF();
                return $this->exportToPdf($request, $resource);
                break;
        }
    }

    /**
     * Exports to PDF format.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Submission\Models\Submission $submission
     * @return void
     */
    public function exportToPdf(Request $request, Submission $submission)
    {
        $this->file->loadView("Submission::templates.submissions", [
                'resource' => $submission,
             ])
             ->setPaper($request->input('paper_size') ?? 'A4')
             ->render();

        return $this->file->stream(
            $request->input('filename')
                ?? "{$submission->form->name} - {$submission->user->fullname}",
            ["Attachment" => $request->input('attachment') ?? false]
        );
    }
}
