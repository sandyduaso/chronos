<?php
namespace Comment\Controllers\API;

// use Pluma\Controllers\Controller;
use Comment\Models\Comment;
use Illuminate\Http\Request;
use Pluma\Models\User;
// use Pluma\Models\Course;
use Comment\Requests\CommentRequest;
use Pluma\Controllers\ApiController as Controller;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Comment::all();
        $data = [];

        foreach ($resources as $resource) {
            // $course = Course::find($resource->course_id);
            $user = User::find($resource->user_id);
            $data[] = [
                "id" => $resource->id,
                "parent" => $resource->parent_id,
                "created" => $resource->created,
                "modified" => $resource->updated,
                "content" => $resource->comment,
                "pings" => [],
                "creator" => $user->id,
                "fullname" => $user->fullname,
                "profile_picture_url" => $user->avatar,
                "created_by_admin" => $user->isRoot(),
                "upvote_count" => 0,
                "user_has_upvoted" => false,
                "is_new" => false,
            ];
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function comment($id)
    // {
    //     // $resource =
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $data = $request->input('data');
        $user = User::find($request->input('user_id'));
        // $course = Course::find($request->input('course_id'));

        $comment->parent_id = $data['parent'] ? $data['parent'] : null;
        $comment->comment = $data['content'];

        $comment->user()->associate(auth()->user());
        $comment->user()->associate($user);
        $comment->save();

        return response()->json( $data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail ( $id );
        $data = $request->input('data');
        $user = User::find($request->input('user_id'));
        // $course = Course::find($request->input('course_id'));

        $comment->parent_id = $data['parent'] ? $data['parent'] : null;
        $comment->comment = $data['content'];

        $comment->user()->associate(auth()->user());
        $comment->user()->associate($user);
        $comment->save();

        return response()->json( $data );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */

    public function trash()
    {
        $resource = Comment::onlyTrashed()->paginate();
        return view("Comment::trash")->with(compact('resources'));
    }
}
