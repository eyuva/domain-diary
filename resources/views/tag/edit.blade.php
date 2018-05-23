@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('tag.save')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="tag_id" value="{{$tag->id}}">
                            <div class="form-group">
                                <label for="tag">Category</label>
                                <input type="text" name="tag" id="tag" class="form-control" value="{{$tag->name?:''}}">
                            </div>
                            <div class="text-sm-right">
                                <a href="{{route('home')}}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection