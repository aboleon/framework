<x-aboleon.framework-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Éditer la valeur pour {{ $configurable->title }}
        </h2>
    </x-slot>


    <div class="text-center mt-3 mb-2">
        <a href="{{route('aboleon.framework.configurables.index')}}" class="btn btn-info">Retour à la liste</a>
    </div>

    <main class="m">

        <form method="post" autocomplete="off" action="{{ route('aboleon.framework.configurables.update', $configurable->id) }}">
            @method('put')
            @csrf
            <div id="modules" class="row">

                @if (!is_null($configurable))
                    <div class="module col-sm-6 bloc-editable">
                        <h2>{{ $configurable->title }}</h2>
                        <p>{{ $configurable->description }}</p>

                        @php
                            $configurable_types = ['email'];
                            $configurable_type = in_array($configurable->type, $configurable_types) ? $configurable->type : 'text';
                        @endphp

                        @switch($configurable->type)
                            @case('textarea')
                            <x-aboleon.framework-bootstrap-textarea :value="$configurable->value" name="value"/>
                            @break
                            @case('custom')
                            @includeIf('aboleon.framework::configurables.custom.edit_'.$configurable->name)
                            @break

                            @default
                            <x-aboleon.framework-bootstrap-input
                                    :type="$configurable->type"
                                    :value="$configurable->type == 'number' ? ($configurable->value/100) : $configurable->value"
                                    name="value"/>
                        @endswitch
                    </div>
                @else
                    Error : uknown configurable
                @endif
            </div>
            <x-aboleon.framework-btn-save/>
        </form>
    </main>
</x-aboleon.framework-layout>