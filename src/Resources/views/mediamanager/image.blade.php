@if ($data->has_images)
    @php
        $is_not_cropped = false;
        $media_folder = '';
        $jcrop_array = [];
    @endphp

    <div id="admin_images" class="row admin_images"{!! session()->has('processed_images') ? ' style="display:block"' : '' !!}>

        @foreach($data->image_collection as $image_key => $image)
            @php
                $uploadedImage = null;
                $jcrop = in_array('jcrop',$image);
                if ($jcrop) {
                    $jcrop_array[] = 1;
                }
                $uploadedImage = $data->medias->filter(function($item) use ($image_key) {
                    return $item->type == $image_key;
                })->first();
                $is_not_cropped = $jcrop && strstr($uploadedImage, 'jcrop_') && is_file(public_path('images/'  . $uploadedImage->content));

            @endphp
            <div class="col">
                <div class="form-group jcroppable">
                    <strong>{!! array_key_exists('label', $image) ? $image['label'] : 'Photo principale' !!}
                    </strong>
                    @if (is_null($uploadedImage))
                        @include('mediamanager.image_not_uploaded')
                    @else
                        @if($is_not_cropped)
                            @include('mediamanager.image_to_crop')
                        @else
                            @include('mediamanager.image_show')
                        @endif
                    @endif

                    <div class="mt-2">
                        <x-bootstrap-input label="Légende" name="media_description_{{ $image_key }}" :value="($uploadedImage->description ?? '')"/>
                    </div>
                </div>
            </div>
        @endforeach
        @if (count($jcrop_array) > 0)
            @push('css')
                <link rel="stylesheet" href="{!! asset('vendor/jcrop/jquery.Jcrop.css') !!}" type="text/css"/>
            @endpush
            @push('js')
                <script src="{!! asset('vendor/jcrop/jquery.Jcrop.js') !!}"></script>
                <script src="{!! asset('js/jcrop.js') !!}"></script>
            @endpush
        @endif
        @if ($data->has_gallery)
            <div class="col-sm-{{ $is_not_cropped ? 12 : 9 }} custom-content form">
                <div class="bloc-editable">
                    @php
                        $medias = $config['media'];
                        $has_label = array_key_exists('label', $medias);
                        $medias_col = array_key_exists('fields', $medias) ? 12/count($medias['fields']) : 12;
                        $is_grid = (array_key_exists('grid', $medias) && $sc['grid'] == 'custom');
                        $page_custom_data = $data->customContent->pluck('value', 'field')->toArray();
                        $item_key = 'media';
                        $item_field = $medias['fields'];
                    @endphp
                    @if ($has_label)
                        <h2>
                            {{ $medias['label'] }}
                        </h2>
                    @endif
                    @include('mediamanager.custom_content_media')
                    @include('mediamanager.custom_content_media_upload')
                </div>
            </div>
        @endif
    </div>
@endif
