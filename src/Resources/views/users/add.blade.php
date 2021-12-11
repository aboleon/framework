<x-aboleon.framework-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajout d'un compte
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <x-aboleon.framework-response-messages/>

                <div class="row m-3">
                    <div class="col">
                        <form method="post" action="{{ route('aboleon.framework.users.store') }}">
                            @csrf
                            <fieldset>
                                <legend>Nouveau compte administrateur</legend>
                                <div>
                                    <div class="row mb-4">
                                        <div class="col-lg-6">
                                            <h4>Identité</h4>
                                            @include('aboleon.framework::users.form.ad_nominem')
                                        </div>
                                        <div class="col-lg-6">
                                            @include('aboleon.framework::users.form.password')
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="mt-5 main-save">
                                <x-aboleon.framework-btn-save/>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-aboleon.framework-layout>