@php

    $img_to_show = $img_zoom = $data->uploadParams['dir'] . $uploadedImage->content;

    if (array_key_exists('sizes', $image)) {
        $images_values = collect($image['sizes'])->sortBy('w');
        $img_zoom = str_replace('.jpg', '-'.$images_values->last()['label'].'.jpg', $img_to_show);
        $img_to_show = str_replace('.jpg', '-'.$images_values->first()['label'].'.jpg', $img_to_show);

    }

@endphp
@if (is_file(public_path($img_to_show)))
    @php
        list($img_to_show_width, $img_to_show_height) = getimagesize(public_path($img_to_show))
    @endphp
    <div class="media-gallery">
        <div class="img-holder" {!! array_key_exists('background', $image) ? 'style="background-color:'.$image['background']
    .'"' : null !!}>
            <img alt="" src="{!! asset($img_to_show) !!}"
                 class="img-fluid" {!! $img_to_show_height > 400 ? "style='max-height:230px;'" : null !!} />
            <div class="text mt-2">
                <a href="{!! asset($img_to_show) !!}"
                   class="zoom btn btn-sm btn-info"
                   target="_blank"
                   ata-index="0"
                   data-src="{!! asset($img_zoom) !!}">
                    <i class="white fas fa-search-plus"></i>
                </a>

                <a href="{{ config('aboleon_framework.route') }}/mediamanager/unlink/{{ $uploadedImage->id }}" class="btn btn-danger btn-sm">Supprimer l'image</a>

            </div>
        </div>
    </div>
@else

    <a class="btn btn-danger"
       href="{!! url(config('aboleon_framework.route').'/mediamanager/remove/' . $uploadedImage->id) !!}">
        <i class="white fas fa-trash-alt"></i> Effacer la référence</a>
@endif
