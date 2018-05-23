@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Domain</th>
                                <th scope="col">Registered on</th>
                                <th scope="col">Updated on</th>
                                <th scope="col">Expires on</th>
                                <th scope="col">Category</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->domains as $key => $domain)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td><a href="//{{$domain->name}}" rel="nofollow" target="_blank">{{$domain->name}}</a></td>
                                    <td>{{$domain->registered_on}}</td>
                                    <td>{{$domain->updated_on}}</td>
                                    <td>{{$domain->expires_on}}</td>
                                    <td>{{$domain->category->name}}</td>
                                    <td>{{implode(', ',$domain->tags()->pluck('name')->toArray())}}</td>
                                    <td>
                                        <a href="{{route('domain.index',['id' => $domain->id])}}" class="btn btn-sm btn-outline-info">DNS Lookup</a>
                                        <a href="{{route('domain.edit',['id' => $domain->id])}}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="{{route('domain.delete',['id' => $domain->id])}}" class="btn btn-sm btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot class="thead-light">
                            <tr>
                                <th colspan="8" class="text-right">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newDomain">Add New</button>
                                </th>
                            </tr>
                            </tfoot>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="newDomain" tabindex="-1" role="dialog" aria-labelledby="newDomainModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{route('domain.save')}}" method="post">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new Domain</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="category" id="category" class="form-control">
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tag">Tags</label>
                                                <select name="tags[]" id="tags" class="form-control" multiple style="width:100%;">
                                                    @foreach($tags as $tag)
                                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="tagHelp" class="form-text text-muted">Shift + click to select multiple</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="domain">Domain</label>
                                                <input type="text" name="domain" id="domain" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush