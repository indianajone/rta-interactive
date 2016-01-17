<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Ravarin\Entities\Attachment;
use App\Http\Controllers\Controller;
use Ravarin\Translations\TranslationTransformer;

class AttachmentController extends Controller
{
    protected $transformer;

    public function __construct(TranslationTransformer $transformer) {
        $this->transformer = $transformer;
    }

    public function show(Attachment $attachments, $id) 
    {
        $attachment = $attachments->with('translations')->findOrFail($id);

        return [
            'path' => asset($attachment->path),
            'th' => ['title' => $attachment->trans('th', 'title') ],
            'en' => ['title' => $attachment->trans('en', 'title') ]
        ];
    }

    public function update(Attachment $attachments, Request $request, $id) 
    {
        $attachment = $attachments->findOrFail($id);

        $attachment->update($transformer($request->all()));

        flash()->success('Update!', 'Update successfully.');

        return redirect()->back();
    }
}
