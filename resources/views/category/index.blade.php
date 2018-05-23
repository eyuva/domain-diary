@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <a href="{{route('category.edit',['id' => $category->id])}}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <a href="{{route('category.delete',['id' => $category->id])}}" class="btn btn-sm btn-outline-danger">Delete</a>
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
                                    <form action="{{route('category.save')}}" method="post">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input type="text" name="name" id="name" class="form-control">
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