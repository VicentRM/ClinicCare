@extends ("layouts.plantilla")
@section('contenido')

    <div class="row">
        <div class="col-xl-4 col-md-12">
            <tiposvisita-component>    
            </tipossvisita-component>
        </div>
        <div class="col-xl-4 col-md-12">
            <motivosvisita-component>    
            </motivosvisita-component>
        </div>  
        <div class="col-xl-4 col-md-12">
            <tipopruebas-component>    
            </tipopruebas-component>
        </div>  
      
    </div>
    
@endsection