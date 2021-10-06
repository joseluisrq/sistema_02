<!--Extendemos de la plantilla principal-->
@extends('principal')
<!--INICIA EL CONTENIDO-->
@section('contenido') 


@if(Auth::check()) <!--si el usuario esta autentificado-->
    @if (Auth::user()->idrol == 1)
       
        <template v-if=menu==1>
            <curso :ruta="ruta" ></curso>    
        </template>

    @elseif (Auth::user()->idrol == 2)
    
    @elseif (Auth::user()->idrol == 3)
    
    @else

    @endif

@endif

@endsection
<!--FIN DEL CONTENIDO-->