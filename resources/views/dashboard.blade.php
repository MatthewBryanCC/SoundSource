<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components/dashboardHeader')
    <body class="antialiased">
        <div>
            @include('components/navbar')
            <div id="Dashboard" class="animated zoomInDown">
                <ul id="dashboard-tabs">
                    <li class="dashboard-tabs-item active" data-tab-target="#songs"><i class="fa fa-music dash-icon" aria-hidden="true"></i>Songs</li>
                    <li class="dashboard-tabs-item" data-tab-target="#playlists"><i class="fa fa-file dash-icon" aria-hidden="true"></i>Playlists</li>
                    <li class="dashboard-tabs-item" data-tab-target="#artists"><i class="fa fa-users dash-icon" aria-hidden="true"></i>Artists</li>
                </ul>
                <div id="Dashboard-Content">
                    <div id="songs" class="active" data-tab-content>
                        @if(count($songs) == 0)
                            <div class="no-items-message">
                                You have no songs uploaded!
                            </div>
                        @else
                            <ul class="dashboard-list">
                                @foreach($songs as $songData)
                                    <li class="dashboard-list-item" data-audio-location="{{ $songData->file_path }}">
                                        <p>{{ $songData->song_name }}</p>
                                        <form class='list-item-form' method="post" action="/deleteUpload/{{ $songData->id }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <i class="fa fa-play play-button" aria-hidden="true" data-play-location="{{ $songData->file_path }}"></i>
                                            <button type="submit" class="fa fa-trash trash-button" aria-hidden="true" data-audio-id="{{ $songData->id }}"></button>
                                            <input type="hidden" value="{{ $songData->id }}" name="id"/>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div id="playlists" data-tab-content>
                        <div class="no-items-message">
                            You haven't created playlists!</br>
                            <small style="color: grey">(Coming soon)</small>
                        </div>
                    </div>
                    <div id="artists" data-tab-content>
                        @if(count($artists) == 0)
                            <div class="no-items-message">
                                You have no artists on record!
                            </div>
                        @else
                            <ul class="dashboard-list">
                                @foreach($artists as $artist)
                                    <li class="dashboard-list-item"> Artist name - {{ $artist }} </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="modal-container" id="Modal">
            <form class="upload-container form-container" method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
                {{csrf_field()}}
                <h1> Upload </h1>
                <label>Choose File: </label></br>
                <input type="file" name="upload_file" id="Upload-File" style="color: white; margin-left: 100px;" accept="audio/*" /></br>
                <label>Song Title: </label></br>
                <input type="text" name="song_name" id="Song-Name" /></br>
                <label>Artist: </label></br>
                <input type="text" name="artist_name" id="Artist-Name" /></br>
                <button type="submit" class="large-button">Upload</button>
                <div id="ModalClose">&times;</div>
            </form>
            
        </div>
    </body>
    
</html>
