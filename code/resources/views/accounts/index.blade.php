@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col pt-5">

            @if( session('success') !== null )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success')[0] }}</strong>{{ session('success')[1] }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
            @endif

            <h1 class="display-4">Mijn bank rekeningen</h1>
            <p class="lead">{{ Auth::user()->name }}</p>

            <a class="btn btn-outline-success float-right mb-2" href="<?= URL::to('/accounts/add'); ?>">Rekening toevoegen</a>

            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th style="width: 10%" scope="col">#</th>
                        <th style="width: 70%" scope="col">IBAN</th>
                        <th style="width: 10%" scope="col">Edit</th>
                        <th style="width: 10%" scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td class="text-truncate" style="max-width: 50px;">{{ $account['IBAN'] }}</td>
                            <td><a class="text-info" href="<?= URL::to('/accounts/edit/' . $account['id']); ?>"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <a href="javascript:void(0)" class="text-danger" data-toggle="modal" data-target="#deleteModal{{ $loop->index }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Account verwijderen</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Weet je zeker dat je de rekening met nummer <br>"{{ $account['IBAN'] }}" wil verwijderen?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link" data-dismiss="modal">Nee, toch niet</button>
                                                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-account-form{{ $loop->index + 1 }}').submit();">Ja, verwijderen</button>
                                                <form id="delete-account-form{{ $loop->index + 1 }}" action="<?= URL::to('/accounts/delete/' . $account['id']); ?>" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection