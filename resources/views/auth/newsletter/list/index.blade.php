@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title or config('app.name') }}</div>
                <div class="panel-body">
                    @include('partials.message')

                    <a href="" class="btn btn-primary create"><i class="fa fa-plus"></i> Create New</a>
                    <hr>
                    
                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Total Subscribers</th>
                            <th>Primary</th>
                            <th>Create Date</th>
                            <th class="text-right">Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td><a href="{{ route('admin.subscriber', $list->slug) }}">{{ $list->name }}</a></td>
                                    <td>{{ $list->description }}</td>
                                    <td>{{ $list->subscribers->count() }} people</td>
                                    <td>
                                        @if ($list->is_default)
                                            <span class="label label-success">Yes</span>
                                        @else
                                            <span class="label label-danger">No</span>
                                        @endif
                                    </td>
                                    <td>{{ $list->created_at->format('d.m.Y H:i') }}</td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-default delete" title="Edit current item"><i class="fa fa-pencil"></i></a>
                                        <a href="" class="btn btn-danger delete" title="Delete current item"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="create-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create New List</h4>
            </div>
            <form action="{{ route('admin.list.create.post') }}" method="post" role="form" id="create-list">
            {{ csrf_field() }}
            {{ method_field('post') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary delete"> <i class="fa fa-save"></i> Create List</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(function(){
        $('a.create').click(function(){
            $('#create-modal').modal()
            return false
        })
    })
</script>
@endpush