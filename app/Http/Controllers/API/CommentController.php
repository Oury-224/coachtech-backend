<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(){
        $posts = Post::all()->sortByDesc('created_at');
        $Comments = Comment::all()->sortByDesc('created_at');
        return response()->json($posts,$Comments);
    }
    public function create_comment(){
        $posts = Post::all()->sortByDesc('created_at');
        return response()->json($posts);
    }
    public function add_comment(Request $request){
         // verification de la validation des informations.
         $validate =  $request->validate([
            'contenu'=>['required','min:7','max:255'],
            'dateC'=>'required',
            'post_id'=>'required'
          ]);
          // fin de la verification.
        //enregistrement des informations dans la BD
        $user_id = 7;
       $comment = Comment::create([
            'contenu' => $request->contenu,
            'dateCreation'=>$request->dateC,
            'post_id'=>$request->post_id,
            'user_id'=>$user_id
        ]);
        //fin de l'enregistrement

        return response()->json($comment);
    }
    public function Modifier_Comment($id){
        $postes = Post::all()->sortByDesc('created_at');
        $comments = Comment::find($id);
        return response()->json($postes,$comments);
    }
    public function updateComment($id,Request $request){
        // verification de la validation des informations.
        $validate =  $request->validate([
            'contenu'=>['required','min:7','max:255'],
            'dateC'=>'required',
            'post_id'=>'required'
          ]);
          // fin de la verification.

          //modification d'un commentaire dans le BD.
        $user_id = 7;
        $comment = Comment::find($id);
        $comment->update([
            'contenu' => $request->contenu,
            'dateCreation'=>$request->dateC,
            'post_id'=>$request->post_id,
            'user_id'=>$user_id
        ]);
         return response()->json($comment);
    }
    public function deleteComment($id){
        $comments = Comment::find($id);
        $comments->delete();
        return response()->json($comments);
    }
}
