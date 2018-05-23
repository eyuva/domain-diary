@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('category.save')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="category_id" value="{{$category->id}}">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" name="category" id="category" class="form-control" value="{{$category->name?:''}}">
                            </div>
                            <div class="text-sm-right">
                                <a href="{{route('category.index')}}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection