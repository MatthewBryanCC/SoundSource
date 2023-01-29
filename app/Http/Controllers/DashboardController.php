<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AudioUpload;
use Illuminate\Support\Facades\Auth;   
use Carbon\Carbon; 

class DashboardController extends Controller
{
    public function Dashboard() {
        //Fetch user data here.
        $songs = AudioUpload::where('owner', Auth::user()->name)->get();
        $unique_artists = array();
        foreach($songs as $song) {
            if(!in_array($song->artist_name, $unique_artists)) {
                array_push($unique_artists, $song->artist_name);
            }
        }

        return view('dashboard', [
            'user' => auth()->user(),
            'songs' => $songs,
            'artists' => $unique_artists
        ]);
    }

    public function UploadIndex() {
        //Redirect and send data.
        return redirect()->intended('/dashboard');
    }
    public function UploadFile(Request $request) {
        $validation = $request->validate([
            'song_name' => 'required',
            'artist_name' => 'required'
        ]);
        if(Auth::check()) {
            $file = $request->file('upload_file');
            $uniqueid=uniqid();
            $original_name=$file->getClientOriginalName();
            $size=$file->getSize();
            $extension=$file->getClientOriginalExtension();
            $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
            $audiopath=url('/storage/uploads/audio/'.$filename);
            $path=$file->storePubliclyAs('public/uploads/audio',$filename);

            //Create new model item.
            $newAudio = AudioUpload::create([
                'owner' => Auth::user()->name,
                'file_path' => $audiopath,
                'song_name' => $request->song_name,
                'artist_name' => $request->artist_name
            ]);
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->intended('/login');
        }
    }

    public function DeleteRedirect() {
        return redirect()->intended('/dashboard');
    }

    public function Delete($id) {
        $thisUpload = AudioUpload::find($id);
        if($thisUpload->owner == Auth::user()->name) {
            $thisUpload->delete();
        }
        return redirect()->intended('/dashboard');
    }
}
