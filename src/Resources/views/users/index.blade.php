<x-aboleon.framework-layout :title="$data->total() . ' ' . trans_choice('aboleon.framework::accounts.label', $data->total())">

    <div class="mb-3 text-center">
        <a class="btn btn-sm btn-success" href="{{ route('aboleon.framework.users.create') }}">Créer</a>

    </div>

        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                <x-aboleon.framework-response-messages/>

                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ __('aboleon.framework::accounts.names') }}</th>
                        <th>e-mail</th>
                        <th>{{ __('aboleon.framework::ui.created') }}</th>
                        <th>{{ __('aboleon.framework::accounts.last_seen') }}</th>
                        <th width="200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($data as $item)
                        <tr>
                            <td>{{ $item->names() }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at?->format('d/m/Y H:i') }}</td>
                            <td></td>
                            <td>
                                <x-aboleon.framework-edit-link route="{{ route('aboleon.framework.users.edit', $item->id) }}"/>
                                <x-aboleon.framework-delete-link reference="{{ $item->id }}"
                                               route="{{route('aboleon.framework.users.destroy', $item->id)}}"
                                               question="{{ __('crm.should_i_delete_user') }}"
                                               title="{{ __('crm.deletion') }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                {{ __('errors.no_data_in_db') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <x-aboleon.framework-pagination :object="$data"/>

            </div>
        </div>
</x-aboleon.framework-layout>
