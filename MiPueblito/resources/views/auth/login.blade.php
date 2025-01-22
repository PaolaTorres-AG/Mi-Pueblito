<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MiPueblito</title>
	<meta name="author" content="MiPueblito">
    <meta name="description" content="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="{{asset('images/icono.png')}}">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</head>
<style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
* {
    padding: 0;
    margin: 0;
    font-family: 'Poppins', sans-serif;
}
    .imgcenter{
        display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
    }
</style>

        <!-- component -->
<div class="bg-white dark:bg-gray-900">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(https://magazine.velasresorts.com/wp-content/uploads/2020/09/Salsas-mexicanas-en-molcajete-1-1024x683.jpg)">
                {{-- <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(https://okdiario.com/img/2019/03/02/salsa-picantes.jpg)"> --}}
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <h2 class="text-4xl font-bold text-white"></h2>
                        {{-- <p class="max-w-xl mt-3 text-gray-300">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In autem ipsa, nulla laboriosam dolores, repellendus perferendis libero suscipit nam temporibus molestiae</p> --}}
                    </div>
                </div>
            </div>
            
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-center">
                        <div>
                            <img src="{{asset('images/icono.png')}}" width="60%" class="imgcenter"/>
                        </div>
                        {{-- <p class="text-3xl font-bold text-center  text-yellow-400 dark:text-white">Mi pueblito tierra buena</p> --}}
                        
                        {{-- <p class="mt-3 text-gray-500 dark:text-gray-300">Ingresa tus credenciales.</p> --}}
                    </div>

                    <div class="mt-8">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div >
                                <label for="exampleInputEmail1" class="text-lg text-gray-600 dark:text-gray-200">Número de nómina</label>
                                <input  class="form-control" type="text" id="nomina" name="nomina" :value="old('nomina')" required autofocus autocomplete="nomina">
                            </div>
                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-lg text-gray-600 dark:text-gray-200">Contraseña</label>
                                </div>

                                <input type="password" name="password" id="password"  class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>
                         

                               

                            <div class="mt-6">
                                <button
                                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform  rounded-md hover:bg-yellow-600 focus:outline-none focus:bg-green-500 focus:ring focus:ring-green-600 focus:ring-opacity-50" style= "background-color: #F29F29">
                                Ingresar
                                </button>
                            </div>

                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>