@php
    $module_id="";
    $message="";
    $modifypass="";
    $module_name="Utilisateur";
    $module_description="Insérez les données de sécurité de votre entreprise";
    $title="Paramètre / ".$module_name;
    $modules = array( "Entreprise", "Site", "Taxe", "XYZ" );
@endphp
@extends('layouts.app')

@section('content')
@include('layouts.configuration.securite')

<div id="myTabContent1" class="tab-content padding-10">
    <div class="tab-pane fade in active" id="s1">
        <div class="row">
            <div class="col-md-6">
                        <form method="post" action="{{ route('Parametre.store') }}" class="form-horizontal" enctype="multipart/form-data" id="form-insert">
                            @csrf
                            <fieldset>
                                <legend>Formulaire de saisie</legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Role</label>
                                                <div class="col-md-6">
                                                    <select style="width:100%" class="select2" name="role" id="role">
                                                            <option value="GENERAL">UTILISATEUR</option>
                                                            <option value="ADMINISTRATEUR">ADMINISTRATEUR</option>
                                                            <option value="ADMIN_SI">SERVICE INFORMATIQUE</option>
                                                            <option value="GENERAL_ADMIN">MANAGER</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <input type="hidden" name="id" id="iduser">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Nom et prénom</label>
                                            <div class="col-md-6">
                                                <input type="text" id="name" name="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Nom d'Utilisateur</label>
                                            <div class="col-md-6">
                                                <input type="text" id="email" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Mot de passe</label>
                                            <div class="col-md-6">
                                                <input type="password" id="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">Confirmaer le mot de passe</label>
                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                           
                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <button class="btn btn-danger" type="reset">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                </fieldset>
            </form>
            </div>
            <div class="col-md-6">
                <table id="dt_basic" class="table table-striped" width="100%">
                    <thead>			                
                        <tr class="thea-color">
                            <th data-hide="phone">ID</th>
                            <th>Nom</th>
                            <th>Nom d'utilisateur</th>
                            <th data-hide="phone, tablet">Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($Users as $User)
                <tr>
                    <td>
                        @if ($User->status=="active")
                            <span class="label label-info">{{$User->id}}.</span>
                        @else
                            <span class="label label-danger">{{$User->id}}.</span>
                        @endif
                    </td>
                  <td>{{$User->name}}</td>
                  <td>{{$User->email}}</td>
                  <td>{{$User->role}}</td>

                  <td>
                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick='editTypePiece("{{$User->id}}","{{$User->name}}","{{$User->email}}")'>Modifier <i class='fa fa-edit'></i></button>
                    <button class='btn btn-xs tablebutton tablebuttonvlick' onclick="editUser({{$User->id}})">  

                    @if ($User->status=="active")
                        supprimer
                    @else
                       Restaurer
                    @endif
                </button>
                </td>

                </tr>
                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
$("#userli").addClass("active");

    $(document).ready(function () {

        $(document).on('click', '#validation_button', function (e) {
            e.preventDefault();
            $(this).text('Validation..');
            $('#form-insert').submit();
        });
    });

    function editTypePiece(id,name,email) {
        document.getElementById("iduser").value = id;
        document.getElementById("name").value = name;
        document.getElementById("email").value = email;    
}

function editUser(id) {
    var url='{{asset("/User/Edit")}}/'+id;
    $.alert.open(
    'Voulez-vous supprimez cette ligne',
    {
        A: 'Oui',
        C: 'Non'
    },
    function(button) {
        if (button=="A")
            page_redirect(url);
        else
            $.alert.open('Suppression annulée');
    }
);
}
</script>
@endsection

