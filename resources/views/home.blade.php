@extends("layouts.plantilla")

@section("contenido")
        <h1>Hola pagina home, recorda editar-la</h1>
        <div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
                <example-component></example-component><!--Añadimos nuestro componente vuejs-->
                <pacientes-component></pacientes-component>
                <datosvisita-component></datosvisita-component>
            </div>
@endsection
