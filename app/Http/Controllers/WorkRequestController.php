<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\StaffMember;
use App\Models\WorkRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\WorkRequestAttachment;

class WorkRequestController extends Controller
{
  public function index(Request $request)
  {
    $query = WorkRequest::with([
      'client',
      'staffMember',
    ]);

    if ($request->filled('keyword')) {
      $query->where(
        'title',
        'like',
        '%' . $request->input('keyword') . '%'
      );
    }

    if ($request->filled('status')) {
      $query->where(
        'status',
        $request->input('status')
      );
    }

    $workRequests = $query
      ->latest()
      ->get();

    return view('work_requests.index', [
      'workRequests' => $workRequests,
    ]);
  }

  public function create()
  {
    $clients = Client::all();
    $staffMembers = StaffMember::all();

    return view(
      'work_requests.create',
      [
        'clients' => $clients,
        'staffMembers' => $staffMembers,
      ]

    );
  }

  public function store(Request $request)
  {

    $request->validate([
      'title' => 'required|string|max:255',
      'client_id' => 'required|exists:clients,id',
      'requester_name' => 'required|string|max:255',
      'site' => 'nullable|string|max:255',
      'url' => 'nullable|url|max:255',
      'description' => 'required|string',
      'deadline' => 'nullable|date',
      'staff_member_id' => 'nullable|exists:staff_members,id',

      'attachment' => [
        'nullable',
        'file',
        'mimes:jpg,jpeg,png,webp,pdf,zip',
        'max:10240',
      ],
    ]);

    $workRequest = new WorkRequest();

    $workRequest->title = $request->input('title');
    $workRequest->client_id = $request->input('client_id');
    $workRequest->requester_name = $request->input('requester_name');
    $workRequest->site = $request->input('site');
    $workRequest->url = $request->input('url');
    $workRequest->description = $request->input('description');
    $workRequest->deadline = $request->input('deadline');
    $workRequest->staff_member_id = $request->input('staff_member_id');
    $workRequest->status = 'unhandled';

    $workRequest->save();

    if ($request->hasFile('attachment')) {
      $file = $request->file('attachment');

      $filePath = $file->store(
        'work_request_attachments',
        'public'
      );

      $attachment = new WorkRequestAttachment();

      $attachment->work_request_id = $workRequest->id;
      $attachment->original_name = $file->getClientOriginalName();
      $attachment->file_path = $filePath;

      $attachment->save();
    }

    return to_route('work_requests.index')
      ->with('success', '依頼を登録しました。');
  }

  public function show($id)
  {
    $workRequest = WorkRequest::findOrFail($id);


    return view('work_requests.show', [
      'workRequest' => $workRequest
    ]);
  }

  public function edit($id)
  {
    $workRequest = WorkRequest::findOrFail($id);
    $clients = Client::all();
    $staffMembers = StaffMember::all();

    return view('work_requests.edit', [
      'workRequest' => $workRequest,
      'clients' => $clients,
      'staffMembers' => $staffMembers,
    ]);
  }

  public function update(Request $request, $id)
  {

    $request->validate([
      'title' => 'required|string|max:255',
      'client_id' => 'required|exists:clients,id',
      'requester_name' => 'required|string|max:255',
      'site' => 'nullable|string|max:255',
      'url' => 'nullable|url|max:255',
      'description' => 'required|string',
      'deadline' => 'nullable|date',
      'staff_member_id' => 'nullable|exists:staff_members,id',
      'attachment' => [
        'nullable',
        'file',
        'mimes:jpg,jpeg,png,webp,pdf,zip',
        'max:10240',
      ],
      'status' => [
        'required',
        Rule::in(array_keys(WorkRequest::STATUS_LABELS)),
      ],
    ]);


    $workRequest = WorkRequest::findOrFail($id);

    $workRequest->title = $request->input('title');
    $workRequest->client_id = $request->input('client_id');
    $workRequest->requester_name = $request->input('requester_name');
    $workRequest->site = $request->input('site');
    $workRequest->url = $request->input('url');
    $workRequest->description = $request->input('description');
    $workRequest->deadline = $request->input('deadline');
    $workRequest->staff_member_id = $request->input('staff_member_id');
    $workRequest->status = $request->input('status');

    $workRequest->save();

    if ($request->hasFile('attachment')) {
      $file = $request->file('attachment');

      $filePath = $file->store(
        'work_request_attachments',
        'public'
      );

      $attachment = new WorkRequestAttachment();

      $attachment->work_request_id = $workRequest->id;
      $attachment->original_name = $file->getClientOriginalName();
      $attachment->file_path = $filePath;


      $attachment->save();
    }

    return to_route('work_requests.show', $workRequest->id)
      ->with('success', '依頼内容を更新しました。');
  }

  public function destroy($id)
  {

    $workRequest = WorkRequest::findOrFail($id);
    $workRequest->delete();

    return to_route('work_requests.index');
  }
}
