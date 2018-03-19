@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @include('inc.messages')
                    <button 
                    type="button" 
                    class="btn btn-primary btn-lg" 
                    name="button" 
                    data-toggle="modal" 
                    data-target="#addModal">Add Bookmark</button>

                    <hr>

                    <h2>My Bookmarks</h2>
                    <ul class="list-group">
                        @if (count($bookmarks) > 0)

                            @foreach($bookmarks as $bookmark)
                               <li class="list-group-item">

                                  <?php 
                                    if(substr($bookmark->url, 0, 7) !== 'http://'){
                                      $url = 'http://';
                                    }
                                    else{
                                      $url = '';
                                    }  
                                  ?>
                                   <a href="{{$url . $bookmark->url}}" target="_blank">{{$bookmark->name}}</a> 
                                   <span class="label label-default">{{$bookmark->description}}</span>
                                   <span class="pull-right button-group">
                                        <button data-id="{{$bookmark->id}}" name="button" class="btn btn-danger btn-xs delete-bookmark">Delete <span class="fa fa-remove"></span></button>
                                   </span>
                               </li>         
                            @endforeach

                        @else 
                        <h3>Bookmarks is empty :((</h3>

                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Bookmark</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('bookmarks.store') }}" method="post" class="">
            {{csrf_field()}}

            <div class="form-group">
                <label for="name">Bookmark Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="form-group">
                <label for="url">Bookmark Url</label>
                <input type="text" class="form-control" name="url">
            </div>

            <div class="form-group">
                <label for="description">Website Description</label>
                <textarea class="form-control" name="description"></textarea> 
            </div>

            <input type="submit" name="submit" value="Submit" class="btn btn-success">
        </form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
