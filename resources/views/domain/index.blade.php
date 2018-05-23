@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('domain.save')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="domain_id" value="{{$domain->id}}">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control" data-value="{{$domain->category_id?:''}}">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tag">Tags</label>
                                <select name="tags[]" id="tags" class="form-control" multiple style="width:100%;"  data-value="{{$domain->tags()->pluck('tags.id')?:''}}">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                                <small id="tagHelp" class="form-text text-muted">Shift + click to select multiple</small>
                            </div>
                            <div class="form-group">
                                <label for="domain">Domain</label>
                                <input type="text" name="domain" id="domain" class="form-control" value="{{$domain->name?:''}}">
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="registered_on">Registered on</label>
                                    <input type="date" name="registered_on" id="registered_on" class="form-control" value="{{$domain->registered_on?:''}}">
                                </div>
                                <div class="form-group col">
                                    <label for="expires_on">Expires on</label>
                                    <input type="date" name="expires_on" id="expires_on" class="form-control" value="{{$domain->expires_on?:''}}">
                                </div>
                                <div class="form-group col">
                                    <label for="updated_on">Updated on</label>
                                    <input type="date" name="updated_on" id="updated_on" class="form-control" value="{{$domain->updated_on?:''}}">
                                </div>
                            </div>
                            <hr>
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