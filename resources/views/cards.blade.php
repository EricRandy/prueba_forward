@extends('layouts.app')

@section('content')
<script>
    $(document).ready(function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('getCards') }}",
            data: {

            },
            type: 'GET',
            dataType: 'json',
            success: function($result) {
                $("#cards_rm").html("");
                $.each($result, function(key, value) {
                    let cards_create = '<div class="col">' +
                        '<div class="card h-100">' +
                        '<img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi0.wp.com%2Fcodigoespagueti.com%2Fwp-content%2Fuploads%2F2020%2F08%2FBob-Esponja-Patricio-Estrella-The-Patrick-Star-Show.jpg%3Ffit%3D1200%252C800%26quality%3D80%26ssl%3D1&f=1&nofb=1" class="card-img-top" alt="Pat">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' + value.nombre + '</h5>' +
                        '<p class="card-text">' + value.descripcion + '</p>' +
                        '<button id="button' + key + '" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">' +
                        'View all content' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $("#cards_rm").append(cards_create);
                    $("#button" + key).click(function() {
                        $("#staticBackdropLabel").text('ForWard - ' + value.nombre);
                        $("#description_cards").text(value.descripcion == null ? "Nada por aqui" : value.descripcion);
                        $("#btnDownload").text('Download ' + value.archivo);
                        $("#btnDownload").attr('href', '{{ url("")."/files/" }}' + value.archivo);
                    });
                });
            },
            error: function($error, $errores) {
                console.log($error);
                console.log($errores);
            }
        });
    });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="row row-cols-1 row-cols-md-3 g-4" id="cards_rm">

        </div>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="staticBackdropLabel">ForWard</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 id="description_cards"></h5>
                            <div class="d-grid gap-2">
                                <a class="btn btn-success" target="_blank" id="btnDownload">Download</a>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection