<x-aboleon.framework-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Paramètres configurables
        </h2>
    </x-slot>
    @push('css')
        <style>
            .module {
                margin-right: 10px !important;
            }
        </style>
    @endpush
    <div class="bg-white container my-3 p-3 rounded">

            @if (!$data->isEmpty())
            <div id="modules" class="row">
                @foreach($data as $v)
                    <div class="module col-sm-4 bloc-editable">
                        <strong>
                            <span>{{ $v->title }}</span>
                        </strong>
                        <p>{{ $v->description }}</p>
                        <div class="py-3">
                            @switch($v->type)
                                @case('custom')
                                @include('aboleon.framework::configurables.custom.index_'.$v->name)
                                @break
                                @default
                                {!! !empty($v->value) ? ($v->type == 'number' ? $v->value/100 : $v->value) : 'Non indiqué' !!}
                            @endswitch
                        </div>

                        <x-aboleon.framework-edit-link :route="route('aboleon.framework.configurables.edit', $v->id)"/>
                    </div>
                @endforeach
            </div>
            @else
                {!! warning_notice("Aucun paramètrage n'est enregistré") !!}
            @endif
    </div>

</x-aboleon.framework-layout>>
