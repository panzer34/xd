@extends('layouts.admin')

@section('titulo', )

<span>Odontologos</span>
@push('styles')
    


<link rel="stylesheet" href="{{asset('libs/datatables/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('libs/datatables/buttons.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('libs/datatables/responsive.bootstrap.min.css')}}">




@endpush

<a href="" class= "btn btn-primary btn-circle" data-toggle="modal" data-target="#createMdl">
  <i class= "fas fa-plus" ></i>

</a>

@endsection

@section('contenido')

@include('doctors.modal.create')



<div class="card">
        <div class="card-body">

            <table id="doctor" class="table table-bordered display nowrap" cellspacing="0" width= "100%">
                <thead>
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Cedula</th>
                    <th class="text-center">Direccion</th>
                    <th class="text-center">Celular</th>
                    <th class="text-center">Sexo</th>
                    <th class="text-center">Creacion</th>
                    
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($doctors as $doctor)
                    <tr class="text-center">
                        <td>{{$doctor->id}}</td>
                        <td>{{$doctor->name}}</td>
                        <td>{{$doctor->email}}</td>
                        <td>{{$doctor->cedula}}</td>
                        <td>{{$doctor->address}}</td>
                        <td>{{$doctor->phone}}</td>
                        <td>{{$doctor->sexo}}</td>
                       

                        <td>{{$doctor->created_at->diffForHumans()}}</td>
                        

                        <td>
                            <a href="#" data-toggle="modal" data-target="#editMdl-{{$doctor->id}}">
                                <i class= "far fa-edit"></i>
                            </a>    


                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="post" style="display: inline-block;">
                            @method('DELETE')  
                            {{csrf_field()}}  
                              <button type="submit" >
                                <i class= "fas fa-trash-alt  "></i>
                            
                              </button>
                            </form>

                            
                        </td>
                        @include('doctors.modal.update')
                        @include('doctors.modal.delete')
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


<script>
    $(document).ready(function() {
    $('#doctor').DataTable( {

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
            $('#editMdl-{{$doctor->id}}').modal('show');
        });

</script>
    @endif
@endif


@endpush   