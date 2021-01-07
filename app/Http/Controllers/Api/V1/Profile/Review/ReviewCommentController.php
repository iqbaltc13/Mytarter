<?php

namespace App\Http\Controllers\Api\V1\Profile\Review;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use App\Models\Jamaah;
use App\Models\DaftarHaji;
use App\Models\DaftarHajiLog;
use App\Models\PembayaranHaji;
use App\Models\Kbih;
use App\Models\SettingNominalHajiMuda;
use Auth;
use App\Models\PaketTabunganUmrah;
use App\Models\TabunganUmrah;
use App\Helpers\VirtualAccount;
use App\Models\Nasabah;
use DB;
use App\Models\SettingBms;
use App\Models\Review;
use App\Models\ReviewComment;
use App\Models\Notifikasi;
use App\Notifications\FirebasePushNotif;

class ReviewCommentController extends Controller{

    public function create(Request $request){
        $rules = [
            'review_id'             => 'required|integer|exists:reviews,id',
            'comment'               => 'required|string',
        ];
        $validator      =  $this->customValidation($request, $rules);
        if ($validator !== TRUE) {
            return $validator;
        }
        $review                             = Review::find($request->review_id);
        DB::beginTransaction();
        $user                               = User::find(Auth::id());
        $new_data                           = new ReviewComment();
        $new_data->user_id                  = $user->id;
        $new_data->comment                  = $request->comment;
        $new_data->review_id                = $review->id;
        $new_data->user_name                = $user->name;
        $new_data->is_admin                 = $request->is_admin?1:0;
        $new_data->save();
        $new_data->refresh();
        DB::commit();
        $data           = Review::find($review->id);
        $data->load(['user','file','comments','likes']);
        $data->user->file;
        foreach ($data->comments as $value) {
            $value->user->file;
        }

        //Kirim Notifikasi
        $penerima                       = User::find($review->user_id);
        if($penerima){
            $new_notifikasi                 = new Notifikasi();
            $new_notifikasi->sender_id      = Auth::id();
            $new_notifikasi->receiver_id    = $review->user_id;
            $new_notifikasi->title          = "MyDuma Review";
            $new_notifikasi->subtitle       = $user->name." komentar di review kamu.";
            $new_notifikasi->action         = 'review_detail';
            $new_notifikasi->value          = $review->id;
            $new_notifikasi->save();
            $penerima->notify(new FirebasePushNotif($new_notifikasi->title, $new_notifikasi->subtitle, $new_notifikasi->action, $new_notifikasi->value));
        }
        
        return $this->success('Berhasil',$data);
    }

    public function delete(Request $request){
        $rules = [
            'id'         => 'required|integer|exists:review_comments,id',
        ];

        $validator      =  $this->customValidation($request, $rules);
        if ($validator !== TRUE) {
            return $validator;
        }
        $data    = ReviewComment::find($request->id);
        if($data->user_id != Auth::id()){
            return $this->failure('Anda tidak bisa menghapus komen ini');
        }
        $data->delete();
        return $this->success('Berhasil dihapus.');
    }
}
