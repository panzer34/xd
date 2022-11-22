@extends('layouts.admin')

@section('titulo', )

<span>Insumos</span>
@push('styles')
    


<link rel="stylesheet" href="{{asset('libs/datatables/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('libs/datatables/buttons.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('libs/datatables/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('/libs/boostrap-toggle/css/boostrap-toggle.min.css')}}">




@endpush

<a href="" class= "btn btn-primary btn-circle" data-toggle="modal" data-target="#createMdl">
  <i class= "fas fa-plus" ></i>

</a>

@endsection

@section('contenido')

@include('supplies.modal.create')



<div class="card">
        <div class="card-body">

            <table id="especialidad" class="table table-bordered display nowrap" cellspacing="0" width= "100%">
                <thead>
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Estatus</th>
                    <th class="text-center">Creacion</th>
                    
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($supplies as $supply)
                    <tr class="text-center">
                        <td>{{$supply->id}}</td>
                        <td>{{$supply->name}}</td>
                        <td>{{$supply->description}}</td>
                        
                           
                        <td>
                            
                        <input data-id="{{$supply->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Activo" data-off="InActivo" {{ $supply->status ? 'checked' : '' }}>
                        </td>
                        

                        <td>{{$supply->created_at->diffForHumans()}}</td>
                        

                        <td>
                            <a href="#" data-toggle="modal" data-target="#editMdl-{{$supply->id}}">
                                <i class= "far fa-edit"></i>
                            </a>    


                            <form action="{{ route('supplies.destroy', $supply->id) }}" method="post" style="display: inline-block;">
                            @method('DELETE')  
                            {{csrf_field()}}  
                              <button type="submit" >
                                <i class= "fas fa-trash-alt  "></i>
                            
                              </button>
                            </form>

                            
                        </td>
                        @include('supplies.modal.update')
                        @include('supplies.modal.delete')
                </tr>
                @endforeach

</tbody>
</table>

</div>
</div>
@endsection

@push('scripts')


<script src="{{asset('/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/libs/datatables/dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables/buttons.colVis.min.js')}}"></script>

<script src="{{asset('/libs/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('/libs/datatables/jszip.min.js')}}"></script>
<script src="{{asset('/libs/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('/libs/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('/libs/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/libs/boostrap-toggle/js/boostrap-toggle.min.js')}}"></script>

<script>
    $(document).ready(function() {
    $('#especialidad').DataTable( {

        language: {
             url: './libs/datatables/spanish.json'
        },
        responsive: true,
        autoWidth: false,

        
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'colvis',
                collectionLayout: 'fixed columns',
                collectionTitle: 'Column visibility control'
            },
            
            
            'print', 'pdf','copy', 'excel', 'csv'
        ],

        "lengthMenu": [
            [ 10, 25, 50, -1 ],
            [ '10 Resultados', '25 Resultados', '50 Resultados', 'Motrar Todos' ]
        ],
      
    } );
} );

</script>

@if(!$errors->isEmpty())
    @if($errors->has('post'))
    <script>
        $(function(){
            $('#createMdl').modal('show');
        });
    </script>
    @else
    <script>
        $(function(){
            $('#editMdl-{{$supply->id}}').modal('show');
        });

</script>
    @endif
@endif

<script>
$(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var supply_id = $(this).data('id'); 
      
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'changeStatusc',
            data: {'status': status, 'supply_id': supply_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>


@endpush   