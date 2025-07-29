<?php


namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{
    // Show all comments
    public function index(Request $request)
    {
      if ($request->ajax()) {
            $comments = Comment::latest();
            return DataTables::of($comments)
                ->addIndexColumn()
                ->addColumn('action', function ($comments) {
                    return '<a href="' . route('comments.edit', $comments->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="' . $comments->id . '">Delete</button>
                    <a href="' . route('comments.show', $comments->id) . '" class="btn btn-info btn-sm">Show</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // $comments = Comment::with('user')->latest()->get();
        return view('comments.index');
    }

    // Show form to create comment
    public function create()
    {
        $users = User::all(); // for dropdown (optional)
        return view('comments.create', compact('users'));
    }

    // Store new comment
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        Comment::create($request->only('user_id', 'content'));

        return redirect()->route('comments.index')->with('success', 'Comment added successfully.');
    }

 public function show($id)
{
    $comment = Comment::with('user')->findOrFail($id);
    return view('comments.show', compact('comment'));
}

    // Edit comment
    public function edit(Comment $comment)
    {
        $users = User::all();
        return view('comments.edit', compact('comment', 'users'));
    }

    // Update comment
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($request->only('user_id', 'content'));

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');
    }

    // Delete comment
    public function destroy(Comment $comment)
    {
            $Comment = Comment::findOrFail($id);
        $Comment ->delete($id);
            return response()->json(['success' => true]);
         }
}
