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
    <link rel="icon" href="data:image/png;base64,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"> 
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