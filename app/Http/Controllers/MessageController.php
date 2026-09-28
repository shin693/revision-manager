<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\WorkRequest;
use Illuminate\Http\Request;
use App\Models\MessageAttachment;

class MessageController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'poster_name' => 'required|string|max:255',
            'body' => 'required|string',
            'attachment' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf,zip',
                'max:10240',
            ],
        ]);

        $workRequest = WorkRequest::findOrFail($id);

        $message = new Message();

        $message->work_request_id = $workRequest->id;
        $message->poster_name = $request->input('poster_name');
        $message->body = $request->input('body');

        $message->save();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            $filePath = $file->store(
                'message_attachments',
                'public'
            );

            $attachment = new MessageAttachment();

            $attachment->message_id = $message->id;
            $attachment->original_name = $file->getClientOriginalName();
            $attachment->file_path = $filePath;

            $attachment->save();
        }

        return to_route('work_requests.show', $workRequest->id)
            ->with('success', 'メッセージを投稿しました。');
    }
}
